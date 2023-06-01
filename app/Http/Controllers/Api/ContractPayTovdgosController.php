<?php

namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PayTovdgoResource;
use App\Http\Resources\PayTovdgoCollection;

class ContractPayTovdgosController extends Controller
{
    public function index(
        Request $request,
        Contract $contract
    ): PayTovdgoCollection {
        $this->authorize('view', $contract);

        $search = $request->get('search', '');

        $payTovdgos = $contract
            ->payTovdgos()
            ->search($search)
            ->latest()
            ->paginate();

        return new PayTovdgoCollection($payTovdgos);
    }

    public function store(
        Request $request,
        Contract $contract
    ): PayTovdgoResource {
        $this->authorize('create', PayTovdgo::class);

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'summ' => ['required', 'numeric'],
            'status_pay' => ['required', 'boolean'],
        ]);

        $payTovdgo = $contract->payTovdgos()->create($validated);

        return new PayTovdgoResource($payTovdgo);
    }
}
