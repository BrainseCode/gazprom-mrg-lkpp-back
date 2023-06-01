<?php

namespace App\Http\Controllers;

use App\Models\PayTotal;
use App\Models\Contract;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PayTotalStoreRequest;
use App\Http\Requests\PayTotalUpdateRequest;

class PayTotalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PayTotal::class);

        $search = $request->get('search', '');

        $payTotals = PayTotal::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.pay_totals.index', compact('payTotals', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PayTotal::class);

        $contracts = Contract::pluck('name', 'id');

        return view('app.pay_totals.create', compact('contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PayTotalStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PayTotal::class);

        $validated = $request->validated();

        $payTotal = PayTotal::create($validated);

        return redirect()
            ->route('pay-totals.edit', $payTotal)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PayTotal $payTotal): View
    {
        $this->authorize('view', $payTotal);

        return view('app.pay_totals.show', compact('payTotal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PayTotal $payTotal): View
    {
        $this->authorize('update', $payTotal);

        $contracts = Contract::pluck('name', 'id');

        return view('app.pay_totals.edit', compact('payTotal', 'contracts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PayTotalUpdateRequest $request,
        PayTotal $payTotal
    ): RedirectResponse {
        $this->authorize('update', $payTotal);

        $validated = $request->validated();

        $payTotal->update($validated);

        return redirect()
            ->route('pay-totals.edit', $payTotal)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PayTotal $payTotal
    ): RedirectResponse {
        $this->authorize('delete', $payTotal);

        $payTotal->delete();

        return redirect()
            ->route('pay-totals.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
