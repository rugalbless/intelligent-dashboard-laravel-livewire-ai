<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function getData()
    {
        $data = DB::table('sua_tabela')
            ->select(DB::raw('month, sum(desktop) as desktop, sum(mobile) as mobile'))
            ->groupBy('month')
            ->get();

        return response()->json($data);
    }
}
