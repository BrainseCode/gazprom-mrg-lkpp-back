<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PressureGauge;
use App\Http\Controllers\Controller;
use App\Http\Resources\PressureGaugeResource;
use App\Http\Resources\PressureGaugeCollection;
use App\Http\Requests\PressureGaugeStoreRequest;
use App\Http\Requests\PressureGaugeUpdateRequest;

class PressureGaugeController extends Controller
{
    public function index(Request $request): PressureGaugeCollection
    {
        $this->authorize('view-any', PressureGauge::class);

        $search = $request->get('search', '');

        $pressureGauges = PressureGauge::search($search)
            ->latest()
            ->paginate();

        return new PressureGaugeCollection($pressureGauges);
    }

    public function store(
        PressureGaugeStoreRequest $request
    ): PressureGaugeResource {
        $this->authorize('create', PressureGauge::class);

        $validated = $request->validated();

        $pressureGauge = PressureGauge::create($validated);

        return new PressureGaugeResource($pressureGauge);
    }

    public function show(
        Request $request,
        PressureGauge $pressureGauge
    ): PressureGaugeResource {
        $this->authorize('view', $pressureGauge);

        return new PressureGaugeResource($pressureGauge);
    }

    public function update(
        PressureGaugeUpdateRequest $request,
        PressureGauge $pressureGauge
    ): PressureGaugeResource {
        $this->authorize('update', $pressureGauge);

        $validated = $request->validated();

        $pressureGauge->update($validated);

        return new PressureGaugeResource($pressureGauge);
    }

    public function destroy(
        Request $request,
        PressureGauge $pressureGauge
    ): Response {
        $this->authorize('delete', $pressureGauge);

        $pressureGauge->delete();

        return response()->noContent();
    }
}
