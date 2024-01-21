<?php

namespace Fpaipl\Panel\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Fpaipl\Panel\Events\ReloadDataEvent;

class NotificationBell extends Component
{
    public $count = 0;
    public $notifications;

    protected $listeners = ['refreshComponent' => '$refresh'];


    public function mount()
    {
        $user = User::findOrfail(1);
        $this->notifications = $user->notifications;
        $this->count = $user->unreadNotifications->count();
    }

    public function boot(){
        $this->mount();
    }

    public function refreshPage()
    {
        // Trigger an event using Pusher
        ReloadDataEvent::dispatch('Page refresh required');

        $user = User::findOrfail(1);
        // Display a notification using Laravel's built-in notification system
        $user->notify(new ReloadDataEvent('Page refreshed'));
    }

    public function render()
    {
        return view('panel::livewire.notification-bell');
    }
}
