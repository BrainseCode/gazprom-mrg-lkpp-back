<?php

namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PayGasPlannedResource;
use App\Http\Resources\PayGasPlannedCollection;

class ContractPayGasPlannedsController extends Controller
{
    public function index(
        Request $request,
        Contract $contract
    ): PayGasPlannedCollection {
        $this->authorize('view', $contract);

        $search = $request->get('search', '');

        $payGasPlanneds = $contract
            ->payGasPlanneds()
            ->search($search)
            ->latest()
            ->paginate();

        return new PayGasPlannedCollection($payGasPlanneds);
    }

    public function store(
        Request $request,
        Contract $contract
    ): PayGasPlannedResource {
        $this->authorize('create', PayGasPlanned::class);

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'Percent' => ['required', 'numeric'],
            'summ' => ['required', 'numeric'],
            'status_pay' => ['required', 'boolean'],
        ]);

        $payGasPlanned = $contract->payGasPlanneds()->create($validated);

        return new PayGasPlannedResource($payGasPlanned);
    }
}
