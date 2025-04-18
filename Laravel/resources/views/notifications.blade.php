@include('components.header')

<style>
    .notification-container {
        padding-top: 8rem;
        padding-bottom: 2rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .notifications-header {
        background-color: transparent;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        max-width: 72rem;
        margin-left: auto;
        margin-right: auto;
    }

    .notifications-header h2 {
        font-size: 1.5rem;
        line-height: 2rem;
        font-weight: 600;
        color: #1f2937;
    }

    .notifications-header p {
        color: #4b5563;
        margin-top: 0.25rem;
    }

    .notifications-list {
        display: grid;
        gap: 1rem;
        max-width: 72rem;
        margin-left: auto;
        margin-right: auto;
    }

    .notification-card {
        background-color: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        padding: 1.5rem;
        padding-bottom: 2.5rem; 
        position: relative; 
        transition: all 0.2s ease-in-out;
        border-left: 4px solid transparent;
    }

    .notification-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    .notification-card.unread {
        background-color: #eff6ff; 
        border-left-color: #C1E4C4; 
    }

    .notification-card.unread .notification-title {
        font-weight: 600;
    }

    .unread-dot {
        display: inline-block;
        width: 0.5rem;
        height: 0.5rem;
        background-color: rgb(100, 179, 106);
        border-radius: 9999px;
        margin-right: 0.5rem;
        flex-shrink: 0;
    }

    .notification-content {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding-right: 3rem; 
    }

    .notification-header-flex {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .notification-title {
        font-size: 1.125rem;
        line-height: 1.75rem;
        font-weight: 500;
        color: #111827;
    }

    .notification-message {
        color: #4b5563;
    }

    .notification-time {
        display: block;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: #6b7280;
        align-self: flex-start;
        margin-top: 0.25rem; 
    }

    .notification-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem; 
        position: absolute;
        bottom: 0.75rem; 
        right: 1rem; 
    }

    .icon-button {
        background: none;
        border: none;
        padding: 0.25rem;
        margin: 0;
        cursor: pointer;
        color: #9ca3af; 
        transition: color 0.15s ease-in-out;
        line-height: 0;
        border-radius: 9999px; 
    }

    .icon-button:hover {
        color: #4b5563; 
        background-color: rgba(0, 0, 0, 0.05); 
    }

    .icon-button svg {
        width: 1.125rem; 
        height: 1.125rem; 
        display: block;
    }

    .empty-state {
        background-color: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        text-align: center;
        color: #6b7280;
        margin-top: 1.5rem;
        max-width: 72rem;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<div class="min-h-screen bg-gray-100">
    <div class="notification-container">

        <div class="notifications-header">
            <h2>Notifications</h2>
            <p>You have {{ $notifications->where('is_read', false)->count() }} unread notifications</p>
        </div>

        <div class="notifications-list">
            @forelse ($notifications as $notification)
                {{-- Add data attributes for potential JS interaction --}}
                <div class="notification-card {{ !$notification->is_read ? 'unread' : '' }}" data-notification-id="{{ $notification->id }}">
                    {{-- Notification Content --}}
                    <div class="notification-content">
                        <div class="notification-header-flex">
                            @if (!$notification->is_read)
                                <span class="unread-dot"></span>
                            @endif
                            <h3 class="notification-title">{{ $notification->title }}</h3>
                        </div>
                        <p class="notification-message">{{ $notification->message }}</p>
                        <time class="notification-time" datetime="{{ $notification->created_at->toIso8601String() }}">
                            {{ $notification->created_at->diffForHumans() }}
                        </time>
                    </div>

                    {{-- Notification Actions (Icons) - Positioned bottom right --}}
                    <div class="notification-actions">
                        @if (!$notification->is_read)
                            {{-- Modern Mark as Read Icon (Check Circle Outline) --}}
                            <button class="icon-button mark-as-read-button" title="Mark as Read">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        @endif

                        {{-- Modern Delete Icon (Trash Outline) - Always shown --}}
                        <button class="icon-button delete-button" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    No notifications found
                </div>
            @endforelse
        </div>

    </div>
</div>

