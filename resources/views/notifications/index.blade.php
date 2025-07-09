@extends('adminlte::page')

@section('title', 'Mes notifications')

@section('content_header')
    <h1>Mes notifications</h1>
@endsection

@section('content')
    <div class="mb-3">
        <a href="{{ route('notifications.read.all') }}" class="btn btn-success btn-sm">
            <i class="fas fa-check-double"></i> Tout marquer comme lu
        </a>
    </div>

    <ul class="list-group">
        @forelse ($notifications as $notification)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    {{ $notification->data['message'] ?? 'Notification' }}
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                @if (is_null($notification->read_at))
                    <a href="{{ route('notifications.read', $notification->id) }}" class="btn btn-sm btn-primary">
                        Marquer comme lu
                    </a>
                @else
                    <span class="badge badge-success">Lue</span>
                @endif
            </li>
        @empty
            <li class="list-group-item text-center">Aucune notification.</li>
        @endforelse
    </ul>
@endsection
