<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NotificationStoreRequest;
use App\Http\Requests\NotificationUpdateRequest;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Notification::class);

        $search = $request->get('search', '');

        $notifications = Notification::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.notifications.index',
            compact('notifications', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Notification::class);

        $users = User::pluck('name', 'id');

        return view('app.notifications.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificationStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Notification::class);

        $validated = $request->validated();

        $notification = Notification::create($validated);

        return redirect()
            ->route('notifications.edit', $notification)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Notification $notification): View
    {
        $this->authorize('view', $notification);

        return view('app.notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Notification $notification): View
    {
        $this->authorize('update', $notification);

        $users = User::pluck('name', 'id');

        return view('app.notifications.edit', compact('notification', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        NotificationUpdateRequest $request,
        Notification $notification
    ): RedirectResponse {
        $this->authorize('update', $notification);

        $validated = $request->validated();

        $notification->update($validated);

        return redirect()
            ->route('notifications.edit', $notification)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Notification $notification
    ): RedirectResponse {
        $this->authorize('delete', $notification);

        $notification->delete();

        return redirect()
            ->route('notifications.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
