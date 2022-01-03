@if((auth()->user()->role_id ==1))
{{--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">



                </div>
            </div>
        </div>
    </div>
</x-app-layout>--}}

@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Administrador</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración </p>
    crud
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@else
    <h2>ACCESO NO AUTORIZADO... </h2>
{{--    TODO despues implementar policies--}}
    <a href="/" class="btn btn-blue">Regresar</a>
@endif
