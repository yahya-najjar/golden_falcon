<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllRead()
    {
        foreach (Auth::user()->unreadNotifications as $note) {
            $note->markAsRead();
        }

        return response()->json('done', 200);
    }

    public function markAsRead(){
        DatabaseNotification::find(request()->note_id)->markAsRead();
        return response()->json('done',200);
    }

    public function index(){
        $notifications = Auth::user()->notifications;
        return view('admin.notifications.index', compact('notifications'));
    }

    public function destroy(DatabaseNotification $notification){
        $notification->delete();
        return back()->with('success', 'تم حذف الإشعار!');
    }

    public function destroyAll(){
        DatabaseNotification::truncate();
        return back()->with('success', 'تم حذف جميع الاشعارات!');
    }
}
