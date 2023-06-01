<?php
namespace App\Http\Controllers\Api;

use App\Models\Indication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\IndicationSource;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationCollection;

class IndicationSourceIndicationsController extends Controller
{
    public function index(
        Request $request,
        IndicationSource $indicationSource
    ): IndicationCollection {
        $this->authorize('view', $indicationSource);

        $search = $request->get('search', '');

        $indications = $indicationSource
            ->indications()
            ->search($search)
            ->latest()
            ->paginate();

        return new IndicationCollection($indications);
    }

    public function store(
        Request $request,
        IndicationSource $indicationSource,
        Indication $indication
    ): Response {
        $this->authorize('update', $indicationSource);

        $indicationSource
            ->indications()
            ->syncWithoutDetaching([$indication->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        IndicationSource $indicationSource,
        Indication $indication
    ): Response {
        $this->authorize('update', $indicationSource);

        $indicationSource->indications()->detach($indication);

        return response()->noContent();
    }
}
