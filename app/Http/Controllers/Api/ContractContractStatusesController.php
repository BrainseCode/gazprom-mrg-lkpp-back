<?php
namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContractStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContractStatusCollection;

class ContractContractStatusesController extends Controller
{
    public function index(
        Request $request,
        Contract $contract
    ): ContractStatusCollection {
        $this->authorize('view', $contract);

        $search = $request->get('search', '');

        $contractStatuses = $contract
            ->contractStatuses()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContractStatusCollection($contractStatuses);
    }

    public function store(
        Request $request,
        Contract $contract,
        ContractStatus $contractStatus
    ): Response {
        $this->authorize('update', $contract);

        $contract
            ->contractStatuses()
            ->syncWithoutDetaching([$contractStatus->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Contract $contract,
        ContractStatus $contractStatus
    ): Response {
        $this->authorize('update', $contract);

        $contract->contractStatuses()->detach($contractStatus);

        return response()->noContent();
    }
}
