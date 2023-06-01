<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UniversalRequestResource;
use App\Http\Resources\UniversalRequestCollection;

class UserUniversalRequestsController extends Controller
{
    public function index(
        Request $request,
        User $user
    ): UniversalRequestCollection {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $universalRequests = $user
            ->universalRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new UniversalRequestCollection($universalRequests);
    }

    public function store(
        Request $request,
        User $user
    ): UniversalRequestResource {
        $this->authorize('create', UniversalRequest::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'message' => ['required', 'max:255', 'string'],
        ]);

        $universalRequest = $user->universalRequests()->create($validated);

        return new UniversalRequestResource($universalRequest);
    }
}
