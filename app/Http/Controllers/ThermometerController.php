<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Thermometer;
use Illuminate\Http\Request;
use App\Models\MeasuringComplex;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ThermometerStoreRequest;
use App\Http\Requests\ThermometerUpdateRequest;

class ThermometerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Thermometer::class);

        $search = $request->get('search', '');

        $thermometers = Thermometer::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.thermometers.index',
            compact('thermometers', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Thermometer::class);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view('app.thermometers.create', compact('measuringComplexes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThermometerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Thermometer::class);

        $validated = $request->validated();

        $thermometer = Thermometer::create($validated);

        return redirect()
            ->route('thermometers.edit', $thermometer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Thermometer $thermometer): View
    {
        $this->authorize('view', $thermometer);

        return view('app.thermometers.show', compact('thermometer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Thermometer $thermometer): View
    {
        $this->authorize('update', $thermometer);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view(
            'app.thermometers.edit',
            compact('thermometer', 'measuringComplexes')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ThermometerUpdateRequest $request,
        Thermometer $thermometer
    ): RedirectResponse {
        $this->authorize('update', $thermometer);

        $validated = $request->validated();

        $thermometer->update($validated);

        return redirect()
            ->route('thermometers.edit', $thermometer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Thermometer $thermometer
    ): RedirectResponse {
        $this->authorize('delete', $thermometer);

        $thermometer->delete();

        return redirect()
            ->route('thermometers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
