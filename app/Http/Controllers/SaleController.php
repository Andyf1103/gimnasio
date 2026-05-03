<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        $ventas = Sale::with(['client', 'employee', 'paymentMethod'])
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('admin.ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Product::where('stock', '>', 0)->orderBy('nombre')->get();
        $metodos = PaymentMethod::all();
        return view('admin.ventas.create', compact('productos', 'metodos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'required|exists:products,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'comprobante' => 'nullable|image|max:2048',
        ]);

        $total = 0;
        $detalles = [];

        foreach ($request->productos as $item) {
            $producto = Product::find($item['id']);
            $subtotal = $producto->precio_venta * $item['cantidad'];
            $total += $subtotal;

            $detalles[] = new SaleDetail([
                'product_id' => $producto->id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio_venta,
                'subtotal' => $subtotal,
            ]);

            $producto->decrement('stock', $item['cantidad']);
        }

        $rutaComprobante = null;
        $metodo = PaymentMethod::find($request->payment_method_id);
        if ($metodo && strtolower($metodo->nombre) == 'qr' && $request->hasFile('comprobante')) {
            $rutaComprobante = $request->file('comprobante')->store('comprobantes', 'public');
        }

        $venta = Sale::create([
            'client_id' => null,
            'employee_id' => Auth::guard('employee')->check() ? Auth::guard('employee')->id() : null,
            'payment_method_id' => $request->payment_method_id,
            'total' => $total,
            'comprobante' => $rutaComprobante,
        ]);

        $venta->saleDetails()->saveMany($detalles);

        return redirect()->route('admin.ventas.index')
            ->with('success', 'Venta registrada correctamente. Total: Bs ' . number_format($total, 2));
    }

    public function show(Sale $venta)
    {
        $venta->load(['client', 'employee', 'paymentMethod', 'saleDetails.product']);
        return view('admin.ventas.show', compact('venta'));
    }

    public function destroy(Sale $venta)
    {
        foreach ($venta->saleDetails as $detalle) {
            $detalle->product->increment('stock', $detalle->cantidad);
        }

        $venta->delete();

        return redirect()->route('admin.ventas.index')
            ->with('success', 'Venta eliminada correctamente.');
    }
}