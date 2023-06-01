<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Indication;
use Illuminate\Http\Request;
use App\Models\ConnectionPoint;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IndicationStoreRequest;
use App\Http\Requests\IndicationUpdateRequest;

class IndicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Indication::class);

        $search = $request->get('search', '');

        $indications = Indication::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.indications.index', compact('indications', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Indication::class);

        $connectionPoints = ConnectionPoint::pluck('address', 'id');

        return view('app.indications.create', compact('connectionPoints'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IndicationStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Indication::class);

        $validated = $request->validated();

        $indication = Indication::create($validated);

        return redirect()
            ->route('indications.edit', $indication)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Indication $indication): View
    {
        $this->authorize('view', $indication);

        return view('app.indications.show', compact('indication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Indication $indication): View
    {
        $this->authorize('update', $indication);

        $connectionPoints = ConnectionPoint::pluck('address', 'id');

        return view(
            'app.indications.edit',
            compact('indication', 'connectionPoints')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        IndicationUpdateRequest $request,
        Indication $indication
    ): RedirectResponse {
        $this->authorize('update', $indication);

        $validated = $request->validated();

        $indication->update($validated);

        return redirect()
            ->route('indications.edit', $indication)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Indication $indication
    ): RedirectResponse {
        $this->authorize('delete', $indication);

        $indication->delete();

        return redirect()
            ->route('indications.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
