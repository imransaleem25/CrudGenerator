<?php
namespace Imransaleem\CrudGenerator\Http\Controllers;

use Illuminate\Routing\Controller;
use Imransaleem\CrudGenerator\Models\CrudStat;

class CrudStatsController extends Controller
{
    public function index()
    {
        $stats = CrudStat::all();
        return view('crud-generator::stats', compact('stats'));
    }
}
