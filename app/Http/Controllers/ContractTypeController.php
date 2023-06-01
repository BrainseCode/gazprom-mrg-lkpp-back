<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\ContractType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContractTypeStoreRequest;
use App\Http\Requests\ContractTypeUpdateRequest;

class ContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ContractType::class);

        $search = $request->get('search', '');

        $contractTypes = ContractType::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.contract_types.index',
            compact('contractTypes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ContractType::class);

        return view('app.contract_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContractTypeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ContractType::class);

        $validated = $request->validated();

        $contractType = ContractType::create($validated);

        return redirect()
            ->route('contract-types.edit', $contractType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ContractType $contractType): View
    {
        $this->authorize('view', $contractType);

        return view('app.contract_types.show', compact('contractType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ContractType $contractType): View
    {
        $this->authorize('update', $contractType);

        return view('app.contract_types.edit', compact('contractType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContractTypeUpdateRequest $request,
        ContractType $contractType
    ): RedirectResponse {
        $this->authorize('update', $contractType);

        $validated = $request->validated();

        $contractType->update($validated);

        return redirect()
            ->route('contract-types.edit', $contractType)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ContractType $contractType
    ): RedirectResponse {
        $this->authorize('delete', $contractType);

        $contractType->delete();

        return redirect()
            ->route('contract-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
