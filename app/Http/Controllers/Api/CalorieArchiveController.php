<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CalorieArchive;
use App\Http\Controllers\Controller;
use App\Http\Resources\CalorieArchiveResource;
use App\Http\Resources\CalorieArchiveCollection;
use App\Http\Requests\CalorieArchiveStoreRequest;
use App\Http\Requests\CalorieArchiveUpdateRequest;

class CalorieArchiveController extends Controller
{
    public function index(Request $request): CalorieArchiveCollection
    {
        $this->authorize('view-any', CalorieArchive::class);

        $search = $request->get('search', '');

        $calorieArchives = CalorieArchive::search($search)
            ->latest()
            ->paginate();

        return new CalorieArchiveCollection($calorieArchives);
    }

    public function store(
        CalorieArchiveStoreRequest $request
    ): CalorieArchiveResource {
        $this->authorize('create', CalorieArchive::class);

        $validated = $request->validated();

        $calorieArchive = CalorieArchive::create($validated);

        return new CalorieArchiveResource($calorieArchive);
    }

    public function show(
        Request $request,
        CalorieArchive $calorieArchive
    ): CalorieArchiveResource {
        $this->authorize('view', $calorieArchive);

        return new CalorieArchiveResource($calorieArchive);
    }

    public function update(
        CalorieArchiveUpdateRequest $request,
        CalorieArchive $calorieArchive
    ): CalorieArchiveResource {
        $this->authorize('update', $calorieArchive);

        $validated = $request->validated();

        $calorieArchive->update($validated);

        return new CalorieArchiveResource($calorieArchive);
    }

    public function destroy(
        Request $request,
        CalorieArchive $calorieArchive
    ): Response {
        $this->authorize('delete', $calorieArchive);

        $calorieArchive->delete();

        return response()->noContent();
    }
}
