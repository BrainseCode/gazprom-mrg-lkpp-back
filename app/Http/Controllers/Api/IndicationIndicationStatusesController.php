<?php
namespace App\Http\Controllers\Api;

use App\Models\Indication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\IndicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationStatusCollection;

class IndicationIndicationStatusesController extends Controller
{
    public function index(
        Request $request,
        Indication $indication
    ): IndicationStatusCollection {
        $this->authorize('view', $indication);

        $search = $request->get('search', '');

        $indicationStatuses = $indication
            ->indicationStatuses()
            ->search($search)
            ->latest()
            ->paginate();

        return new IndicationStatusCollection($indicationStatuses);
    }

    public function store(
        Request $request,
        Indication $indication,
        IndicationStatus $indicationStatus
    ): Response {
        $this->authorize('update', $indication);

        $indication
            ->indicationStatuses()
            ->syncWithoutDetaching([$indicationStatus->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Indication $indication,
        IndicationStatus $indicationStatus
    ): Response {
        $this->authorize('update', $indication);

        $indication->indicationStatuses()->detach($indicationStatus);

        return response()->noContent();
    }
}
