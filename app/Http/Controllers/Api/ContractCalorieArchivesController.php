<?php

namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CalorieArchiveResource;
use App\Http\Resources\CalorieArchiveCollection;

class ContractCalorieArchivesController extends Controller
{
    public function index(
        Request $request,
        Contract $contract
    ): CalorieArchiveCollection {
        $this->authorize('view', $contract);

        $search = $request->get('search', '');

        $calorieArchives = $contract
            ->calorieArchives()
            ->search($search)
            ->latest()
            ->paginate();

        return new CalorieArchiveCollection($calorieArchives);
    }

    public function store(
        Request $request,
        Contract $contract
    ): CalorieArchiveResource {
        $this->authorize('create', CalorieArchive::class);

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'caloric' => ['required', 'numeric'],
            'quality_passport' => ['required', 'max:255', 'string'],
        ]);

        $calorieArchive = $contract->calorieArchives()->create($validated);

        return new CalorieArchiveResource($calorieArchive);
    }
}
