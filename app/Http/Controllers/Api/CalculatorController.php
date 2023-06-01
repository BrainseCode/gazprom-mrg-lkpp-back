<?php

namespace App\Http\Controllers\Api;

use App\Models\Calculator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CalculatorResource;
use App\Http\Resources\CalculatorCollection;
use App\Http\Requests\CalculatorStoreRequest;
use App\Http\Requests\CalculatorUpdateRequest;

class CalculatorController extends Controller
{
    public function index(Request $request): CalculatorCollection
    {
        $this->authorize('view-any', Calculator::class);

        $search = $request->get('search', '');

        $calculators = Calculator::search($search)
            ->latest()
            ->paginate();

        return new CalculatorCollection($calculators);
    }

    public function store(CalculatorStoreRequest $request): CalculatorResource
    {
        $this->authorize('create', Calculator::class);

        $validated = $request->validated();

        $calculator = Calculator::create($validated);

        return new CalculatorResource($calculator);
    }

    public function show(
        Request $request,
        Calculator $calculator
    ): CalculatorResource {
        $this->authorize('view', $calculator);

        return new CalculatorResource($calculator);
    }

    public function update(
        CalculatorUpdateRequest $request,
        Calculator $calculator
    ): CalculatorResource {
        $this->authorize('update', $calculator);

        $validated = $request->validated();

        $calculator->update($validated);

        return new CalculatorResource($calculator);
    }

    public function destroy(Request $request, Calculator $calculator): Response
    {
        $this->authorize('delete', $calculator);

        $calculator->delete();

        return response()->noContent();
    }
}
