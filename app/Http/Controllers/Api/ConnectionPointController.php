<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ConnectionPoint;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConnectionPointResource;
use App\Http\Resources\ConnectionPointCollection;
use App\Http\Requests\ConnectionPointStoreRequest;
use App\Http\Requests\ConnectionPointUpdateRequest;

class ConnectionPointController extends Controller
{
    public function index(Request $request): ConnectionPointCollection
    {
        $this->authorize('view-any', ConnectionPoint::class);

        $search = $request->get('search', '');

        $connectionPoints = ConnectionPoint::search($search)
            ->latest()
            ->paginate();

        return new ConnectionPointCollection($connectionPoints);
    }

    public function store(
        ConnectionPointStoreRequest $request
    ): ConnectionPointResource {
        $this->authorize('create', ConnectionPoint::class);

        $validated = $request->validated();

        $connectionPoint = ConnectionPoint::create($validated);

        return new ConnectionPointResource($connectionPoint);
    }

    public function show(
        Request $request,
        ConnectionPoint $connectionPoint
    ): ConnectionPointResource {
        $this->authorize('view', $connectionPoint);

        return new ConnectionPointResource($connectionPoint);
    }

    public function update(
        ConnectionPointUpdateRequest $request,
        ConnectionPoint $connectionPoint
    ): ConnectionPointResource {
        $this->authorize('update', $connectionPoint);

        $validated = $request->validated();

        $connectionPoint->update($validated);

        return new ConnectionPointResource($connectionPoint);
    }

    public function destroy(
        Request $request,
        ConnectionPoint $connectionPoint
    ): Response {
        $this->authorize('delete', $connectionPoint);

        $connectionPoint->delete();

        return response()->noContent();
    }
}
