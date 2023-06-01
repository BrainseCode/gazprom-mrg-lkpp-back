<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContractStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContractStatusResource;
use App\Http\Resources\ContractStatusCollection;
use App\Http\Requests\ContractStatusStoreRequest;
use App\Http\Requests\ContractStatusUpdateRequest;

class ContractStatusController extends Controller
{
    public function index(Request $request): ContractStatusCollection
    {
        $this->authorize('view-any', ContractStatus::class);

        $search = $request->get('search', '');

        $contractStatuses = ContractStatus::search($search)
            ->latest()
            ->paginate();

        return new ContractStatusCollection($contractStatuses);
    }

    public function store(
        ContractStatusStoreRequest $request
    ): ContractStatusResource {
        $this->authorize('create', ContractStatus::class);

        $validated = $request->validated();

        $contractStatus = ContractStatus::create($validated);

        return new ContractStatusResource($contractStatus);
    }

    public function show(
        Request $request,
        ContractStatus $contractStatus
    ): ContractStatusResource {
        $this->authorize('view', $contractStatus);

        return new ContractStatusResource($contractStatus);
    }

    public function update(
        ContractStatusUpdateRequest $request,
        ContractStatus $contractStatus
    ): ContractStatusResource {
        $this->authorize('update', $contractStatus);

        $validated = $request->validated();

        $contractStatus->update($validated);

        return new ContractStatusResource($contractStatus);
    }

    public function destroy(
        Request $request,
        ContractStatus $contractStatus
    ): Response {
        $this->authorize('delete', $contractStatus);

        $contractStatus->delete();

        return response()->noContent();
    }
}
