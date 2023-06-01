<?php

namespace App\Http\Controllers;

use App\Models\Meter;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\MeasuringComplex;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MeterStoreRequest;
use App\Http\Requests\MeterUpdateRequest;

class MeterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Meter::class);

        $search = $request->get('search', '');

        $meters = Meter::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.meters.index', compact('meters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Meter::class);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view('app.meters.create', compact('measuringComplexes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MeterStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Meter::class);

        $validated = $request->validated();

        $meter = Meter::create($validated);

        return redirect()
            ->route('meters.edit', $meter)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Meter $meter): View
    {
        $this->authorize('view', $meter);

        return view('app.meters.show', compact('meter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Meter $meter): View
    {
        $this->authorize('update', $meter);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view('app.meters.edit', compact('meter', 'measuringComplexes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MeterUpdateRequest $request,
        Meter $meter
    ): RedirectResponse {
        $this->authorize('update', $meter);

        $validated = $request->validated();

        $meter->update($validated);

        return redirect()
            ->route('meters.edit', $meter)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Meter $meter): RedirectResponse
    {
        $this->authorize('delete', $meter);

        $meter->delete();

        return redirect()
            ->route('meters.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
