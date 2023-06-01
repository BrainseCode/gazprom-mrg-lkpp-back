<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\IndicationQuarter;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationQuarterResource;
use App\Http\Resources\IndicationQuarterCollection;
use App\Http\Requests\IndicationQuarterStoreRequest;
use App\Http\Requests\IndicationQuarterUpdateRequest;

class IndicationQuarterController extends Controller
{
    public function index(Request $request): IndicationQuarterCollection
    {
        $this->authorize('view-any', IndicationQuarter::class);

        $search = $request->get('search', '');

        $indicationQuarters = IndicationQuarter::search($search)
            ->latest()
            ->paginate();

        return new IndicationQuarterCollection($indicationQuarters);
    }

    public function store(
        IndicationQuarterStoreRequest $request
    ): IndicationQuarterResource {
        $this->authorize('create', IndicationQuarter::class);

        $validated = $request->validated();

        $indicationQuarter = IndicationQuarter::create($validated);

        return new IndicationQuarterResource($indicationQuarter);
    }

    public function show(
        Request $request,
        IndicationQuarter $indicationQuarter
    ): IndicationQuarterResource {
        $this->authorize('view', $indicationQuarter);

        return new IndicationQuarterResource($indicationQuarter);
    }

    public function update(
        IndicationQuarterUpdateRequest $request,
        IndicationQuarter $indicationQuarter
    ): IndicationQuarterResource {
        $this->authorize('update', $indicationQuarter);

        $validated = $request->validated();

        $indicationQuarter->update($validated);

        return new IndicationQuarterResource($indicationQuarter);
    }

    public function destroy(
        Request $request,
        IndicationQuarter $indicationQuarter
    ): Response {
        $this->authorize('delete', $indicationQuarter);

        $indicationQuarter->delete();

        return response()->noContent();
    }
}
