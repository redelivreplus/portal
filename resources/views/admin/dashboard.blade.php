@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h3>Bem-vindo, {{ Auth::user()->name }}!</h3>
@endsection

