<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\RequestCallEmployee;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RequestCallEmployeeStoreRequest;
use App\Http\Requests\RequestCallEmployeeUpdateRequest;

class RequestCallEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', RequestCallEmployee::class);

        $search = $request->get('search', '');

        $requestCallEmployees = RequestCallEmployee::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.request_call_employees.index',
            compact('requestCallEmployees', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', RequestCallEmployee::class);

        return view('app.request_call_employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        RequestCallEmployeeStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', RequestCallEmployee::class);

        $validated = $request->validated();

        $requestCallEmployee = RequestCallEmployee::create($validated);

        return redirect()
            ->route('request-call-employees.edit', $requestCallEmployee)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        RequestCallEmployee $requestCallEmployee
    ): View {
        $this->authorize('view', $requestCallEmployee);

        return view(
            'app.request_call_employees.show',
            compact('requestCallEmployee')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        RequestCallEmployee $requestCallEmployee
    ): View {
        $this->authorize('update', $requestCallEmployee);

        return view(
            'app.request_call_employees.edit',
            compact('requestCallEmployee')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RequestCallEmployeeUpdateRequest $request,
        RequestCallEmployee $requestCallEmployee
    ): RedirectResponse {
        $this->authorize('update', $requestCallEmployee);

        $validated = $request->validated();

        $requestCallEmployee->update($validated);

        return redirect()
            ->route('request-call-employees.edit', $requestCallEmployee)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        RequestCallEmployee $requestCallEmployee
    ): RedirectResponse {
        $this->authorize('delete', $requestCallEmployee);

        $requestCallEmployee->delete();

        return redirect()
            ->route('request-call-employees.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
