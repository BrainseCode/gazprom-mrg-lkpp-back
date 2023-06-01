<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ConnectionPoint;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndicationQuarterResource;
use App\Http\Resources\IndicationQuarterCollection;

class ConnectionPointIndicationQuartersController extends Controller
{
    public function index(
        Request $request,
        ConnectionPoint $connectionPoint
    ): IndicationQuarterCollection {
        $this->authorize('view', $connectionPoint);

        $search = $request->get('search', '');

        $indicationQuarters = $connectionPoint
            ->indicationQuarters()
            ->search($search)
            ->latest()
            ->paginate();

        return new IndicationQuarterCollection($indicationQuarters);
    }

    public function store(
        Request $request,
        ConnectionPoint $connectionPoint
    ): IndicationQuarterResource {
        $this->authorize('create', IndicationQuarter::class);

        $validated = $request->validate([
            'date_year' => ['required', 'numeric'],
            'year' => ['required', 'numeric'],
            'quarter_1' => ['required', 'numeric'],
            'quarter_2' => ['required', 'numeric'],
            'quarter_3' => ['required', 'numeric'],
            'quarter_4' => ['required', 'numeric'],
            'january' => ['required', 'numeric'],
            'february' => ['required', 'numeric'],
            'march' => ['required', 'numeric'],
            'april' => ['required', 'numeric'],
            'may' => ['required', 'numeric'],
            'june' => ['required', 'numeric'],
            'july' => ['required', 'numeric'],
            'august' => ['required', 'numeric'],
            'september' => ['required', 'numeric'],
            'october' => ['required', 'numeric'],
            'november' => ['required', 'numeric'],
            'december' => ['required', 'numeric'],
        ]);

        $indicationQuarter = $connectionPoint
            ->indicationQuarters()
            ->create($validated);

        return new IndicationQuarterResource($indicationQuarter);
    }
}
