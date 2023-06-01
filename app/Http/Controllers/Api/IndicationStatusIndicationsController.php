<?php
namespace App\Http\Controllers\Api;

use App\Models\Indication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\IndicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationCollection;

class IndicationStatusIndicationsController extends Controller
{
    public function index(
        Request $request,
        IndicationStatus $indicationStatus
    ): IndicationCollection {
        $this->authorize('view', $indicationStatus);

        $search = $request->get('search', '');

        $indications = $indicationStatus
            ->indications()
            ->search($search)
            ->latest()
            ->paginate();

        return new IndicationCollection($indications);
    }

    public function store(
        Request $request,
        IndicationStatus $indicationStatus,
        Indication $indication
    ): Response {
        $this->authorize('update', $indicationStatus);

        $indicationStatus
            ->indications()
            ->syncWithoutDetaching([$indication->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        IndicationStatus $indicationStatus,
        Indication $indication
    ): Response {
        $this->authorize('update', $indicationStatus);

        $indicationStatus->indications()->detach($indication);

        return response()->noContent();
    }
}
