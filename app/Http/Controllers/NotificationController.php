<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Product;

class NotificationController extends Controller
{
    public function index()
    {
// Fetch all unread notifications
$unreadNotifications = Notification::whereNull('read_at')->get()->map(function ($notification) {
    $data = json_decode($notification->data, true);

    // Include notification ID directly
    $data['id'] = $notification->id;

    // Fetch user name based on user ID
    if (isset($data['user->id'])) {
        $userName = User::find($data['user->id'])->name ?? 'Unknown User';
        // Replace user ID with user name
        $data['user_name'] = $userName;
        unset($data['user->id']); // Remove user ID
    }

    // Fetch product name based on product ID
    if (isset($data['product_id'])) {
        $productName = Product::find($data['product_id'])->name ?? 'Unknown Product';
        // Replace product ID with product name
        $data['product_name'] = $productName;
        unset($data['product_id']); // Remove product ID
    }

    // Include other notification columns
    $data['type'] = $notification->type;
    $data['notifiable_type'] = $notification->notifiable_type;
    $data['notifiable_id'] = $notification->notifiable_id;
    $data['read_at'] = $notification->read_at;
    $data['created_at'] = $notification->created_at;
    $data['updated_at'] = $notification->updated_at;

    return $data;
});

        // Compact only the 'data' column
        return view('backend.notifications.index', compact('unreadNotifications'));
    }

}
