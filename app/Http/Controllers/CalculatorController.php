<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Calculator;
use Illuminate\Http\Request;
use App\Models\MeasuringComplex;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CalculatorStoreRequest;
use App\Http\Requests\CalculatorUpdateRequest;

class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Calculator::class);

        $search = $request->get('search', '');

        $calculators = Calculator::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.calculators.index', compact('calculators', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Calculator::class);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view('app.calculators.create', compact('measuringComplexes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalculatorStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Calculator::class);

        $validated = $request->validated();

        $calculator = Calculator::create($validated);

        return redirect()
            ->route('calculators.edit', $calculator)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Calculator $calculator): View
    {
        $this->authorize('view', $calculator);

        return view('app.calculators.show', compact('calculator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Calculator $calculator): View
    {
        $this->authorize('update', $calculator);

        $measuringComplexes = MeasuringComplex::pluck('id', 'id');

        return view(
            'app.calculators.edit',
            compact('calculator', 'measuringComplexes')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CalculatorUpdateRequest $request,
        Calculator $calculator
    ): RedirectResponse {
        $this->authorize('update', $calculator);

        $validated = $request->validated();

        $calculator->update($validated);

        return redirect()
            ->route('calculators.edit', $calculator)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Calculator $calculator
    ): RedirectResponse {
        $this->authorize('delete', $calculator);

        $calculator->delete();

        return redirect()
            ->route('calculators.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
