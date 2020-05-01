<?php

namespace App\Exports\Report;
use App\Ticket;
use App\User_group;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;

class SupervisorTicketExport implements FromCollection, WithHeadings, WithMapping
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
        return Ticket::select('created_from','department','assing_to','priority','status','created_at')
                    ->with('user_group', 'user_from_ticket', 'user_name_from_ticket')
                    ->where($this->src_type, $this->src_keyword)
                    ->whereBetween('created_at', [$this->start_date .' '.'00:00:01', $this->end_date .' '.'23:59:59'])
                    ->where('department', Auth::user()->user_group_id)
                    ->get();
    }

    public function map($ticket): array
    {
        if($ticket->priority == 1){$priority="Low";}else if($ticket->priority == 2){$priority="Medium";}else if($ticket->priority == 3){$priority="High";}
        if($ticket->status == 1){$status="New";}elseif($ticket->status == 2){$status="Pending";}elseif($ticket->status == 3){$status="Work In Progess";}elseif($ticket->status == 4){$status="Solve";}elseif($ticket->status == 5){$status="Wrong Ticket";}
                                       
        return [
            $ticket->user_from_ticket->name,
            $ticket->user_group->name,
            $ticket->user_name_from_ticket->name,
            $priority,
            $status,
            date('Y-m-d H:m', strtotime($ticket->created_at)),
        ];
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
