<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Http\Response;
use App\Models\NotificationStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationStatusCollection;

class NotificationNotificationStatusesController extends Controller
{
    public function index(
        Request $request,
        Notification $notification
    ): NotificationStatusCollection {
        $this->authorize('view', $notification);

        $search = $request->get('search', '');

        $notificationStatuses = $notification
            ->notificationStatuses()
            ->search($search)
            ->latest()
            ->paginate();

        return new NotificationStatusCollection($notificationStatuses);
    }

    public function store(
        Request $request,
        Notification $notification,
        NotificationStatus $notificationStatus
    ): Response {
        $this->authorize('update', $notification);

        $notification
            ->notificationStatuses()
            ->syncWithoutDetaching([$notificationStatus->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Notification $notification,
        NotificationStatus $notificationStatus
    ): Response {
        $this->authorize('update', $notification);

        $notification->notificationStatuses()->detach($notificationStatus);

        return response()->noContent();
    }
}
