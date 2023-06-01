<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AllIndicationQuarter;
use App\Http\Controllers\Controller;
use App\Http\Resources\AllIndicationQuarterResource;
use App\Http\Resources\AllIndicationQuarterCollection;
use App\Http\Requests\AllIndicationQuarterStoreRequest;
use App\Http\Requests\AllIndicationQuarterUpdateRequest;

class AllIndicationQuarterController extends Controller
{
    public function index(Request $request): AllIndicationQuarterCollection
    {
        $this->authorize('view-any', AllIndicationQuarter::class);

        $search = $request->get('search', '');

        $allIndicationQuarters = AllIndicationQuarter::search($search)
            ->latest()
            ->paginate();

        return new AllIndicationQuarterCollection($allIndicationQuarters);
    }

    public function store(
        AllIndicationQuarterStoreRequest $request
    ): AllIndicationQuarterResource {
        $this->authorize('create', AllIndicationQuarter::class);

        $validated = $request->validated();

        $allIndicationQuarter = AllIndicationQuarter::create($validated);

        return new AllIndicationQuarterResource($allIndicationQuarter);
    }

    public function show(
        Request $request,
        AllIndicationQuarter $allIndicationQuarter
    ): AllIndicationQuarterResource {
        $this->authorize('view', $allIndicationQuarter);

        return new AllIndicationQuarterResource($allIndicationQuarter);
    }

    public function update(
        AllIndicationQuarterUpdateRequest $request,
        AllIndicationQuarter $allIndicationQuarter
    ): AllIndicationQuarterResource {
        $this->authorize('update', $allIndicationQuarter);

        $validated = $request->validated();

        $allIndicationQuarter->update($validated);

        return new AllIndicationQuarterResource($allIndicationQuarter);
    }

    public function destroy(
        Request $request,
        AllIndicationQuarter $allIndicationQuarter
    ): Response {
        $this->authorize('delete', $allIndicationQuarter);

        $allIndicationQuarter->delete();

        return response()->noContent();
    }
}
