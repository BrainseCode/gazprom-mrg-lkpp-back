<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\GasConsumingEquipment;
use App\Http\Resources\GasConsumingEquipmentResource;
use App\Http\Resources\GasConsumingEquipmentCollection;
use App\Http\Requests\GasConsumingEquipmentStoreRequest;
use App\Http\Requests\GasConsumingEquipmentUpdateRequest;

class GasConsumingEquipmentController extends Controller
{
    public function index(Request $request): GasConsumingEquipmentCollection
    {
        $this->authorize('view-any', GasConsumingEquipment::class);

        $search = $request->get('search', '');

        $gasConsumingEquipments = GasConsumingEquipment::search($search)
            ->latest()
            ->paginate();

        return new GasConsumingEquipmentCollection($gasConsumingEquipments);
    }

    public function store(
        GasConsumingEquipmentStoreRequest $request
    ): GasConsumingEquipmentResource {
        $this->authorize('create', GasConsumingEquipment::class);

        $validated = $request->validated();

        $gasConsumingEquipment = GasConsumingEquipment::create($validated);

        return new GasConsumingEquipmentResource($gasConsumingEquipment);
    }

    public function show(
        Request $request,
        GasConsumingEquipment $gasConsumingEquipment
    ): GasConsumingEquipmentResource {
        $this->authorize('view', $gasConsumingEquipment);

        return new GasConsumingEquipmentResource($gasConsumingEquipment);
    }

    public function update(
        GasConsumingEquipmentUpdateRequest $request,
        GasConsumingEquipment $gasConsumingEquipment
    ): GasConsumingEquipmentResource {
        $this->authorize('update', $gasConsumingEquipment);

        $validated = $request->validated();

        $gasConsumingEquipment->update($validated);

        return new GasConsumingEquipmentResource($gasConsumingEquipment);
    }

    public function destroy(
        Request $request,
        GasConsumingEquipment $gasConsumingEquipment
    ): Response {
        $this->authorize('delete', $gasConsumingEquipment);

        $gasConsumingEquipment->delete();

        return response()->noContent();
    }
}
