<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\IndicationSource;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationSourceResource;
use App\Http\Resources\IndicationSourceCollection;
use App\Http\Requests\IndicationSourceStoreRequest;
use App\Http\Requests\IndicationSourceUpdateRequest;

class IndicationSourceController extends Controller
{
    public function index(Request $request): IndicationSourceCollection
    {
        $this->authorize('view-any', IndicationSource::class);

        $search = $request->get('search', '');

        $indicationSources = IndicationSource::search($search)
            ->latest()
            ->paginate();

        return new IndicationSourceCollection($indicationSources);
    }

    public function store(
        IndicationSourceStoreRequest $request
    ): IndicationSourceResource {
        $this->authorize('create', IndicationSource::class);

        $validated = $request->validated();

        $indicationSource = IndicationSource::create($validated);

        return new IndicationSourceResource($indicationSource);
    }

    public function show(
        Request $request,
        IndicationSource $indicationSource
    ): IndicationSourceResource {
        $this->authorize('view', $indicationSource);

        return new IndicationSourceResource($indicationSource);
    }

    public function update(
        IndicationSourceUpdateRequest $request,
        IndicationSource $indicationSource
    ): IndicationSourceResource {
        $this->authorize('update', $indicationSource);

        $validated = $request->validated();

        $indicationSource->update($validated);

        return new IndicationSourceResource($indicationSource);
    }

    public function destroy(
        Request $request,
        IndicationSource $indicationSource
    ): Response {
        $this->authorize('delete', $indicationSource);

        $indicationSource->delete();

        return response()->noContent();
    }
}
