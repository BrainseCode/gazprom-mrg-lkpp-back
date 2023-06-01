<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PayGasDelivered;
use App\Http\Controllers\Controller;
use App\Http\Resources\PayGasDeliveredResource;
use App\Http\Resources\PayGasDeliveredCollection;
use App\Http\Requests\PayGasDeliveredStoreRequest;
use App\Http\Requests\PayGasDeliveredUpdateRequest;

class PayGasDeliveredController extends Controller
{
    public function index(Request $request): PayGasDeliveredCollection
    {
        $this->authorize('view-any', PayGasDelivered::class);

        $search = $request->get('search', '');

        $payGasDelivereds = PayGasDelivered::search($search)
            ->latest()
            ->paginate();

        return new PayGasDeliveredCollection($payGasDelivereds);
    }

    public function store(
        PayGasDeliveredStoreRequest $request
    ): PayGasDeliveredResource {
        $this->authorize('create', PayGasDelivered::class);

        $validated = $request->validated();

        $payGasDelivered = PayGasDelivered::create($validated);

        return new PayGasDeliveredResource($payGasDelivered);
    }

    public function show(
        Request $request,
        PayGasDelivered $payGasDelivered
    ): PayGasDeliveredResource {
        $this->authorize('view', $payGasDelivered);

        return new PayGasDeliveredResource($payGasDelivered);
    }

    public function update(
        PayGasDeliveredUpdateRequest $request,
        PayGasDelivered $payGasDelivered
    ): PayGasDeliveredResource {
        $this->authorize('update', $payGasDelivered);

        $validated = $request->validated();

        $payGasDelivered->update($validated);

        return new PayGasDeliveredResource($payGasDelivered);
    }

    public function destroy(
        Request $request,
        PayGasDelivered $payGasDelivered
    ): Response {
        $this->authorize('delete', $payGasDelivered);

        $payGasDelivered->delete();

        return response()->noContent();
    }
}
