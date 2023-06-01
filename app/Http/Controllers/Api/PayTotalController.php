<?php

namespace App\Http\Controllers\Api;

use App\Models\PayTotal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PayTotalResource;
use App\Http\Resources\PayTotalCollection;
use App\Http\Requests\PayTotalStoreRequest;
use App\Http\Requests\PayTotalUpdateRequest;

class PayTotalController extends Controller
{
    public function index(Request $request): PayTotalCollection
    {
        $this->authorize('view-any', PayTotal::class);

        $search = $request->get('search', '');

        $payTotals = PayTotal::search($search)
            ->latest()
            ->paginate();

        return new PayTotalCollection($payTotals);
    }

    public function store(PayTotalStoreRequest $request): PayTotalResource
    {
        $this->authorize('create', PayTotal::class);

        $validated = $request->validated();

        $payTotal = PayTotal::create($validated);

        return new PayTotalResource($payTotal);
    }

    public function show(Request $request, PayTotal $payTotal): PayTotalResource
    {
        $this->authorize('view', $payTotal);

        return new PayTotalResource($payTotal);
    }

    public function update(
        PayTotalUpdateRequest $request,
        PayTotal $payTotal
    ): PayTotalResource {
        $this->authorize('update', $payTotal);

        $validated = $request->validated();

        $payTotal->update($validated);

        return new PayTotalResource($payTotal);
    }

    public function destroy(Request $request, PayTotal $payTotal): Response
    {
        $this->authorize('delete', $payTotal);

        $payTotal->delete();

        return response()->noContent();
    }
}
