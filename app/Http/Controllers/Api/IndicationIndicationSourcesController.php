<?php
namespace App\Http\Controllers\Api;

use App\Models\Indication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\IndicationSource;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationSourceCollection;

class IndicationIndicationSourcesController extends Controller
{
    public function index(
        Request $request,
        Indication $indication
    ): IndicationSourceCollection {
        $this->authorize('view', $indication);

        $search = $request->get('search', '');

        $indicationSources = $indication
            ->indicationSources()
            ->search($search)
            ->latest()
            ->paginate();

        return new IndicationSourceCollection($indicationSources);
    }

    public function store(
        Request $request,
        Indication $indication,
        IndicationSource $indicationSource
    ): Response {
        $this->authorize('update', $indication);

        $indication
            ->indicationSources()
            ->syncWithoutDetaching([$indicationSource->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Indication $indication,
        IndicationSource $indicationSource
    ): Response {
        $this->authorize('update', $indication);

        $indication->indicationSources()->detach($indicationSource);

        return response()->noContent();
    }
}
