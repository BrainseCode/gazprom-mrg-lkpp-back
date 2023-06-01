<?php

namespace App\Http\Controllers;

use App\Models\PowerUnit;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\MeasuringComplex;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PowerUnitStoreRequest;
use App\Http\Requests\PowerUnitUpdateRequest;

class PowerUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PowerUnit::class);

        $search = $request->get('search', '');

        $powerUnits = PowerUnit::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.power_units.index', compact('powerUnits', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PowerUnit::class);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view('app.power_units.create', compact('measuringComplexes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PowerUnitStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PowerUnit::class);

        $validated = $request->validated();

        $powerUnit = PowerUnit::create($validated);

        return redirect()
            ->route('power-units.edit', $powerUnit)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PowerUnit $powerUnit): View
    {
        $this->authorize('view', $powerUnit);

        return view('app.power_units.show', compact('powerUnit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PowerUnit $powerUnit): View
    {
        $this->authorize('update', $powerUnit);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view(
            'app.power_units.edit',
            compact('powerUnit', 'measuringComplexes')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PowerUnitUpdateRequest $request,
        PowerUnit $powerUnit
    ): RedirectResponse {
        $this->authorize('update', $powerUnit);

        $validated = $request->validated();

        $powerUnit->update($validated);

        return redirect()
            ->route('power-units.edit', $powerUnit)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PowerUnit $powerUnit
    ): RedirectResponse {
        $this->authorize('delete', $powerUnit);

        $powerUnit->delete();

        return redirect()
            ->route('power-units.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
