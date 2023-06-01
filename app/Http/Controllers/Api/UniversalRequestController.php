<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UniversalRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UniversalRequestResource;
use App\Http\Resources\UniversalRequestCollection;
use App\Http\Requests\UniversalRequestStoreRequest;
use App\Http\Requests\UniversalRequestUpdateRequest;

class UniversalRequestController extends Controller
{
    public function index(Request $request): UniversalRequestCollection
    {
        $this->authorize('view-any', UniversalRequest::class);

        $search = $request->get('search', '');

        $universalRequests = UniversalRequest::search($search)
            ->latest()
            ->paginate();

        return new UniversalRequestCollection($universalRequests);
    }

    public function store(
        UniversalRequestStoreRequest $request
    ): UniversalRequestResource {
        $this->authorize('create', UniversalRequest::class);

        $validated = $request->validated();

        $universalRequest = UniversalRequest::create($validated);

        return new UniversalRequestResource($universalRequest);
    }

    public function show(
        Request $request,
        UniversalRequest $universalRequest
    ): UniversalRequestResource {
        $this->authorize('view', $universalRequest);

        return new UniversalRequestResource($universalRequest);
    }

    public function update(
        UniversalRequestUpdateRequest $request,
        UniversalRequest $universalRequest
    ): UniversalRequestResource {
        $this->authorize('update', $universalRequest);

        $validated = $request->validated();

        $universalRequest->update($validated);

        return new UniversalRequestResource($universalRequest);
    }

    public function destroy(
        Request $request,
        UniversalRequest $universalRequest
    ): Response {
        $this->authorize('delete', $universalRequest);

        $universalRequest->delete();

        return response()->noContent();
    }
}
