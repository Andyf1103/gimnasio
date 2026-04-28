@extends('adminlte::page')

@section('title', 'Panel Recepcionista')

@section('content_header')
    <h1>Panel Recepcionista</h1>
@stop

@section('content')
    <p>Bienvenida, {{ Auth::guard('employee')->user()->nombre }}.</p>
@stop