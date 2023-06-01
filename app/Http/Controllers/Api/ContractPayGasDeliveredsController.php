<?php

namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PayGasDeliveredResource;
use App\Http\Resources\PayGasDeliveredCollection;

class ContractPayGasDeliveredsController extends Controller
{
    public function index(
        Request $request,
        Contract $contract
    ): PayGasDeliveredCollection {
        $this->authorize('view', $contract);

        $search = $request->get('search', '');

        $payGasDelivereds = $contract
            ->payGasDelivereds()
            ->search($search)
            ->latest()
            ->paginate();

        return new PayGasDeliveredCollection($payGasDelivereds);
    }

    public function store(
        Request $request,
        Contract $contract
    ): PayGasDeliveredResource {
        $this->authorize('create', PayGasDelivered::class);

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'summ' => ['required', 'numeric'],
            'status_pay' => ['required', 'boolean'],
        ]);

        $payGasDelivered = $contract->payGasDelivereds()->create($validated);

        return new PayGasDeliveredResource($payGasDelivered);
    }
}
