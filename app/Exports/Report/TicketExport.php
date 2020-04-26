<?php

namespace App\Exports\Report;
use App\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TicketExport implements FromCollection, WithHeadings
{

    protected $src_type, $src_keyword, $start_date, $end_date;

    function __construct($src_type, $src_keyword, $start_date, $end_date) {
        $this->src_type = $src_type;
        $this->src_keyword = $src_keyword;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        return $ticket = Ticket::select('created_from','department','assing_to','priority','status','created_at')
                        ->where($this->src_type, $this->src_keyword)
                        ->whereBetween('created_at', [$this->start_date .' '.'00:00:01', $this->end_date .' '.'23:59:59'])
                        ->get();
    }

    public function headings(): array
    {
        return [
            'Created From',
            'Department',
            'Assigned To',
            'Priority',
            'Status',
            'Create Date',
        ];
    }
}
