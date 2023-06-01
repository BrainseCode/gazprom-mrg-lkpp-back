<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ConnectionPoint;
use App\Models\GasConsumingEquipment;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\GasConsumingEquipmentStoreRequest;
use App\Http\Requests\GasConsumingEquipmentUpdateRequest;

class GasConsumingEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', GasConsumingEquipment::class);

        $search = $request->get('search', '');

        $gasConsumingEquipments = GasConsumingEquipment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.gas_consuming_equipments.index',
            compact('gasConsumingEquipments', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', GasConsumingEquipment::class);

        $connectionPoints = ConnectionPoint::pluck('address', 'id');

        return view(
            'app.gas_consuming_equipments.create',
            compact('connectionPoints')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        GasConsumingEquipmentStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', GasConsumingEquipment::class);

        $validated = $request->validated();

        $gasConsumingEquipment = GasConsumingEquipment::create($validated);

        return redirect()
            ->route('gas-consuming-equipments.edit', $gasConsumingEquipment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        GasConsumingEquipment $gasConsumingEquipment
    ): View {
        $this->authorize('view', $gasConsumingEquipment);

        return view(
            'app.gas_consuming_equipments.show',
            compact('gasConsumingEquipment')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        GasConsumingEquipment $gasConsumingEquipment
    ): View {
        $this->authorize('update', $gasConsumingEquipment);

        $connectionPoints = ConnectionPoint::pluck('address', 'id');

        return view(
            'app.gas_consuming_equipments.edit',
            compact('gasConsumingEquipment', 'connectionPoints')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        GasConsumingEquipmentUpdateRequest $request,
        GasConsumingEquipment $gasConsumingEquipment
    ): RedirectResponse {
        $this->authorize('update', $gasConsumingEquipment);

        $validated = $request->validated();

        $gasConsumingEquipment->update($validated);

        return redirect()
            ->route('gas-consuming-equipments.edit', $gasConsumingEquipment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        GasConsumingEquipment $gasConsumingEquipment
    ): RedirectResponse {
        $this->authorize('delete', $gasConsumingEquipment);

        $gasConsumingEquipment->delete();

        return redirect()
            ->route('gas-consuming-equipments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
