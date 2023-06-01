<?php

namespace App\Http\Controllers\Api;

use App\Models\ContractType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContractTypeResource;
use App\Http\Resources\ContractTypeCollection;
use App\Http\Requests\ContractTypeStoreRequest;
use App\Http\Requests\ContractTypeUpdateRequest;

class ContractTypeController extends Controller
{
    public function index(Request $request): ContractTypeCollection
    {
        $this->authorize('view-any', ContractType::class);

        $search = $request->get('search', '');

        $contractTypes = ContractType::search($search)
            ->latest()
            ->paginate();

        return new ContractTypeCollection($contractTypes);
    }

    public function store(
        ContractTypeStoreRequest $request
    ): ContractTypeResource {
        $this->authorize('create', ContractType::class);

        $validated = $request->validated();

        $contractType = ContractType::create($validated);

        return new ContractTypeResource($contractType);
    }

    public function show(
        Request $request,
        ContractType $contractType
    ): ContractTypeResource {
        $this->authorize('view', $contractType);

        return new ContractTypeResource($contractType);
    }

    public function update(
        ContractTypeUpdateRequest $request,
        ContractType $contractType
    ): ContractTypeResource {
        $this->authorize('update', $contractType);

        $validated = $request->validated();

        $contractType->update($validated);

        return new ContractTypeResource($contractType);
    }

    public function destroy(
        Request $request,
        ContractType $contractType
    ): Response {
        $this->authorize('delete', $contractType);

        $contractType->delete();

        return response()->noContent();
    }
}
