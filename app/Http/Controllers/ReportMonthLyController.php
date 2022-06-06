<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use PDF;

class ReportMonthLyController extends Controller
{
    public function index(){
        $data['activities'] = Activity::all();
        $pdf = PDF::loadView('laporan-bulanan.index', $data)->setPaper('A4', 'potrait');
        return $pdf->stream('laporan-bulanan.pdf');
        // return view('laporan-bulanan.index',$data);
    }
}
