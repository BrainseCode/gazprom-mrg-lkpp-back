<?php

namespace App\Http\Controllers\Api;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AllIndicationQuarterResource;
use App\Http\Resources\AllIndicationQuarterCollection;

class ContractAllIndicationQuartersController extends Controller
{
    public function index(
        Request $request,
        Contract $contract
    ): AllIndicationQuarterCollection {
        $this->authorize('view', $contract);

        $search = $request->get('search', '');

        $allIndicationQuarters = $contract
            ->allIndicationQuarters()
            ->search($search)
            ->latest()
            ->paginate();

        return new AllIndicationQuarterCollection($allIndicationQuarters);
    }

    public function store(
        Request $request,
        Contract $contract
    ): AllIndicationQuarterResource {
        $this->authorize('create', AllIndicationQuarter::class);

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

        $allIndicationQuarter = $contract
            ->allIndicationQuarters()
            ->create($validated);

        return new AllIndicationQuarterResource($allIndicationQuarter);
    }
}
