<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ConnectionPoint;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationResource;
use App\Http\Resources\IndicationCollection;

class ConnectionPointIndicationsController extends Controller
{
    public function index(
        Request $request,
        ConnectionPoint $connectionPoint
    ): IndicationCollection {
        $this->authorize('view', $connectionPoint);

        $search = $request->get('search', '');

        $indications = $connectionPoint
            ->indications()
            ->search($search)
            ->latest()
            ->paginate();

        return new IndicationCollection($indications);
    }

    public function store(
        Request $request,
        ConnectionPoint $connectionPoint
    ): IndicationResource {
        $this->authorize('create', Indication::class);

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'volume' => ['required', 'numeric'],
            'plan' => ['required', 'numeric'],
        ]);

        $indication = $connectionPoint->indications()->create($validated);

        return new IndicationResource($indication);
    }
}
