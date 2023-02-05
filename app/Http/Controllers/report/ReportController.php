<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\cohort\Cohort;
use App\Models\item\NarrativeItem;
use App\Models\narrative_pointer\NarrativePointer;
use App\Models\programme\Programme;
use App\Models\region\Region;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Indicator narrative index
     */
    public function indicator_narrative()
    {
        // filters
        $narrative_pointers = NarrativePointer::get(['id', 'value']);
        $programmes = Programme::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        $cohorts = Cohort::get(['id', 'name']);


        return view('reports.indicator_narrative', compact('narrative_pointers', 'programmes', 'regions', 'cohorts'));
    }
    // datatable
    public function indicator_narrative_datatable()
    {
        $q = NarrativeItem::query();

        $narrative_pointer_id = request('narrative_pointer_id');
        $q->when($narrative_pointer_id, function($q) {
            $q->where('narrative_pointer_id', request('narrative_pointer_id'));
        }); 
        
        $narrative_items = $q->get();
        return view('reports.partial.indicator_narrative_datatable', compact('narrative_items'));
    }
}
