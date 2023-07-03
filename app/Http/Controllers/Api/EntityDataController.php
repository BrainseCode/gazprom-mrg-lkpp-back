<?php

namespace App\Http\Controllers\Api;

use App\Models\EntityData;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntityDataResource;
use App\Http\Resources\EntityDataCollection;
use App\Http\Requests\EntityDataStoreRequest;
use App\Http\Requests\EntityDataUpdateRequest;

class EntityDataController extends Controller
{
    public function index(Request $request): EntityDataCollection
    {
        $this->authorize('view-any', EntityData::class);

        $search = $request->get('search', '');

        $entityDatas = EntityData::search($search)
            ->latest()
            ->paginate();

        return new EntityDataCollection($entityDatas);
    }

    public function store(EntityDataStoreRequest $request): EntityDataResource
    {
        $this->authorize('create', EntityData::class);

        $validated = $request->validated();

        $entityData = EntityData::create($validated);

        return new EntityDataResource($entityData);
    }

    public function show(
        Request $request,
        EntityData $entityData
    ): EntityDataResource {
        $this->authorize('view', $entityData);

        return new EntityDataResource($entityData);
    }

    public function update(
        EntityDataUpdateRequest $request,
        EntityData $entityData
    ): EntityDataResource {
        $this->authorize('update', $entityData);

        $validated = $request->validated();

        $entityData->update($validated);

        return new EntityDataResource($entityData);
    }

    public function destroy(Request $request, EntityData $entityData): Response
    {
        $this->authorize('delete', $entityData);

        $entityData->delete();

        return response()->noContent();
    }
}
