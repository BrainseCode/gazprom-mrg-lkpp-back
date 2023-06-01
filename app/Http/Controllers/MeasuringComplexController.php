<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ConnectionPoint;
use App\Models\MeasuringComplex;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MeasuringComplexStoreRequest;
use App\Http\Requests\MeasuringComplexUpdateRequest;

class MeasuringComplexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', MeasuringComplex::class);

        $search = $request->get('search', '');

        $measuringComplexes = MeasuringComplex::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.measuring_complexes.index',
            compact('measuringComplexes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', MeasuringComplex::class);

        $connectionPoints = ConnectionPoint::pluck('address', 'id');

        return view(
            'app.measuring_complexes.create',
            compact('connectionPoints')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        MeasuringComplexStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', MeasuringComplex::class);

        $validated = $request->validated();

        $measuringComplex = MeasuringComplex::create($validated);

        return redirect()
            ->route('measuring-complexes.edit', $measuringComplex)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        MeasuringComplex $measuringComplex
    ): View {
        $this->authorize('view', $measuringComplex);

        return view(
            'app.measuring_complexes.show',
            compact('measuringComplex')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        MeasuringComplex $measuringComplex
    ): View {
        $this->authorize('update', $measuringComplex);

        $connectionPoints = ConnectionPoint::pluck('address', 'id');

        return view(
            'app.measuring_complexes.edit',
            compact('measuringComplex', 'connectionPoints')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MeasuringComplexUpdateRequest $request,
        MeasuringComplex $measuringComplex
    ): RedirectResponse {
        $this->authorize('update', $measuringComplex);

        $validated = $request->validated();

        $measuringComplex->update($validated);

        return redirect()
            ->route('measuring-complexes.edit', $measuringComplex)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        MeasuringComplex $measuringComplex
    ): RedirectResponse {
        $this->authorize('delete', $measuringComplex);

        $measuringComplex->delete();

        return redirect()
            ->route('measuring-complexes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
