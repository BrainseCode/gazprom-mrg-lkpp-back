<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TransferIndication;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransferIndicationResource;
use App\Http\Resources\TransferIndicationCollection;
use App\Http\Requests\TransferIndicationStoreRequest;
use App\Http\Requests\TransferIndicationUpdateRequest;

class TransferIndicationController extends Controller
{
    public function index(Request $request): TransferIndicationCollection
    {
        $this->authorize('view-any', TransferIndication::class);

        $search = $request->get('search', '');

        $transferIndications = TransferIndication::search($search)
            ->latest()
            ->paginate();

        return new TransferIndicationCollection($transferIndications);
    }

    public function store(
        TransferIndicationStoreRequest $request
    ): TransferIndicationResource {
        $this->authorize('create', TransferIndication::class);

        $validated = $request->validated();

        $transferIndication = TransferIndication::create($validated);

        return new TransferIndicationResource($transferIndication);
    }

    public function show(
        Request $request,
        TransferIndication $transferIndication
    ): TransferIndicationResource {
        $this->authorize('view', $transferIndication);

        return new TransferIndicationResource($transferIndication);
    }

    public function update(
        TransferIndicationUpdateRequest $request,
        TransferIndication $transferIndication
    ): TransferIndicationResource {
        $this->authorize('update', $transferIndication);

        $validated = $request->validated();

        $transferIndication->update($validated);

        return new TransferIndicationResource($transferIndication);
    }

    public function destroy(
        Request $request,
        TransferIndication $transferIndication
    ): Response {
        $this->authorize('delete', $transferIndication);

        $transferIndication->delete();

        return response()->noContent();
    }
}
