@extends('adminlte::page')

@section('title', 'Modifier une permission')

@section('content_header')
    <h1>Modifier une permission</h1>
@stop

@section('content')
    <form action="{{ route('permissions.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom de la permission</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}" required>
        </div>

        <button type="submit" class="btn btn-warning">Modifier</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Retour</a>
    </form>
@stop
