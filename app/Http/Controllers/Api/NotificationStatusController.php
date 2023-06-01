<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\NotificationStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationStatusResource;
use App\Http\Resources\NotificationStatusCollection;
use App\Http\Requests\NotificationStatusStoreRequest;
use App\Http\Requests\NotificationStatusUpdateRequest;

class NotificationStatusController extends Controller
{
    public function index(Request $request): NotificationStatusCollection
    {
        $this->authorize('view-any', NotificationStatus::class);

        $search = $request->get('search', '');

        $notificationStatuses = NotificationStatus::search($search)
            ->latest()
            ->paginate();

        return new NotificationStatusCollection($notificationStatuses);
    }

    public function store(
        NotificationStatusStoreRequest $request
    ): NotificationStatusResource {
        $this->authorize('create', NotificationStatus::class);

        $validated = $request->validated();

        $notificationStatus = NotificationStatus::create($validated);

        return new NotificationStatusResource($notificationStatus);
    }

    public function show(
        Request $request,
        NotificationStatus $notificationStatus
    ): NotificationStatusResource {
        $this->authorize('view', $notificationStatus);

        return new NotificationStatusResource($notificationStatus);
    }

    public function update(
        NotificationStatusUpdateRequest $request,
        NotificationStatus $notificationStatus
    ): NotificationStatusResource {
        $this->authorize('update', $notificationStatus);

        $validated = $request->validated();

        $notificationStatus->update($validated);

        return new NotificationStatusResource($notificationStatus);
    }

    public function destroy(
        Request $request,
        NotificationStatus $notificationStatus
    ): Response {
        $this->authorize('delete', $notificationStatus);

        $notificationStatus->delete();

        return response()->noContent();
    }
}
