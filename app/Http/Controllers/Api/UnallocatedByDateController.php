<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UnallocatedByDate;
use App\Http\Controllers\Controller;
use App\Http\Resources\UnallocatedByDateResource;
use App\Http\Resources\UnallocatedByDateCollection;
use App\Http\Requests\UnallocatedByDateStoreRequest;
use App\Http\Requests\UnallocatedByDateUpdateRequest;

class UnallocatedByDateController extends Controller
{
    public function index(Request $request): UnallocatedByDateCollection
    {
        $this->authorize('view-any', UnallocatedByDate::class);

        $search = $request->get('search', '');

        $unallocatedByDates = UnallocatedByDate::search($search)
            ->latest()
            ->paginate();

        return new UnallocatedByDateCollection($unallocatedByDates);
    }

    public function store(
        UnallocatedByDateStoreRequest $request
    ): UnallocatedByDateResource {
        $this->authorize('create', UnallocatedByDate::class);

        $validated = $request->validated();

        $unallocatedByDate = UnallocatedByDate::create($validated);

        return new UnallocatedByDateResource($unallocatedByDate);
    }

    public function show(
        Request $request,
        UnallocatedByDate $unallocatedByDate
    ): UnallocatedByDateResource {
        $this->authorize('view', $unallocatedByDate);

        return new UnallocatedByDateResource($unallocatedByDate);
    }

    public function update(
        UnallocatedByDateUpdateRequest $request,
        UnallocatedByDate $unallocatedByDate
    ): UnallocatedByDateResource {
        $this->authorize('update', $unallocatedByDate);

        $validated = $request->validated();

        $unallocatedByDate->update($validated);

        return new UnallocatedByDateResource($unallocatedByDate);
    }

    public function destroy(
        Request $request,
        UnallocatedByDate $unallocatedByDate
    ): Response {
        $this->authorize('delete', $unallocatedByDate);

        $unallocatedByDate->delete();

        return response()->noContent();
    }
}
