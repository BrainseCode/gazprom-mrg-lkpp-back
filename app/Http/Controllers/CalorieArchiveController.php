<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CalorieArchive;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CalorieArchiveStoreRequest;
use App\Http\Requests\CalorieArchiveUpdateRequest;

class CalorieArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', CalorieArchive::class);

        $search = $request->get('search', '');

        $calorieArchives = CalorieArchive::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.calorie_archives.index',
            compact('calorieArchives', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', CalorieArchive::class);

        $contracts = Contract::pluck('name', 'id');

        return view('app.calorie_archives.create', compact('contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalorieArchiveStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', CalorieArchive::class);

        $validated = $request->validated();

        $calorieArchive = CalorieArchive::create($validated);

        return redirect()
            ->route('calorie-archives.edit', $calorieArchive)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, CalorieArchive $calorieArchive): View
    {
        $this->authorize('view', $calorieArchive);

        return view('app.calorie_archives.show', compact('calorieArchive'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, CalorieArchive $calorieArchive): View
    {
        $this->authorize('update', $calorieArchive);

        $contracts = Contract::pluck('name', 'id');

        return view(
            'app.calorie_archives.edit',
            compact('calorieArchive', 'contracts')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CalorieArchiveUpdateRequest $request,
        CalorieArchive $calorieArchive
    ): RedirectResponse {
        $this->authorize('update', $calorieArchive);

        $validated = $request->validated();

        $calorieArchive->update($validated);

        return redirect()
            ->route('calorie-archives.edit', $calorieArchive)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        CalorieArchive $calorieArchive
    ): RedirectResponse {
        $this->authorize('delete', $calorieArchive);

        $calorieArchive->delete();

        return redirect()
            ->route('calorie-archives.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
