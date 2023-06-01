<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\RequestApprovalUnevenness;
use App\Http\Requests\RequestApprovalUnevennessStoreRequest;
use App\Http\Requests\RequestApprovalUnevennessUpdateRequest;

class RequestApprovalUnevennessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', RequestApprovalUnevenness::class);

        $search = $request->get('search', '');

        $requestApprovalUnevennesses = RequestApprovalUnevenness::search(
            $search
        )
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.request_approval_unevennesses.index',
            compact('requestApprovalUnevennesses', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', RequestApprovalUnevenness::class);

        $users = User::pluck('name', 'id');

        return view(
            'app.request_approval_unevennesses.create',
            compact('users')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        RequestApprovalUnevennessStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', RequestApprovalUnevenness::class);

        $validated = $request->validated();

        $requestApprovalUnevenness = RequestApprovalUnevenness::create(
            $validated
        );

        return redirect()
            ->route(
                'request-approval-unevennesses.edit',
                $requestApprovalUnevenness
            )
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): View {
        $this->authorize('view', $requestApprovalUnevenness);

        return view(
            'app.request_approval_unevennesses.show',
            compact('requestApprovalUnevenness')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): View {
        $this->authorize('update', $requestApprovalUnevenness);

        $users = User::pluck('name', 'id');

        return view(
            'app.request_approval_unevennesses.edit',
            compact('requestApprovalUnevenness', 'users')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RequestApprovalUnevennessUpdateRequest $request,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): RedirectResponse {
        $this->authorize('update', $requestApprovalUnevenness);

        $validated = $request->validated();

        $requestApprovalUnevenness->update($validated);

        return redirect()
            ->route(
                'request-approval-unevennesses.edit',
                $requestApprovalUnevenness
            )
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): RedirectResponse {
        $this->authorize('delete', $requestApprovalUnevenness);

        $requestApprovalUnevenness->delete();

        return redirect()
            ->route('request-approval-unevennesses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
