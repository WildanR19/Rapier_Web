<?php

namespace App\Http\Controllers;

use App\Models\Leave;

class NotificationController extends Controller
{
    public function index()
    {
        $leave = Leave::where('status', 'pending')->orderByDesc('created_at')->get();
        auth()->user()->unreadNotifications->markAsRead();
        return view('notifications.index')->with('leaves', $leave);
    }
}
