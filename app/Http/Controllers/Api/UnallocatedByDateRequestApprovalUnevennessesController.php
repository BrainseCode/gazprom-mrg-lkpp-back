<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UnallocatedByDate;
use App\Http\Controllers\Controller;
use App\Models\RequestApprovalUnevenness;
use App\Http\Resources\RequestApprovalUnevennessCollection;

class UnallocatedByDateRequestApprovalUnevennessesController extends Controller
{
    public function index(
        Request $request,
        UnallocatedByDate $unallocatedByDate
    ): RequestApprovalUnevennessCollection {
        $this->authorize('view', $unallocatedByDate);

        $search = $request->get('search', '');

        $requestApprovalUnevennesses = $unallocatedByDate
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
        UnallocatedByDate $unallocatedByDate,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): Response {
        $this->authorize('update', $unallocatedByDate);

        $unallocatedByDate
            ->requestApprovalUnevennesses()
            ->syncWithoutDetaching([$requestApprovalUnevenness->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        UnallocatedByDate $unallocatedByDate,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): Response {
        $this->authorize('update', $unallocatedByDate);

        $unallocatedByDate
            ->requestApprovalUnevennesses()
            ->detach($requestApprovalUnevenness);

        return response()->noContent();
    }
}
