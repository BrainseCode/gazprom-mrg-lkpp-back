<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\AllIndicationQuarter;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AllIndicationQuarterStoreRequest;
use App\Http\Requests\AllIndicationQuarterUpdateRequest;

class AllIndicationQuarterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', AllIndicationQuarter::class);

        $search = $request->get('search', '');

        $allIndicationQuarters = AllIndicationQuarter::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_indication_quarters.index',
            compact('allIndicationQuarters', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', AllIndicationQuarter::class);

        $contracts = Contract::pluck('name', 'id');

        return view('app.all_indication_quarters.create', compact('contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        AllIndicationQuarterStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', AllIndicationQuarter::class);

        $validated = $request->validated();

        $allIndicationQuarter = AllIndicationQuarter::create($validated);

        return redirect()
            ->route('all-indication-quarters.edit', $allIndicationQuarter)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        AllIndicationQuarter $allIndicationQuarter
    ): View {
        $this->authorize('view', $allIndicationQuarter);

        return view(
            'app.all_indication_quarters.show',
            compact('allIndicationQuarter')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        AllIndicationQuarter $allIndicationQuarter
    ): View {
        $this->authorize('update', $allIndicationQuarter);

        $contracts = Contract::pluck('name', 'id');

        return view(
            'app.all_indication_quarters.edit',
            compact('allIndicationQuarter', 'contracts')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AllIndicationQuarterUpdateRequest $request,
        AllIndicationQuarter $allIndicationQuarter
    ): RedirectResponse {
        $this->authorize('update', $allIndicationQuarter);

        $validated = $request->validated();

        $allIndicationQuarter->update($validated);

        return redirect()
            ->route('all-indication-quarters.edit', $allIndicationQuarter)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        AllIndicationQuarter $allIndicationQuarter
    ): RedirectResponse {
        $this->authorize('delete', $allIndicationQuarter);

        $allIndicationQuarter->delete();

        return redirect()
            ->route('all-indication-quarters.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
