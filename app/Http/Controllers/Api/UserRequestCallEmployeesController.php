<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestCallEmployeeResource;
use App\Http\Resources\RequestCallEmployeeCollection;

class UserRequestCallEmployeesController extends Controller
{
    public function index(
        Request $request,
        User $user
    ): RequestCallEmployeeCollection {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $requestCallEmployees = $user
            ->requestCallEmployees()
            ->search($search)
            ->latest()
            ->paginate();

        return new RequestCallEmployeeCollection($requestCallEmployees);
    }

    public function store(
        Request $request,
        User $user
    ): RequestCallEmployeeResource {
        $this->authorize('create', RequestCallEmployee::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'message' => ['required', 'max:255', 'string'],
        ]);

        $requestCallEmployee = $user
            ->requestCallEmployees()
            ->create($validated);

        return new RequestCallEmployeeResource($requestCallEmployee);
    }
}
