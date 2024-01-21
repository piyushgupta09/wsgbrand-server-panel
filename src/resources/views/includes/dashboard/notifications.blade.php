<button 
    class="btn border-0" type="button"
    data-bs-toggle="offcanvas" data-bs-target="#toggleNotificationView"
    aria-controls="toggleNotificationView">
    <i class="bi bi-bell-fill {{ isset($hasNotification) ? 'text-danger' : 'text-secondary' }}" style="font-size: 1rem"></i>
</button>

<div class="offcanvas offcanvas-end" tabindex="-1" id="toggleNotificationView"
    aria-labelledby="toggleNotificationViewLabel">
    <div class="offcanvas-header flex-column font-quick bg-info pt-2 pb-0 px-2">
        <div class="d-flex justify-content-between p-2 align-items-center w-100">
            <h5 class="offcanvas-title ls-1" id="toggleNotificationViewLabel">Notifications</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <ul class="nav nav-tabs nav-fill border-info flex-nowrap" id="notificationTabs" role="tablist">
            @foreach (config('panel.tabs.notifications') as $tab)
                @include('panel::includes.dashboard.notification-tab', [
                    'count' => count($notifications[$tab]['unread']),
                    'name' => $tab,
                    'first' => $loop->first,
                ])
            @endforeach
        </ul>
    </div>
    <div class="offcanvas-body p-2">
        <div class="tab-content h-100" id="notificationTabsContent">
            @foreach (config('panel.tabs.notifications') as $tab)
                @include('panel::includes.dashboard.notification-content', [
                    'name' => $tab,
                    'first' => $loop->first,
                ])
            @endforeach
        </div>
    </div>
</div>

<style scoped>
    .nav-tabs .nav-item .nav-link {
        width: 100% !important;
        color: black !important;
        border-top-left-radius: 0.5rem !important;
        border-top-right-radius: 0.5rem !important;
        border-bottom-left-radius: 0rem !important;
        border-bottom-right-radius: 0rem !important;
    }

    .nav-tabs .nav-item .nav-link:hover,
    .nav-tabs .nav-item .nav-link.active {
        background-color: #fff !important;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: #17a2b8 !important;
    }
</style>