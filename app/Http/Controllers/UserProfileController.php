<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserProfileStoreRequest;
use App\Http\Requests\UserProfileUpdateRequest;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', UserProfile::class);

        $search = $request->get('search', '');

        $userProfiles = UserProfile::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.user_profiles.index',
            compact('userProfiles', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', UserProfile::class);

        $users = User::pluck('name', 'id');

        return view('app.user_profiles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserProfileStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', UserProfile::class);

        $validated = $request->validated();

        $userProfile = UserProfile::create($validated);

        return redirect()
            ->route('user-profiles.edit', $userProfile)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, UserProfile $userProfile): View
    {
        $this->authorize('view', $userProfile);

        return view('app.user_profiles.show', compact('userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, UserProfile $userProfile): View
    {
        $this->authorize('update', $userProfile);

        $users = User::pluck('name', 'id');

        return view('app.user_profiles.edit', compact('userProfile', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UserProfileUpdateRequest $request,
        UserProfile $userProfile
    ): RedirectResponse {
        $this->authorize('update', $userProfile);

        $validated = $request->validated();

        $userProfile->update($validated);

        return redirect()
            ->route('user-profiles.edit', $userProfile)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        UserProfile $userProfile
    ): RedirectResponse {
        $this->authorize('delete', $userProfile);

        $userProfile->delete();

        return redirect()
            ->route('user-profiles.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
