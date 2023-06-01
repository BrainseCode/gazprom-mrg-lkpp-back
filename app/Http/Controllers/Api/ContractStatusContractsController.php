<?php
namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContractStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContractCollection;

class ContractStatusContractsController extends Controller
{
    public function index(
        Request $request,
        ContractStatus $contractStatus
    ): ContractCollection {
        $this->authorize('view', $contractStatus);

        $search = $request->get('search', '');

        $contracts = $contractStatus
            ->contracts()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContractCollection($contracts);
    }

    public function store(
        Request $request,
        ContractStatus $contractStatus,
        Contract $contract
    ): Response {
        $this->authorize('update', $contractStatus);

        $contractStatus->contracts()->syncWithoutDetaching([$contract->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        ContractStatus $contractStatus,
        Contract $contract
    ): Response {
        $this->authorize('update', $contractStatus);

        $contractStatus->contracts()->detach($contract);

        return response()->noContent();
    }
}
