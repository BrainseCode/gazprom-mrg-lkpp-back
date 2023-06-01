<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ContractStatus;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContractStatusStoreRequest;
use App\Http\Requests\ContractStatusUpdateRequest;

class ContractStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ContractStatus::class);

        $search = $request->get('search', '');

        $contractStatuses = ContractStatus::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.contract_statuses.index',
            compact('contractStatuses', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ContractStatus::class);

        return view('app.contract_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContractStatusStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ContractStatus::class);

        $validated = $request->validated();

        $contractStatus = ContractStatus::create($validated);

        return redirect()
            ->route('contract-statuses.edit', $contractStatus)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ContractStatus $contractStatus): View
    {
        $this->authorize('view', $contractStatus);

        return view('app.contract_statuses.show', compact('contractStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ContractStatus $contractStatus): View
    {
        $this->authorize('update', $contractStatus);

        return view('app.contract_statuses.edit', compact('contractStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContractStatusUpdateRequest $request,
        ContractStatus $contractStatus
    ): RedirectResponse {
        $this->authorize('update', $contractStatus);

        $validated = $request->validated();

        $contractStatus->update($validated);

        return redirect()
            ->route('contract-statuses.edit', $contractStatus)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ContractStatus $contractStatus
    ): RedirectResponse {
        $this->authorize('delete', $contractStatus);

        $contractStatus->delete();

        return redirect()
            ->route('contract-statuses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
