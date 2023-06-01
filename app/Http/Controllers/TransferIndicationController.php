<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\TransferIndication;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TransferIndicationStoreRequest;
use App\Http\Requests\TransferIndicationUpdateRequest;

class TransferIndicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', TransferIndication::class);

        $search = $request->get('search', '');

        $transferIndications = TransferIndication::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.transfer_indications.index',
            compact('transferIndications', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', TransferIndication::class);

        return view('app.transfer_indications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        TransferIndicationStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', TransferIndication::class);

        $validated = $request->validated();

        $transferIndication = TransferIndication::create($validated);

        return redirect()
            ->route('transfer-indications.edit', $transferIndication)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        TransferIndication $transferIndication
    ): View {
        $this->authorize('view', $transferIndication);

        return view(
            'app.transfer_indications.show',
            compact('transferIndication')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        TransferIndication $transferIndication
    ): View {
        $this->authorize('update', $transferIndication);

        return view(
            'app.transfer_indications.edit',
            compact('transferIndication')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TransferIndicationUpdateRequest $request,
        TransferIndication $transferIndication
    ): RedirectResponse {
        $this->authorize('update', $transferIndication);

        $validated = $request->validated();

        $transferIndication->update($validated);

        return redirect()
            ->route('transfer-indications.edit', $transferIndication)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        TransferIndication $transferIndication
    ): RedirectResponse {
        $this->authorize('delete', $transferIndication);

        $transferIndication->delete();

        return redirect()
            ->route('transfer-indications.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
