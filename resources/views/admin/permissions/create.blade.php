@extends('adminlte::page')

@section('title', 'Créer une permission')

@section('content_header')
    <h1>Créer une permission</h1>
@stop

@section('content')
    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nom de la permission</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Retour</a>
    </form>
@stop
