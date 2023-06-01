<?php

namespace App\Http\Controllers\Api;

use App\Models\Thermometer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ThermometerResource;
use App\Http\Resources\ThermometerCollection;
use App\Http\Requests\ThermometerStoreRequest;
use App\Http\Requests\ThermometerUpdateRequest;

class ThermometerController extends Controller
{
    public function index(Request $request): ThermometerCollection
    {
        $this->authorize('view-any', Thermometer::class);

        $search = $request->get('search', '');

        $thermometers = Thermometer::search($search)
            ->latest()
            ->paginate();

        return new ThermometerCollection($thermometers);
    }

    public function store(ThermometerStoreRequest $request): ThermometerResource
    {
        $this->authorize('create', Thermometer::class);

        $validated = $request->validated();

        $thermometer = Thermometer::create($validated);

        return new ThermometerResource($thermometer);
    }

    public function show(
        Request $request,
        Thermometer $thermometer
    ): ThermometerResource {
        $this->authorize('view', $thermometer);

        return new ThermometerResource($thermometer);
    }

    public function update(
        ThermometerUpdateRequest $request,
        Thermometer $thermometer
    ): ThermometerResource {
        $this->authorize('update', $thermometer);

        $validated = $request->validated();

        $thermometer->update($validated);

        return new ThermometerResource($thermometer);
    }

    public function destroy(
        Request $request,
        Thermometer $thermometer
    ): Response {
        $this->authorize('delete', $thermometer);

        $thermometer->delete();

        return response()->noContent();
    }
}
