<?php

namespace App\Http\Controllers\Api;

use App\Models\EntityType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntityTypeResource;
use App\Http\Resources\EntityTypeCollection;
use App\Http\Requests\EntityTypeStoreRequest;
use App\Http\Requests\EntityTypeUpdateRequest;

class EntityTypeController extends Controller
{
    public function index(Request $request): EntityTypeCollection
    {
        $this->authorize('view-any', EntityType::class);

        $search = $request->get('search', '');

        $entityTypes = EntityType::search($search)
            ->latest()
            ->paginate();

        return new EntityTypeCollection($entityTypes);
    }

    public function store(EntityTypeStoreRequest $request): EntityTypeResource
    {
        $this->authorize('create', EntityType::class);

        $validated = $request->validated();

        $entityType = EntityType::create($validated);

        return new EntityTypeResource($entityType);
    }

    public function show(
        Request $request,
        EntityType $entityType
    ): EntityTypeResource {
        $this->authorize('view', $entityType);

        return new EntityTypeResource($entityType);
    }

    public function update(
        EntityTypeUpdateRequest $request,
        EntityType $entityType
    ): EntityTypeResource {
        $this->authorize('update', $entityType);

        $validated = $request->validated();

        $entityType->update($validated);

        return new EntityTypeResource($entityType);
    }

    public function destroy(Request $request, EntityType $entityType): Response
    {
        $this->authorize('delete', $entityType);

        $entityType->delete();

        return response()->noContent();
    }
}
