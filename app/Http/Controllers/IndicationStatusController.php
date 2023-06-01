<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\IndicationStatus;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IndicationStatusStoreRequest;
use App\Http\Requests\IndicationStatusUpdateRequest;

class IndicationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', IndicationStatus::class);

        $search = $request->get('search', '');

        $indicationStatuses = IndicationStatus::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.indication_statuses.index',
            compact('indicationStatuses', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', IndicationStatus::class);

        return view('app.indication_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        IndicationStatusStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', IndicationStatus::class);

        $validated = $request->validated();

        $indicationStatus = IndicationStatus::create($validated);

        return redirect()
            ->route('indication-statuses.edit', $indicationStatus)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        IndicationStatus $indicationStatus
    ): View {
        $this->authorize('view', $indicationStatus);

        return view(
            'app.indication_statuses.show',
            compact('indicationStatus')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        IndicationStatus $indicationStatus
    ): View {
        $this->authorize('update', $indicationStatus);

        return view(
            'app.indication_statuses.edit',
            compact('indicationStatus')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        IndicationStatusUpdateRequest $request,
        IndicationStatus $indicationStatus
    ): RedirectResponse {
        $this->authorize('update', $indicationStatus);

        $validated = $request->validated();

        $indicationStatus->update($validated);

        return redirect()
            ->route('indication-statuses.edit', $indicationStatus)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        IndicationStatus $indicationStatus
    ): RedirectResponse {
        $this->authorize('delete', $indicationStatus);

        $indicationStatus->delete();

        return redirect()
            ->route('indication-statuses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
