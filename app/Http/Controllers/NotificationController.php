<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\SetTimer;
use App\Models\Product;
use Carbon\Carbon;

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

    public function approveNotification($notifiableId)
    {
        // Find the notification based on notifiable_id
        $notification = Notification::where('notifiable_id', $notifiableId)->first();

        if ($notification) {
            // Update the read_at value to the current date and time
            $notification->read_at = Carbon::now();
            $notification->save();

            // Decode the notification data to get product_id
            $data = json_decode($notification->data, true);
            $productId = $data['product_id'];

            // Find the set_timer record based on product_id
            $setTimer = SetTimer::where('product_id', $productId)->first();

            if ($setTimer) {
                // Update the status value to 1
                $setTimer->status = 1;
                $setTimer->save();
            }

            return redirect()->route('backend.notifications.index')
                        ->with('success', 'Notification approved and timer status updated.');
        } else {
            return response()->json(['message' => 'Notification not found.'], 404);
        }
    }

    public function rejectNotification($notifiableId)
{
    // Find the notification based on notifiable_id
    $notification = Notification::where('notifiable_id', $notifiableId)->first();

    if ($notification) {
        // Update the read_at value to the current date and time
        $notification->read_at = Carbon::now();
        $notification->save();

        // Decode the notification data to get product_id
        $data = json_decode($notification->data, true);
        $productId = $data['product_id'];

        // Find the set_timer record based on product_id
        $setTimer = SetTimer::where('product_id', $productId)->first();

        if ($setTimer) {
            // Update the status value to 2
            $setTimer->status = 2;
            $setTimer->save();
        }

        return redirect()->route('backend.notifications.index')
                    ->with('errors', 'Notification rejected and timer status updated.');
    } else {
        return response()->json(['message' => 'Notification not found.'], 404);
    }
}

}
