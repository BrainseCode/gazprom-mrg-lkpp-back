<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PayGasPlanned;
use App\Http\Controllers\Controller;
use App\Http\Resources\PayGasPlannedResource;
use App\Http\Resources\PayGasPlannedCollection;
use App\Http\Requests\PayGasPlannedStoreRequest;
use App\Http\Requests\PayGasPlannedUpdateRequest;

class PayGasPlannedController extends Controller
{
    public function index(Request $request): PayGasPlannedCollection
    {
        $this->authorize('view-any', PayGasPlanned::class);

        $search = $request->get('search', '');

        $payGasPlanneds = PayGasPlanned::search($search)
            ->latest()
            ->paginate();

        return new PayGasPlannedCollection($payGasPlanneds);
    }

    public function store(
        PayGasPlannedStoreRequest $request
    ): PayGasPlannedResource {
        $this->authorize('create', PayGasPlanned::class);

        $validated = $request->validated();

        $payGasPlanned = PayGasPlanned::create($validated);

        return new PayGasPlannedResource($payGasPlanned);
    }

    public function show(
        Request $request,
        PayGasPlanned $payGasPlanned
    ): PayGasPlannedResource {
        $this->authorize('view', $payGasPlanned);

        return new PayGasPlannedResource($payGasPlanned);
    }

    public function update(
        PayGasPlannedUpdateRequest $request,
        PayGasPlanned $payGasPlanned
    ): PayGasPlannedResource {
        $this->authorize('update', $payGasPlanned);

        $validated = $request->validated();

        $payGasPlanned->update($validated);

        return new PayGasPlannedResource($payGasPlanned);
    }

    public function destroy(
        Request $request,
        PayGasPlanned $payGasPlanned
    ): Response {
        $this->authorize('delete', $payGasPlanned);

        $payGasPlanned->delete();

        return response()->noContent();
    }
}
