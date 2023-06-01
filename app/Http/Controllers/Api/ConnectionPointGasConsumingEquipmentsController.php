<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ConnectionPoint;
use App\Http\Controllers\Controller;
use App\Http\Resources\GasConsumingEquipmentResource;
use App\Http\Resources\GasConsumingEquipmentCollection;

class ConnectionPointGasConsumingEquipmentsController extends Controller
{
    public function index(
        Request $request,
        ConnectionPoint $connectionPoint
    ): GasConsumingEquipmentCollection {
        $this->authorize('view', $connectionPoint);

        $search = $request->get('search', '');

        $gasConsumingEquipments = $connectionPoint
            ->gasConsumingEquipments()
            ->search($search)
            ->latest()
            ->paginate();

        return new GasConsumingEquipmentCollection($gasConsumingEquipments);
    }

    public function store(
        Request $request,
        ConnectionPoint $connectionPoint
    ): GasConsumingEquipmentResource {
        $this->authorize('create', GasConsumingEquipment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'quantity' => ['required', 'numeric'],
            'power' => ['required', 'numeric'],
            'consumption' => ['required', 'numeric'],
        ]);

        $gasConsumingEquipment = $connectionPoint
            ->gasConsumingEquipments()
            ->create($validated);

        return new GasConsumingEquipmentResource($gasConsumingEquipment);
    }
}
