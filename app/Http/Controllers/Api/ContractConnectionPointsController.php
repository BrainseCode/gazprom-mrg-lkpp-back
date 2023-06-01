<?php

namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConnectionPointResource;
use App\Http\Resources\ConnectionPointCollection;

class ContractConnectionPointsController extends Controller
{
    public function index(
        Request $request,
        Contract $contract
    ): ConnectionPointCollection {
        $this->authorize('view', $contract);

        $search = $request->get('search', '');

        $connectionPoints = $contract
            ->connectionPoints()
            ->search($search)
            ->latest()
            ->paginate();

        return new ConnectionPointCollection($connectionPoints);
    }

    public function store(
        Request $request,
        Contract $contract
    ): ConnectionPointResource {
        $this->authorize('create', ConnectionPoint::class);

        $validated = $request->validate([
            'address' => ['required', 'max:255', 'string'],
        ]);

        $connectionPoint = $contract->connectionPoints()->create($validated);

        return new ConnectionPointResource($connectionPoint);
    }
}
