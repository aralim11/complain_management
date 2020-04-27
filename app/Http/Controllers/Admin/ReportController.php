<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ticket;
use App\Exports\Report\TicketExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $count = 0;
        $src_type = '';
        $src_keyword = '';
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        return view('admin.report.index', compact('count', 'src_type', 'src_keyword', 'end_date', 'start_date'));
    }


    public function reportSearch()
    {
        $src_type = $_GET['src_type'];
        $src_keyword = $_GET['src_keyword'];
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];

        $search = Ticket::where($src_type, $src_keyword)
                        ->whereBetween('created_at', [$start_date .' '.'00:00:01', $end_date .' '.'23:59:59'])
                        ->get();
        $count = count($search);

        return view('admin.report.index', compact('search', 'src_type', 'src_keyword', 'count', 'start_date', 'end_date'));
    }

    public function export($src_type,$src_keyword,$start_date,$end_date)
    {
        $name = date('Y_m_d_H_m_s');
        return Excel::download(new TicketExport($src_type, $src_keyword, $start_date, $end_date), $name.'.xlsx');
    }

    
}
