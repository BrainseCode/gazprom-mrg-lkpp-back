<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\IndicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationStatusResource;
use App\Http\Resources\IndicationStatusCollection;
use App\Http\Requests\IndicationStatusStoreRequest;
use App\Http\Requests\IndicationStatusUpdateRequest;

class IndicationStatusController extends Controller
{
    public function index(Request $request): IndicationStatusCollection
    {
        $this->authorize('view-any', IndicationStatus::class);

        $search = $request->get('search', '');

        $indicationStatuses = IndicationStatus::search($search)
            ->latest()
            ->paginate();

        return new IndicationStatusCollection($indicationStatuses);
    }

    public function store(
        IndicationStatusStoreRequest $request
    ): IndicationStatusResource {
        $this->authorize('create', IndicationStatus::class);

        $validated = $request->validated();

        $indicationStatus = IndicationStatus::create($validated);

        return new IndicationStatusResource($indicationStatus);
    }

    public function show(
        Request $request,
        IndicationStatus $indicationStatus
    ): IndicationStatusResource {
        $this->authorize('view', $indicationStatus);

        return new IndicationStatusResource($indicationStatus);
    }

    public function update(
        IndicationStatusUpdateRequest $request,
        IndicationStatus $indicationStatus
    ): IndicationStatusResource {
        $this->authorize('update', $indicationStatus);

        $validated = $request->validated();

        $indicationStatus->update($validated);

        return new IndicationStatusResource($indicationStatus);
    }

    public function destroy(
        Request $request,
        IndicationStatus $indicationStatus
    ): Response {
        $this->authorize('delete', $indicationStatus);

        $indicationStatus->delete();

        return response()->noContent();
    }
}
