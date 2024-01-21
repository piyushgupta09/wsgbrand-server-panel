<div class="tab-pane h-100 fade {{ $first ? 'show active' : '' }}" id="{{ $name }}-tab-pane"
    role="tabpanel" aria-labelledby="{{ $name }}-tab" tabindex="0">
    <div class="d-flex flex-column h-100">
        <ul class="list-group flex-fill">
            @foreach ($notifications[$name]['unread'] as $notification)
                @include('panel::includes.dashboard.notification-item-unread')
            @endforeach
            @foreach ($notifications[$name]['read'] as $notification)
                @include('panel::includes.dashboard.notification-item-read')
            @endforeach
        </ul>
        <a href="{{ route('notifications',[ 'type' =>  $name ]) }}" 
            class="btn btn-outline-dark rounded-0">
            Show More
        </a>
    </div>
</div>
