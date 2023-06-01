<?php

namespace App\Http\Controllers\Api;

use App\Models\Meter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MeterResource;
use App\Http\Resources\MeterCollection;
use App\Http\Requests\MeterStoreRequest;
use App\Http\Requests\MeterUpdateRequest;

class MeterController extends Controller
{
    public function index(Request $request): MeterCollection
    {
        $this->authorize('view-any', Meter::class);

        $search = $request->get('search', '');

        $meters = Meter::search($search)
            ->latest()
            ->paginate();

        return new MeterCollection($meters);
    }

    public function store(MeterStoreRequest $request): MeterResource
    {
        $this->authorize('create', Meter::class);

        $validated = $request->validated();

        $meter = Meter::create($validated);

        return new MeterResource($meter);
    }

    public function show(Request $request, Meter $meter): MeterResource
    {
        $this->authorize('view', $meter);

        return new MeterResource($meter);
    }

    public function update(
        MeterUpdateRequest $request,
        Meter $meter
    ): MeterResource {
        $this->authorize('update', $meter);

        $validated = $request->validated();

        $meter->update($validated);

        return new MeterResource($meter);
    }

    public function destroy(Request $request, Meter $meter): Response
    {
        $this->authorize('delete', $meter);

        $meter->delete();

        return response()->noContent();
    }
}
