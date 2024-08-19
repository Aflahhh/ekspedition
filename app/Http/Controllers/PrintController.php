<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrintController extends Controller
{
    public function index(Request $get)
    {
        $start_date = $get->start;
        $end_date = $get->end;
        return Excel::download(new TransaksiExport($start_date, $end_date), 'ongkos_angkut.xlsx');
    }
}
