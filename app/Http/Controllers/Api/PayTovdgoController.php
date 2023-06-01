<?php

namespace App\Http\Controllers\Api;

use App\Models\PayTovdgo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PayTovdgoResource;
use App\Http\Resources\PayTovdgoCollection;
use App\Http\Requests\PayTovdgoStoreRequest;
use App\Http\Requests\PayTovdgoUpdateRequest;

class PayTovdgoController extends Controller
{
    public function index(Request $request): PayTovdgoCollection
    {
        $this->authorize('view-any', PayTovdgo::class);

        $search = $request->get('search', '');

        $payTovdgos = PayTovdgo::search($search)
            ->latest()
            ->paginate();

        return new PayTovdgoCollection($payTovdgos);
    }

    public function store(PayTovdgoStoreRequest $request): PayTovdgoResource
    {
        $this->authorize('create', PayTovdgo::class);

        $validated = $request->validated();

        $payTovdgo = PayTovdgo::create($validated);

        return new PayTovdgoResource($payTovdgo);
    }

    public function show(
        Request $request,
        PayTovdgo $payTovdgo
    ): PayTovdgoResource {
        $this->authorize('view', $payTovdgo);

        return new PayTovdgoResource($payTovdgo);
    }

    public function update(
        PayTovdgoUpdateRequest $request,
        PayTovdgo $payTovdgo
    ): PayTovdgoResource {
        $this->authorize('update', $payTovdgo);

        $validated = $request->validated();

        $payTovdgo->update($validated);

        return new PayTovdgoResource($payTovdgo);
    }

    public function destroy(Request $request, PayTovdgo $payTovdgo): Response
    {
        $this->authorize('delete', $payTovdgo);

        $payTovdgo->delete();

        return response()->noContent();
    }
}
