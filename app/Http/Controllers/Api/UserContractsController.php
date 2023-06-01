<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContractResource;
use App\Http\Resources\ContractCollection;

class UserContractsController extends Controller
{
    public function index(Request $request, User $user): ContractCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $contracts = $user
            ->contracts()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContractCollection($contracts);
    }

    public function store(Request $request, User $user): ContractResource
    {
        $this->authorize('create', Contract::class);

        $validated = $request->validate([
            'number' => ['required', 'numeric'],
            'name' => ['required', 'max:255', 'string'],
            'reporting_hour' => ['required', 'date_format:H:i:s'],
            'registration_date' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'arrears' => ['required', 'numeric'],
            'request_approval_unevenness_id' => [
                'required',
                'exists:request_approval_unevennesses,id',
            ],
        ]);

        $contract = $user->contracts()->create($validated);

        return new ContractResource($contract);
    }
}
