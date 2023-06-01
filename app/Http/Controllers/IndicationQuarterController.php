<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ConnectionPoint;
use App\Models\IndicationQuarter;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IndicationQuarterStoreRequest;
use App\Http\Requests\IndicationQuarterUpdateRequest;

class IndicationQuarterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', IndicationQuarter::class);

        $search = $request->get('search', '');

        $indicationQuarters = IndicationQuarter::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.indication_quarters.index',
            compact('indicationQuarters', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', IndicationQuarter::class);

        $connectionPoints = ConnectionPoint::pluck('address', 'id');

        return view(
            'app.indication_quarters.create',
            compact('connectionPoints')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        IndicationQuarterStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', IndicationQuarter::class);

        $validated = $request->validated();

        $indicationQuarter = IndicationQuarter::create($validated);

        return redirect()
            ->route('indication-quarters.edit', $indicationQuarter)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        IndicationQuarter $indicationQuarter
    ): View {
        $this->authorize('view', $indicationQuarter);

        return view(
            'app.indication_quarters.show',
            compact('indicationQuarter')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        IndicationQuarter $indicationQuarter
    ): View {
        $this->authorize('update', $indicationQuarter);

        $connectionPoints = ConnectionPoint::pluck('address', 'id');

        return view(
            'app.indication_quarters.edit',
            compact('indicationQuarter', 'connectionPoints')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        IndicationQuarterUpdateRequest $request,
        IndicationQuarter $indicationQuarter
    ): RedirectResponse {
        $this->authorize('update', $indicationQuarter);

        $validated = $request->validated();

        $indicationQuarter->update($validated);

        return redirect()
            ->route('indication-quarters.edit', $indicationQuarter)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        IndicationQuarter $indicationQuarter
    ): RedirectResponse {
        $this->authorize('delete', $indicationQuarter);

        $indicationQuarter->delete();

        return redirect()
            ->route('indication-quarters.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
