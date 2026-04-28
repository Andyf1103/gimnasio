@extends('adminlte::page')

@section('title', 'Panel Administrador')

@section('content_header')
    <h1>Panel Administrador</h1>
@stop

@section('content')
    <p>Bienvenido, {{ Auth::guard('admin')->user()->nombre }}.</p>
@stop