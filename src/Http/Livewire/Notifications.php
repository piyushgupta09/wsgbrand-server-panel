<?php

namespace Fpaipl\Panel\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $type;
    public $notifications;
    public $hasNotification;

    public function mount()
    {
        $this->type = 'all'; // 'read', 'unread
        $this->hasNotification = false;
        
        /** @var User $currentUser */
        $currentUser = auth()->user();

        // Eager load notifications from the last 7 days
        $currentUser->load(['notifications' => function ($query) {
            $query->where('created_at', '>=', \Carbon\Carbon::now()->subDays(7))
                ->orderBy('created_at', 'desc');
        }]);

        $this->hasNotification = $currentUser->unreadNotifications->count() > 0;
        
        $this->notifications = $currentUser->notifications
            ->where('created_at', '>=', \Carbon\Carbon::now()->subDays(7))
            ->groupBy(fn($item) => $item->read_at ? 'read' : 'unread')
            ->map(fn($group) => $group->map(fn($notification) => 
                array_merge($notification->data, ['id' => $notification->id])
            ))
            ->toArray();

        // loop thru all notifications and mark as read
        $currentUser->unreadNotifications->markAsRead();
    }

    public function markAsRead($notificationId)
    {
        dd($notificationId);
        /** @var User $currentUser */
        $currentUser = auth()->user();
        $notification = $currentUser->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
            $this->mount(); // Refresh notifications list and count
        }
    }   

    public function getTimeAgo($timestamp)
    {
        return \Carbon\Carbon::parse($timestamp)->diffForHumans();
    }
    
    public function render()
    {
        return view('panel::livewire.notifications', [
            'notifications' => $this->notifications,
            'hasNotification' => $this->hasNotification,
        ]);
    }
}
