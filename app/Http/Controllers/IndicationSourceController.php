<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\IndicationSource;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IndicationSourceStoreRequest;
use App\Http\Requests\IndicationSourceUpdateRequest;

class IndicationSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', IndicationSource::class);

        $search = $request->get('search', '');

        $indicationSources = IndicationSource::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.indication_sources.index',
            compact('indicationSources', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', IndicationSource::class);

        return view('app.indication_sources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        IndicationSourceStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', IndicationSource::class);

        $validated = $request->validated();

        $indicationSource = IndicationSource::create($validated);

        return redirect()
            ->route('indication-sources.edit', $indicationSource)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        IndicationSource $indicationSource
    ): View {
        $this->authorize('view', $indicationSource);

        return view('app.indication_sources.show', compact('indicationSource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        IndicationSource $indicationSource
    ): View {
        $this->authorize('update', $indicationSource);

        return view('app.indication_sources.edit', compact('indicationSource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        IndicationSourceUpdateRequest $request,
        IndicationSource $indicationSource
    ): RedirectResponse {
        $this->authorize('update', $indicationSource);

        $validated = $request->validated();

        $indicationSource->update($validated);

        return redirect()
            ->route('indication-sources.edit', $indicationSource)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        IndicationSource $indicationSource
    ): RedirectResponse {
        $this->authorize('delete', $indicationSource);

        $indicationSource->delete();

        return redirect()
            ->route('indication-sources.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
