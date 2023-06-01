<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Http\Response;
use App\Models\NotificationStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCollection;

class NotificationStatusNotificationsController extends Controller
{
    public function index(
        Request $request,
        NotificationStatus $notificationStatus
    ): NotificationCollection {
        $this->authorize('view', $notificationStatus);

        $search = $request->get('search', '');

        $notifications = $notificationStatus
            ->notifications()
            ->search($search)
            ->latest()
            ->paginate();

        return new NotificationCollection($notifications);
    }

    public function store(
        Request $request,
        NotificationStatus $notificationStatus,
        Notification $notification
    ): Response {
        $this->authorize('update', $notificationStatus);

        $notificationStatus
            ->notifications()
            ->syncWithoutDetaching([$notification->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        NotificationStatus $notificationStatus,
        Notification $notification
    ): Response {
        $this->authorize('update', $notificationStatus);

        $notificationStatus->notifications()->detach($notification);

        return response()->noContent();
    }
}
