<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\NotificationCollection;
use App\Http\Requests\NotificationStoreRequest;
use App\Http\Requests\NotificationUpdateRequest;

class NotificationController extends Controller
{
    public function index(Request $request): NotificationCollection
    {
        $this->authorize('view-any', Notification::class);

        $search = $request->get('search', '');

        $notifications = Notification::search($search)
            ->latest()
            ->paginate();

        return new NotificationCollection($notifications);
    }

    public function store(
        NotificationStoreRequest $request
    ): NotificationResource {
        $this->authorize('create', Notification::class);

        $validated = $request->validated();

        $notification = Notification::create($validated);

        return new NotificationResource($notification);
    }

    public function show(
        Request $request,
        Notification $notification
    ): NotificationResource {
        $this->authorize('view', $notification);

        return new NotificationResource($notification);
    }

    public function update(
        NotificationUpdateRequest $request,
        Notification $notification
    ): NotificationResource {
        $this->authorize('update', $notification);

        $validated = $request->validated();

        $notification->update($validated);

        return new NotificationResource($notification);
    }

    public function destroy(
        Request $request,
        Notification $notification
    ): Response {
        $this->authorize('delete', $notification);

        $notification->delete();

        return response()->noContent();
    }
}
