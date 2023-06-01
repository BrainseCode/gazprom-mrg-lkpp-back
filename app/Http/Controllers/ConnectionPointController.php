<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ConnectionPoint;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ConnectionPointStoreRequest;
use App\Http\Requests\ConnectionPointUpdateRequest;

class ConnectionPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ConnectionPoint::class);

        $search = $request->get('search', '');

        $connectionPoints = ConnectionPoint::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.connection_points.index',
            compact('connectionPoints', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ConnectionPoint::class);

        $contracts = Contract::pluck('name', 'id');

        return view('app.connection_points.create', compact('contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ConnectionPointStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ConnectionPoint::class);

        $validated = $request->validated();

        $connectionPoint = ConnectionPoint::create($validated);

        return redirect()
            ->route('connection-points.edit', $connectionPoint)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ConnectionPoint $connectionPoint
    ): View {
        $this->authorize('view', $connectionPoint);

        return view('app.connection_points.show', compact('connectionPoint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ConnectionPoint $connectionPoint
    ): View {
        $this->authorize('update', $connectionPoint);

        $contracts = Contract::pluck('name', 'id');

        return view(
            'app.connection_points.edit',
            compact('connectionPoint', 'contracts')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ConnectionPointUpdateRequest $request,
        ConnectionPoint $connectionPoint
    ): RedirectResponse {
        $this->authorize('update', $connectionPoint);

        $validated = $request->validated();

        $connectionPoint->update($validated);

        return redirect()
            ->route('connection-points.edit', $connectionPoint)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ConnectionPoint $connectionPoint
    ): RedirectResponse {
        $this->authorize('delete', $connectionPoint);

        $connectionPoint->delete();

        return redirect()
            ->route('connection-points.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
