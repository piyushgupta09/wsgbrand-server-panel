<div class="">

    <button class="btn border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#toggleNotificationView"
        aria-controls="toggleNotificationView">
        <i class="bi bi-bell-fill {{ isset($hasNotification) ? 'text-danger' : 'text-secondary' }}"
            style="font-size: 1rem"></i>
    </button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="toggleNotificationView"
        aria-labelledby="toggleNotificationViewLabel">
        <div class="offcanvas-header flex-column font-quick bg-primary pt-2 pb-0 px-2">
            <div class="d-flex justify-content-between p-2 align-items-center w-100">
                <p class="offcanvas-title ls-1 fw-bold" id="toggleNotificationViewLabel">Notifications</p>
                <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="bi bi-x-lg text-white"></i>
                </button>
            </div>
        </div>
        <div class="offcanvas-body p-0">
            <div class="d-flex flex-column h-100">

                <ul class="list-group flex-fill">

                    @if (!empty($notifications['unread']))
                    {{-- <div class="list-group-item rounded-0 text-center py-5">
                        <p class="mb-0">No Unread notifications !</p>
                    </div>
                    @else --}}
                    @foreach ($notifications['unread'] as $notification)
                    <button class="list-group-item rounded-0 px-3 py-2 border-bottom btn text-start"
                        style="background-color: rgb(162, 193, 246)" type="button"
                        wire:click="markAsRead('{{ $notification['id'] }}')">
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="mb-0 fw-bold small font-quick text-capitalize">{{ $notification['title'] }}</p>
                            <p class="mb-0 smaller font-quick text-end">{{
                                \Carbon\Carbon::parse($notification['time'])->diffForHumans() }}</p>
                        </div>
                        <p class="mb-0 font-title">{{ $notification['message'] }}</p>
                    </button>
                    @endforeach
                    @endif

                    @if (!empty($notifications['read']))
                    @foreach ($notifications['read'] as $notification)
                    <a class="list-group-item rounded-0 px-3 py-2 border-bottom btn text-start"
                        href="{{ $notification['route'] }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="mb-0 fw-bold small font-quick text-capitalize">{{ $notification['title'] }}</p>
                            <p class="mb-0 smaller font-quick text-end">{{
                                \Carbon\Carbon::parse($notification['time'])->diffForHumans() }}</p>
                        </div>
                        <p class="mb-0 font-title">{{ $notification['message'] }}</p>
                    </a>
                    @endforeach
                    @endif

                </ul>
                <a href="{{ route('notifications.index',[ 'type' =>  $type ]) }}" class="btn btn-primary rounded-0">
                    Show Older Notifications
                </a>
            </div>
        </div>
    </div>


</div>