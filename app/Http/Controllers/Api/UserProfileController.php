<?php

namespace App\Http\Controllers\Api;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\UserProfileCollection;
use App\Http\Requests\UserProfileStoreRequest;
use App\Http\Requests\UserProfileUpdateRequest;

class UserProfileController extends Controller
{
    public function index(Request $request): UserProfileCollection
    {
        $this->authorize('view-any', UserProfile::class);

        $search = $request->get('search', '');

        $userProfiles = UserProfile::search($search)
            ->latest()
            ->paginate();

        return new UserProfileCollection($userProfiles);
    }

    public function store(UserProfileStoreRequest $request): UserProfileResource
    {
        $this->authorize('create', UserProfile::class);

        $validated = $request->validated();

        $userProfile = UserProfile::create($validated);

        return new UserProfileResource($userProfile);
    }

    public function show(
        Request $request,
        UserProfile $userProfile
    ): UserProfileResource {
        $this->authorize('view', $userProfile);

        return new UserProfileResource($userProfile);
    }

    public function update(
        UserProfileUpdateRequest $request,
        UserProfile $userProfile
    ): UserProfileResource {
        $this->authorize('update', $userProfile);

        $validated = $request->validated();

        $userProfile->update($validated);

        return new UserProfileResource($userProfile);
    }

    public function destroy(
        Request $request,
        UserProfile $userProfile
    ): Response {
        $this->authorize('delete', $userProfile);

        $userProfile->delete();

        return response()->noContent();
    }
}
