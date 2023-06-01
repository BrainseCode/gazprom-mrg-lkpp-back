<?php

namespace App\Http\Controllers\Api;

use App\Models\Indication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationResource;
use App\Http\Resources\IndicationCollection;
use App\Http\Requests\IndicationStoreRequest;
use App\Http\Requests\IndicationUpdateRequest;

class IndicationController extends Controller
{
    public function index(Request $request): IndicationCollection
    {
        $this->authorize('view-any', Indication::class);

        $search = $request->get('search', '');

        $indications = Indication::search($search)
            ->latest()
            ->paginate();

        return new IndicationCollection($indications);
    }

    public function store(IndicationStoreRequest $request): IndicationResource
    {
        $this->authorize('create', Indication::class);

        $validated = $request->validated();

        $indication = Indication::create($validated);

        return new IndicationResource($indication);
    }

    public function show(
        Request $request,
        Indication $indication
    ): IndicationResource {
        $this->authorize('view', $indication);

        return new IndicationResource($indication);
    }

    public function update(
        IndicationUpdateRequest $request,
        Indication $indication
    ): IndicationResource {
        $this->authorize('update', $indication);

        $validated = $request->validated();

        $indication->update($validated);

        return new IndicationResource($indication);
    }

    public function destroy(Request $request, Indication $indication): Response
    {
        $this->authorize('delete', $indication);

        $indication->delete();

        return response()->noContent();
    }
}
