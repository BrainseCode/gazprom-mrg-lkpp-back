<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\PayGasPlanned;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PayGasPlannedStoreRequest;
use App\Http\Requests\PayGasPlannedUpdateRequest;

class PayGasPlannedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PayGasPlanned::class);

        $search = $request->get('search', '');

        $payGasPlanneds = PayGasPlanned::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.pay_gas_planneds.index',
            compact('payGasPlanneds', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PayGasPlanned::class);

        $contracts = Contract::pluck('name', 'id');

        return view('app.pay_gas_planneds.create', compact('contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PayGasPlannedStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PayGasPlanned::class);

        $validated = $request->validated();

        $payGasPlanned = PayGasPlanned::create($validated);

        return redirect()
            ->route('pay-gas-planneds.edit', $payGasPlanned)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PayGasPlanned $payGasPlanned): View
    {
        $this->authorize('view', $payGasPlanned);

        return view('app.pay_gas_planneds.show', compact('payGasPlanned'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PayGasPlanned $payGasPlanned): View
    {
        $this->authorize('update', $payGasPlanned);

        $contracts = Contract::pluck('name', 'id');

        return view(
            'app.pay_gas_planneds.edit',
            compact('payGasPlanned', 'contracts')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PayGasPlannedUpdateRequest $request,
        PayGasPlanned $payGasPlanned
    ): RedirectResponse {
        $this->authorize('update', $payGasPlanned);

        $validated = $request->validated();

        $payGasPlanned->update($validated);

        return redirect()
            ->route('pay-gas-planneds.edit', $payGasPlanned)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PayGasPlanned $payGasPlanned
    ): RedirectResponse {
        $this->authorize('delete', $payGasPlanned);

        $payGasPlanned->delete();

        return redirect()
            ->route('pay-gas-planneds.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
