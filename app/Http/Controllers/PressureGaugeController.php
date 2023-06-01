<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\PressureGauge;
use App\Models\MeasuringComplex;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PressureGaugeStoreRequest;
use App\Http\Requests\PressureGaugeUpdateRequest;

class PressureGaugeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PressureGauge::class);

        $search = $request->get('search', '');

        $pressureGauges = PressureGauge::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.pressure_gauges.index',
            compact('pressureGauges', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PressureGauge::class);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view(
            'app.pressure_gauges.create',
            compact('measuringComplexes')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PressureGaugeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PressureGauge::class);

        $validated = $request->validated();

        $pressureGauge = PressureGauge::create($validated);

        return redirect()
            ->route('pressure-gauges.edit', $pressureGauge)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PressureGauge $pressureGauge): View
    {
        $this->authorize('view', $pressureGauge);

        return view('app.pressure_gauges.show', compact('pressureGauge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PressureGauge $pressureGauge): View
    {
        $this->authorize('update', $pressureGauge);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view(
            'app.pressure_gauges.edit',
            compact('pressureGauge', 'measuringComplexes')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PressureGaugeUpdateRequest $request,
        PressureGauge $pressureGauge
    ): RedirectResponse {
        $this->authorize('update', $pressureGauge);

        $validated = $request->validated();

        $pressureGauge->update($validated);

        return redirect()
            ->route('pressure-gauges.edit', $pressureGauge)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PressureGauge $pressureGauge
    ): RedirectResponse {
        $this->authorize('delete', $pressureGauge);

        $pressureGauge->delete();

        return redirect()
            ->route('pressure-gauges.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
