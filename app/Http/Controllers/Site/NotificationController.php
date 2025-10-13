<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead()
{
    Notification::where('user_id', auth()->id()) // الإشعارات الخاصة باليوزر اللي عامل تسجيل دخول
        ->where('is_read', false) // اللي لسه متقريتش
        ->update(['is_read' => true]); // نخليها مقروءة

    return response()->json(['success' => true]);
}

}
