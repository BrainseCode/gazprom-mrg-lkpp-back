<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UnallocatedByDate;
use App\Http\Controllers\Controller;
use App\Models\RequestApprovalUnevenness;
use App\Http\Resources\UnallocatedByDateCollection;

class RequestApprovalUnevennessUnallocatedByDatesController extends Controller
{
    public function index(
        Request $request,
        RequestApprovalUnevenness $requestApprovalUnevenness
    ): UnallocatedByDateCollection {
        $this->authorize('view', $requestApprovalUnevenness);

        $search = $request->get('search', '');

        $unallocatedByDates = $requestApprovalUnevenness
            ->unallocatedByDates()
            ->search($search)
            ->latest()
            ->paginate();

        return new UnallocatedByDateCollection($unallocatedByDates);
    }

    public function store(
        Request $request,
        RequestApprovalUnevenness $requestApprovalUnevenness,
        UnallocatedByDate $unallocatedByDate
    ): Response {
        $this->authorize('update', $requestApprovalUnevenness);

        $requestApprovalUnevenness
            ->unallocatedByDates()
            ->syncWithoutDetaching([$unallocatedByDate->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        RequestApprovalUnevenness $requestApprovalUnevenness,
        UnallocatedByDate $unallocatedByDate
    ): Response {
        $this->authorize('update', $requestApprovalUnevenness);

        $requestApprovalUnevenness
            ->unallocatedByDates()
            ->detach($unallocatedByDate);

        return response()->noContent();
    }
}
