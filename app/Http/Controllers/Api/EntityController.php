<?php

namespace App\Http\Controllers\Api;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;
use App\Http\Resources\EntityCollection;
use App\Http\Requests\EntityStoreRequest;
use App\Http\Requests\EntityUpdateRequest;

class EntityController extends Controller
{
    public function index(Request $request): EntityCollection
    {
        $this->authorize('view-any', Entity::class);

        $search = $request->get('search', '');

        $entities = Entity::search($search)
            ->latest()
            ->paginate();

        return new EntityCollection($entities);
    }

    public function store(EntityStoreRequest $request): EntityResource
    {
        $this->authorize('create', Entity::class);

        $validated = $request->validated();

        $entity = Entity::create($validated);

        return new EntityResource($entity);
    }

    public function show(
        Request $request,
        Entity $entity
    ): EntityResource {
        $this->authorize('view', $entity);

        return new EntityResource($entity);
    }

    public function update(
        EntityUpdateRequest $request,
        Entity $entity
    ): EntityResource {
        $this->authorize('update', $entity);

        $validated = $request->validated();

        $entity->update($validated);

        return new EntityResource($entity);
    }

    public function destroy(Request $request, Entity $entity): Response
    {
        $this->authorize('delete', $entity);

        $entity->delete();

        return response()->noContent();
    }
}
