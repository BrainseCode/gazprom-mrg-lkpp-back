<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\NotificationStatus;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NotificationStatusStoreRequest;
use App\Http\Requests\NotificationStatusUpdateRequest;

class NotificationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', NotificationStatus::class);

        $search = $request->get('search', '');

        $notificationStatuses = NotificationStatus::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.notification_statuses.index',
            compact('notificationStatuses', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', NotificationStatus::class);

        return view('app.notification_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        NotificationStatusStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', NotificationStatus::class);

        $validated = $request->validated();

        $notificationStatus = NotificationStatus::create($validated);

        return redirect()
            ->route('notification-statuses.edit', $notificationStatus)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        NotificationStatus $notificationStatus
    ): View {
        $this->authorize('view', $notificationStatus);

        return view(
            'app.notification_statuses.show',
            compact('notificationStatus')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        NotificationStatus $notificationStatus
    ): View {
        $this->authorize('update', $notificationStatus);

        return view(
            'app.notification_statuses.edit',
            compact('notificationStatus')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        NotificationStatusUpdateRequest $request,
        NotificationStatus $notificationStatus
    ): RedirectResponse {
        $this->authorize('update', $notificationStatus);

        $validated = $request->validated();

        $notificationStatus->update($validated);

        return redirect()
            ->route('notification-statuses.edit', $notificationStatus)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        NotificationStatus $notificationStatus
    ): RedirectResponse {
        $this->authorize('delete', $notificationStatus);

        $notificationStatus->delete();

        return redirect()
            ->route('notification-statuses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
