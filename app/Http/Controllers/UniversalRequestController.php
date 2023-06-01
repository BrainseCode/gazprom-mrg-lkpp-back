<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\UniversalRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UniversalRequestStoreRequest;
use App\Http\Requests\UniversalRequestUpdateRequest;

class UniversalRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', UniversalRequest::class);

        $search = $request->get('search', '');

        $universalRequests = UniversalRequest::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.universal_requests.index',
            compact('universalRequests', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', UniversalRequest::class);

        $users = User::pluck('name', 'id');

        return view('app.universal_requests.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        UniversalRequestStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', UniversalRequest::class);

        $validated = $request->validated();

        $universalRequest = UniversalRequest::create($validated);

        return redirect()
            ->route('universal-requests.edit', $universalRequest)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        UniversalRequest $universalRequest
    ): View {
        $this->authorize('view', $universalRequest);

        return view('app.universal_requests.show', compact('universalRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        UniversalRequest $universalRequest
    ): View {
        $this->authorize('update', $universalRequest);

        $users = User::pluck('name', 'id');

        return view(
            'app.universal_requests.edit',
            compact('universalRequest', 'users')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UniversalRequestUpdateRequest $request,
        UniversalRequest $universalRequest
    ): RedirectResponse {
        $this->authorize('update', $universalRequest);

        $validated = $request->validated();

        $universalRequest->update($validated);

        return redirect()
            ->route('universal-requests.edit', $universalRequest)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        UniversalRequest $universalRequest
    ): RedirectResponse {
        $this->authorize('delete', $universalRequest);

        $universalRequest->delete();

        return redirect()
            ->route('universal-requests.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
