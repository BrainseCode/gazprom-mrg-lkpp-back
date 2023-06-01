<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\PayTovdgo;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PayTovdgoStoreRequest;
use App\Http\Requests\PayTovdgoUpdateRequest;

class PayTovdgoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PayTovdgo::class);

        $search = $request->get('search', '');

        $payTovdgos = PayTovdgo::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.pay_tovdgos.index', compact('payTovdgos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PayTovdgo::class);

        $contracts = Contract::pluck('name', 'id');

        return view('app.pay_tovdgos.create', compact('contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PayTovdgoStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PayTovdgo::class);

        $validated = $request->validated();

        $payTovdgo = PayTovdgo::create($validated);

        return redirect()
            ->route('pay-tovdgos.edit', $payTovdgo)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PayTovdgo $payTovdgo): View
    {
        $this->authorize('view', $payTovdgo);

        return view('app.pay_tovdgos.show', compact('payTovdgo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PayTovdgo $payTovdgo): View
    {
        $this->authorize('update', $payTovdgo);

        $contracts = Contract::pluck('name', 'id');

        return view('app.pay_tovdgos.edit', compact('payTovdgo', 'contracts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PayTovdgoUpdateRequest $request,
        PayTovdgo $payTovdgo
    ): RedirectResponse {
        $this->authorize('update', $payTovdgo);

        $validated = $request->validated();

        $payTovdgo->update($validated);

        return redirect()
            ->route('pay-tovdgos.edit', $payTovdgo)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PayTovdgo $payTovdgo
    ): RedirectResponse {
        $this->authorize('delete', $payTovdgo);

        $payTovdgo->delete();

        return redirect()
            ->route('pay-tovdgos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
