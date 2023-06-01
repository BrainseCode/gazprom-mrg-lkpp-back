<?php

namespace App\Http\Controllers\Api;

use App\Models\PowerUnit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PowerUnitResource;
use App\Http\Resources\PowerUnitCollection;
use App\Http\Requests\PowerUnitStoreRequest;
use App\Http\Requests\PowerUnitUpdateRequest;

class PowerUnitController extends Controller
{
    public function index(Request $request): PowerUnitCollection
    {
        $this->authorize('view-any', PowerUnit::class);

        $search = $request->get('search', '');

        $powerUnits = PowerUnit::search($search)
            ->latest()
            ->paginate();

        return new PowerUnitCollection($powerUnits);
    }

    public function store(PowerUnitStoreRequest $request): PowerUnitResource
    {
        $this->authorize('create', PowerUnit::class);

        $validated = $request->validated();

        $powerUnit = PowerUnit::create($validated);

        return new PowerUnitResource($powerUnit);
    }

    public function show(
        Request $request,
        PowerUnit $powerUnit
    ): PowerUnitResource {
        $this->authorize('view', $powerUnit);

        return new PowerUnitResource($powerUnit);
    }

    public function update(
        PowerUnitUpdateRequest $request,
        PowerUnit $powerUnit
    ): PowerUnitResource {
        $this->authorize('update', $powerUnit);

        $validated = $request->validated();

        $powerUnit->update($validated);

        return new PowerUnitResource($powerUnit);
    }

    public function destroy(Request $request, PowerUnit $powerUnit): Response
    {
        $this->authorize('delete', $powerUnit);

        $powerUnit->delete();

        return response()->noContent();
    }
}
