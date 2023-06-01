<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\RequestApprovalUnevenness;
use App\Http\Resources\RequestApprovalUnevennessResource;
use App\Http\Resources\RequestApprovalUnevennessCollection;
use App\Http\Requests\RequestApprovalUnevennessStoreRequest;
use App\Http\Requests\RequestApprovalUnevennessUpdateRequest;

class RequestApprovalUnevennessController extends Controller
{
    public function index(Request $request): RequestApprovalUnevennessCollection
    {
        $this->authorize('view-any', RequestApprovalUnevenness::class);

        $search = $request->get('search', '');

        $requestApprovalUnevennesses = RequestApprovalUnevenness::search(
            $search
        )
            ->latest()
            ->paginate();

        return new RequestApprovalUnevennessCollection(
            $requestApprovalUnevennesses
        );
    }

    public function store(
        RequestApprovalUnevennessStoreRequest $request
    ): RequestApprovalUnevennessResource {
        $this->authorize('create', RequestApprovalUnevenness::class);

        $validated = $request->validated();

        $requestApprovalUnevenness = RequestApprovalUnevenness::create(
            $validated
        );

        return new RequestApprovalUnevennessResource(
            $requestApprovalUnevenness
        );
    }

    public function show(
        Request $request,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): RequestApprovalUnevennessResource {
        $this->authorize('view', $requestApprovalUnevenness);

        return new RequestApprovalUnevennessResource(
            $requestApprovalUnevenness
        );
    }

    public function update(
        RequestApprovalUnevennessUpdateRequest $request,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): RequestApprovalUnevennessResource {
        $this->authorize('update', $requestApprovalUnevenness);

        $validated = $request->validated();

        $requestApprovalUnevenness->update($validated);

        return new RequestApprovalUnevennessResource(
            $requestApprovalUnevenness
        );
    }

    public function destroy(
        Request $request,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): Response {
        $this->authorize('delete', $requestApprovalUnevenness);

        $requestApprovalUnevenness->delete();

        return response()->noContent();
    }
}
