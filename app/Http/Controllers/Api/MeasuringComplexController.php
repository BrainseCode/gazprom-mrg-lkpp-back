<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\MeasuringComplex;
use App\Http\Controllers\Controller;
use App\Http\Resources\MeasuringComplexResource;
use App\Http\Resources\MeasuringComplexCollection;
use App\Http\Requests\MeasuringComplexStoreRequest;
use App\Http\Requests\MeasuringComplexUpdateRequest;

class MeasuringComplexController extends Controller
{
    public function index(Request $request): MeasuringComplexCollection
    {
        $this->authorize('view-any', MeasuringComplex::class);

        $search = $request->get('search', '');

        $measuringComplexes = MeasuringComplex::search($search)
            ->latest()
            ->paginate();

        return new MeasuringComplexCollection($measuringComplexes);
    }

    public function store(
        MeasuringComplexStoreRequest $request
    ): MeasuringComplexResource {
        $this->authorize('create', MeasuringComplex::class);

        $validated = $request->validated();

        $measuringComplex = MeasuringComplex::create($validated);

        return new MeasuringComplexResource($measuringComplex);
    }

    public function show(
        Request $request,
        MeasuringComplex $measuringComplex
    ): MeasuringComplexResource {
        $this->authorize('view', $measuringComplex);

        return new MeasuringComplexResource($measuringComplex);
    }

    public function update(
        MeasuringComplexUpdateRequest $request,
        MeasuringComplex $measuringComplex
    ): MeasuringComplexResource {
        $this->authorize('update', $measuringComplex);

        $validated = $request->validated();

        $measuringComplex->update($validated);

        return new MeasuringComplexResource($measuringComplex);
    }

    public function destroy(
        Request $request,
        MeasuringComplex $measuringComplex
    ): Response {
        $this->authorize('delete', $measuringComplex);

        $measuringComplex->delete();

        return response()->noContent();
    }
}
