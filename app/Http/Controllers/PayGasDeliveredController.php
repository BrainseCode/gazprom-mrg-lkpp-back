<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\PayGasDelivered;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PayGasDeliveredStoreRequest;
use App\Http\Requests\PayGasDeliveredUpdateRequest;

class PayGasDeliveredController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PayGasDelivered::class);

        $search = $request->get('search', '');

        $payGasDelivereds = PayGasDelivered::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.pay_gas_delivereds.index',
            compact('payGasDelivereds', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PayGasDelivered::class);

        $contracts = Contract::pluck('name', 'id');

        return view('app.pay_gas_delivereds.create', compact('contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        PayGasDeliveredStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', PayGasDelivered::class);

        $validated = $request->validated();

        $payGasDelivered = PayGasDelivered::create($validated);

        return redirect()
            ->route('pay-gas-delivereds.edit', $payGasDelivered)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        PayGasDelivered $payGasDelivered
    ): View {
        $this->authorize('view', $payGasDelivered);

        return view('app.pay_gas_delivereds.show', compact('payGasDelivered'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        PayGasDelivered $payGasDelivered
    ): View {
        $this->authorize('update', $payGasDelivered);

        $contracts = Contract::pluck('name', 'id');

        return view(
            'app.pay_gas_delivereds.edit',
            compact('payGasDelivered', 'contracts')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PayGasDeliveredUpdateRequest $request,
        PayGasDelivered $payGasDelivered
    ): RedirectResponse {
        $this->authorize('update', $payGasDelivered);

        $validated = $request->validated();

        $payGasDelivered->update($validated);

        return redirect()
            ->route('pay-gas-delivereds.edit', $payGasDelivered)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PayGasDelivered $payGasDelivered
    ): RedirectResponse {
        $this->authorize('delete', $payGasDelivered);

        $payGasDelivered->delete();

        return redirect()
            ->route('pay-gas-delivereds.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
