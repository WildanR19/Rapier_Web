<?php

namespace App\Exports;

use App\Models\Leave;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeaveExport implements FromCollection, WithMapping, WithHeadings
{
    // use Exportable;

    public function __construct(int $user_id, int $month, int $year)
    {
        $this->user_id = $user_id;
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        return Leave::with('user')->where('user_id', $this->user_id)->whereMonth('from_date', $this->month)->whereYear('from_date', $this->year)->get();
    }

    public function map($leave) : array {
        return [
            $leave->id,
            $leave->user->name,
            $leave->type->type_name,
            $leave->duration,
            Carbon::parse($leave->from_date)->toFormattedDateString(),
            Carbon::parse($leave->to_date)->toFormattedDateString(),
            $leave->reason,
            $leave->status,
            $leave->reject_reson,
            Carbon::parse($leave->created_at)->toFormattedDateString()
        ] ;
    }
    
    public function headings(): array
    {
        return [
            "#", "Employee", "Leave Type", "Duration", "From Date", "To Date", "Reason", "Status", "Reject Reason", "Created at"
        ];
    }
}
