<div class="topbar-custom">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button type="button" class="button-toggle-menu nav-link">
                        <iconify-icon icon="tabler:align-left"
                            class="fs-20 align-middle text-dark topbar-button"></iconify-icon>
                    </button>
                </li>
            </ul>

            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <iconify-icon icon="tabler:bell"
                            class="fs-20 text-dark align-middle topbar-button"></iconify-icon>

                        <span class="badge bg-danger rounded-circle noti-icon-badge {{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'd-none' }}"
                            id="notification-badge">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-xl">
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0 fs-16">
                                <span class="float-end">
                                    <a href="{{ route('notifications.markAsRead') }}" class="text-dark">
                                        <small><iconify-icon icon="tabler:checks"
                                                class="fs-18 text-dark align-middle"></iconify-icon> Mark all
                                            read</small>
                                    </a>
                                </span>
                                Notifications
                            </h5>
                        </div>

                        <div class="noti-scroll" data-simplebar id="notification-list">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <a href="#" class="dropdown-item notify-item">
                                    <div class="d-flex align-items-start">
                                        <div
                                            class="notify-icon bg-{{ $notification->data['type'] ?? 'primary' }}-subtle text-{{ $notification->data['type'] ?? 'primary' }}">
                                            <iconify-icon
                                                icon="{{ $notification->data['icon'] ?? 'tabler:info-circle' }}"
                                                class="fs-18"></iconify-icon>
                                        </div>
                                        <div class="notify-details ms-2">
                                            <h6 class="notify-title mb-1 fw-semibold">
                                                {{ $notification->data['title'] ?? 'Notification' }}
                                            </h6>
                                            <p class="notify-desc mb-0 text-muted fs-12">
                                                {{ $notification->data['message'] ?? '' }}
                                            </p>
                                            <p class="notify-time mb-0 text-muted fs-11">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="dropdown-item text-center p-3 text-muted">
                                    <small>No new notifications</small>
                                </div>
                            @endforelse
                        </div>

                        <a href="javascript:void(0);" id="view-all-notifications"
                            class="dropdown-item text-center text-dark notify-item notify-all bg-light">
                            View all <i class="fe-arrow-right"></i>
                        </a>
                    </div>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ auth()->user()->profile_image ?: 'https://ui-avatars.com/api/?name=' . auth()->user()->name }}"
                            alt="user-image" class="rounded-circle" style="object-fit: cover;" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome {{ auth()->user()->name }}!</h6>
                        </div>
                        <a href="{{ route('admin.profile.edit') }}" class="dropdown-item notify-item">
                            <iconify-icon icon="tabler:user-square-rounded" class="fs-18 align-middle"></iconify-icon>
                            <span>My Account</span>
                        </a>
                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                            @csrf
                        </form>

                        <a href="javascript:void(0);" class="dropdown-item notify-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <iconify-icon icon="tabler:logout" class="fs-18 align-middle"></iconify-icon>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationsModalLabel">All Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="all-notifications-list">
                <div class="text-center text-muted py-4">Loading notifications...</div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            const feedUrl = @json(route('notifications.feed'));
            const allUrl = @json(route('notifications.all'));
            const badge = $('#notification-badge');
            const list = $('#notification-list');
            const allList = $('#all-notifications-list');
            const notificationsModal = new bootstrap.Modal(document.getElementById('notificationsModal'));

            function renderNotifications(items) {
                if (!items.length) {
                    return `
                        <div class="dropdown-item text-center p-3 text-muted">
                            <small>No new notifications</small>
                        </div>
                    `;
                }

                return items.map(function(item) {
                    return `
                        <a href="#" class="dropdown-item notify-item">
                            <div class="d-flex align-items-start">
                                <div class="notify-icon bg-${item.type}-subtle text-${item.type}">
                                    <iconify-icon icon="${item.icon}" class="fs-18"></iconify-icon>
                                </div>
                                <div class="notify-details ms-2">
                                    <h6 class="notify-title mb-1 fw-semibold">${item.title}</h6>
                                    <p class="notify-desc mb-0 text-muted fs-12">${item.message}</p>
                                    <p class="notify-time mb-0 text-muted fs-11">${item.time}</p>
                                </div>
                            </div>
                        </a>
                    `;
                }).join('');
            }

            function renderAllNotifications(items) {
                if (!items.length) {
                    return '<div class="text-center text-muted py-4">No notifications found.</div>';
                }

                return items.map(function(item) {
                    const readBadge = item.read
                        ? '<span class="badge bg-light text-muted border">Read</span>'
                        : '<span class="badge bg-primary-subtle text-primary">Unread</span>';

                    return `
                        <div class="border rounded-3 p-3 mb-3">
                            <div class="d-flex align-items-start justify-content-between gap-3">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="notify-icon bg-${item.type}-subtle text-${item.type}">
                                        <iconify-icon icon="${item.icon}" class="fs-18"></iconify-icon>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">${item.title}</h6>
                                        <p class="mb-1 text-muted">${item.message}</p>
                                        <small class="text-muted">${item.time}</small>
                                    </div>
                                </div>
                                ${readBadge}
                            </div>
                        </div>
                    `;
                }).join('');
            }

            function refreshNotifications() {
                $.get(feedUrl)
                    .done(function(response) {
                        const count = Number(response.count || 0);
                        badge.text(count);
                        badge.toggleClass('d-none', count === 0);
                        list.html(renderNotifications(response.notifications || []));
                    });
            }

            $('#view-all-notifications').on('click', function() {
                notificationsModal.show();
                allList.html('<div class="text-center text-muted py-4">Loading notifications...</div>');

                $.get(allUrl)
                    .done(function(response) {
                        allList.html(renderAllNotifications(response.notifications || []));
                    })
                    .fail(function() {
                        allList.html('<div class="text-center text-danger py-4">Failed to load notifications.</div>');
                    });
            });

            setInterval(refreshNotifications, 15000);
        });
    </script>
@endpush
