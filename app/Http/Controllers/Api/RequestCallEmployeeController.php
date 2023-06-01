<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\RequestCallEmployee;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestCallEmployeeResource;
use App\Http\Resources\RequestCallEmployeeCollection;
use App\Http\Requests\RequestCallEmployeeStoreRequest;
use App\Http\Requests\RequestCallEmployeeUpdateRequest;

class RequestCallEmployeeController extends Controller
{
    public function index(Request $request): RequestCallEmployeeCollection
    {
        $this->authorize('view-any', RequestCallEmployee::class);

        $search = $request->get('search', '');

        $requestCallEmployees = RequestCallEmployee::search($search)
            ->latest()
            ->paginate();

        return new RequestCallEmployeeCollection($requestCallEmployees);
    }

    public function store(
        RequestCallEmployeeStoreRequest $request
    ): RequestCallEmployeeResource {
        $this->authorize('create', RequestCallEmployee::class);

        $validated = $request->validated();

        $requestCallEmployee = RequestCallEmployee::create($validated);

        return new RequestCallEmployeeResource($requestCallEmployee);
    }

    public function show(
        Request $request,
        RequestCallEmployee $requestCallEmployee
    ): RequestCallEmployeeResource {
        $this->authorize('view', $requestCallEmployee);

        return new RequestCallEmployeeResource($requestCallEmployee);
    }

    public function update(
        RequestCallEmployeeUpdateRequest $request,
        RequestCallEmployee $requestCallEmployee
    ): RequestCallEmployeeResource {
        $this->authorize('update', $requestCallEmployee);

        $validated = $request->validated();

        $requestCallEmployee->update($validated);

        return new RequestCallEmployeeResource($requestCallEmployee);
    }

    public function destroy(
        Request $request,
        RequestCallEmployee $requestCallEmployee
    ): Response {
        $this->authorize('delete', $requestCallEmployee);

        $requestCallEmployee->delete();

        return response()->noContent();
    }
}
