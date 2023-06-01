<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\UnallocatedByDate;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UnallocatedByDateStoreRequest;
use App\Http\Requests\UnallocatedByDateUpdateRequest;

class UnallocatedByDateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', UnallocatedByDate::class);

        $search = $request->get('search', '');

        $unallocatedByDates = UnallocatedByDate::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.unallocated_by_dates.index',
            compact('unallocatedByDates', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', UnallocatedByDate::class);

        return view('app.unallocated_by_dates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        UnallocatedByDateStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', UnallocatedByDate::class);

        $validated = $request->validated();

        $unallocatedByDate = UnallocatedByDate::create($validated);

        return redirect()
            ->route('unallocated-by-dates.edit', $unallocatedByDate)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        UnallocatedByDate $unallocatedByDate
    ): View {
        $this->authorize('view', $unallocatedByDate);

        return view(
            'app.unallocated_by_dates.show',
            compact('unallocatedByDate')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        UnallocatedByDate $unallocatedByDate
    ): View {
        $this->authorize('update', $unallocatedByDate);

        return view(
            'app.unallocated_by_dates.edit',
            compact('unallocatedByDate')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UnallocatedByDateUpdateRequest $request,
        UnallocatedByDate $unallocatedByDate
    ): RedirectResponse {
        $this->authorize('update', $unallocatedByDate);

        $validated = $request->validated();

        $unallocatedByDate->update($validated);

        return redirect()
            ->route('unallocated-by-dates.edit', $unallocatedByDate)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        UnallocatedByDate $unallocatedByDate
    ): RedirectResponse {
        $this->authorize('delete', $unallocatedByDate);

        $unallocatedByDate->delete();

        return redirect()
            ->route('unallocated-by-dates.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
