<?php
namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\ContractType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContractCollection;

class ContractTypeContractsController extends Controller
{
    public function index(
        Request $request,
        ContractType $contractType
    ): ContractCollection {
        $this->authorize('view', $contractType);

        $search = $request->get('search', '');

        $contracts = $contractType
            ->contracts()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContractCollection($contracts);
    }

    public function store(
        Request $request,
        ContractType $contractType,
        Contract $contract
    ): Response {
        $this->authorize('update', $contractType);

        $contractType->contracts()->syncWithoutDetaching([$contract->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        ContractType $contractType,
        Contract $contract
    ): Response {
        $this->authorize('update', $contractType);

        $contractType->contracts()->detach($contract);

        return response()->noContent();
    }
}
