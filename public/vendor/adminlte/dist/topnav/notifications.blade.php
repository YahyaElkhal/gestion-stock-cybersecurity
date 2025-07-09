<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-bell"></i>
        @if (Auth::check() && Auth::user()->unreadNotifications->count() > 0)
            <span class="badge badge-warning navbar-badge">
                {{ Auth::user()->unreadNotifications->count() }}
            </span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">
            {{ Auth::user()->unreadNotifications->count() }} Notifications
        </span>

        <div class="dropdown-divider"></div>

        @foreach(Auth::user()->unreadNotifications->take(5) as $notification)
            <a href="{{ $notification->data['url'] ?? '#' }}" class="dropdown-item">
                <i class="fas fa-info-circle mr-2"></i> {{ $notification->data['message'] ?? 'Notification' }}
                <span class="float-right text-muted text-sm">
                    {{ $notification->created_at->diffForHumans() }}
                </span>
            </a>
        @endforeach

        <div class="dropdown-divider"></div>
        <a href="{{ route('notifications.markAllAsRead') }}" class="dropdown-item dropdown-footer">Tout marquer comme lu</a>
    </div>
</li>
