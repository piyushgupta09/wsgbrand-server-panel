<?php

namespace Fpaipl\Panel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Fpaipl\Panel\Events\ReloadDataEvent;

class PusherController extends Controller
{
    public function push(Request $request)
    {
        ReloadDataEvent::dispatch($request->message);
        return redirect()->route('pusher.index')->with('success', true);
    }
}
