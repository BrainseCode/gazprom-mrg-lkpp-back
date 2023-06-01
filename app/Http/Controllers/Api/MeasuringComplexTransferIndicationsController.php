<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\MeasuringComplex;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransferIndicationResource;
use App\Http\Resources\TransferIndicationCollection;

class MeasuringComplexTransferIndicationsController extends Controller
{
    public function index(
        Request $request,
        MeasuringComplex $measuringComplex
    ): TransferIndicationCollection {
        $this->authorize('view', $measuringComplex);

        $search = $request->get('search', '');

        $transferIndications = $measuringComplex
            ->transferIndications()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransferIndicationCollection($transferIndications);
    }

    public function store(
        Request $request,
        MeasuringComplex $measuringComplex
    ): TransferIndicationResource {
        $this->authorize('create', TransferIndication::class);

        $validated = $request->validate([]);

        $transferIndication = $measuringComplex
            ->transferIndications()
            ->create($validated);

        return new TransferIndicationResource($transferIndication);
    }
}
