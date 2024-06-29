<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
     //
     public function markAsRead(Request $request)
     {
         $user = auth()->guard('ltouser')->user();
         if ($user) {
             $user->unreadNotifications->markAsRead();
             return response()->json(['status' => 'success']);
         }
         return response()->json(['status' => 'error', 'message' => 'User not authenticated'], 401);
     }
}
