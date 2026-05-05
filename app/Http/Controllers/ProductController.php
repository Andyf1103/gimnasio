<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:ver productos|crear productos|editar productos|eliminar productos')->only(['index', 'show']);
        $this->middleware('permission:crear productos')->only(['create', 'store']);
        $this->middleware('permission:editar productos')->only(['edit', 'update']);
        $this->middleware('permission:eliminar productos')->only(['destroy']);
    }

    private function routePrefix(): string
    {
        return Auth::guard('admin')->check() ? 'admin' : 'employee';
    }

    public function index()
    {
        $productos = Product::orderBy('id', 'asc')->paginate(10);
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio_venta' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route($this->routePrefix() . '.productos.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    public function show(Product $producto)
    {
        return view('admin.productos.show', compact('producto'));
    }

    public function edit(Product $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, Product $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio_venta' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        $producto->update($request->all());

        return redirect()->route($this->routePrefix() . '.productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $producto)
    {
        $producto->delete();

        return redirect()->route($this->routePrefix() . '.productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
