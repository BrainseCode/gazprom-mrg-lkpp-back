<?php

namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PayTotalResource;
use App\Http\Resources\PayTotalCollection;

class ContractPayTotalsController extends Controller
{
    public function index(
        Request $request,
        Contract $contract
    ): PayTotalCollection {
        $this->authorize('view', $contract);

        $search = $request->get('search', '');

        $payTotals = $contract
            ->payTotals()
            ->search($search)
            ->latest()
            ->paginate();

        return new PayTotalCollection($payTotals);
    }

    public function store(
        Request $request,
        Contract $contract
    ): PayTotalResource {
        $this->authorize('create', PayTotal::class);

        $validated = $request->validate([
            'pay_delivered' => ['required', 'numeric'],
            'pay_planned' => ['required', 'numeric'],
            'pay_tovdgo' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'total_nds' => ['required', 'numeric'],
        ]);

        $payTotal = $contract->payTotals()->create($validated);

        return new PayTotalResource($payTotal);
    }
}
