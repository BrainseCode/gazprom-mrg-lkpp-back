<?php
namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\ContractType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContractTypeCollection;

class ContractContractTypesController extends Controller
{
    public function index(
        Request $request,
        Contract $contract
    ): ContractTypeCollection {
        $this->authorize('view', $contract);

        $search = $request->get('search', '');

        $contractTypes = $contract
            ->contractTypes()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContractTypeCollection($contractTypes);
    }

    public function store(
        Request $request,
        Contract $contract,
        ContractType $contractType
    ): Response {
        $this->authorize('update', $contract);

        $contract->contractTypes()->syncWithoutDetaching([$contractType->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Contract $contract,
        ContractType $contractType
    ): Response {
        $this->authorize('update', $contract);

        $contract->contractTypes()->detach($contractType);

        return response()->noContent();
    }
}
