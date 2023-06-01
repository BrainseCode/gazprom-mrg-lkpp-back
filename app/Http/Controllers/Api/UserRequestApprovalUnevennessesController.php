<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestApprovalUnevennessResource;
use App\Http\Resources\RequestApprovalUnevennessCollection;

class UserRequestApprovalUnevennessesController extends Controller
{
    public function index(
        Request $request,
        User $user
    ): RequestApprovalUnevennessCollection {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $requestApprovalUnevennesses = $user
            ->requestApprovalUnevennesses()
            ->search($search)
            ->latest()
            ->paginate();

        return new RequestApprovalUnevennessCollection(
            $requestApprovalUnevennesses
        );
    }

    public function store(
        Request $request,
        User $user
    ): RequestApprovalUnevennessResource {
        $this->authorize('create', RequestApprovalUnevenness::class);

        $validated = $request->validate([
            'gas_volume' => ['required', 'numeric'],
            'gas_volume_unallocated' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
        ]);

        $requestApprovalUnevenness = $user
            ->requestApprovalUnevennesses()
            ->create($validated);

        return new RequestApprovalUnevennessResource(
            $requestApprovalUnevenness
        );
    }
}
