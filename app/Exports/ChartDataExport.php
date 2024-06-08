<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ChartDataExport implements FromCollection
{
    protected $xAxis;
    protected $yAxis;

    public function __construct($xAxis, $yAxis)
    {
        $this->xAxis = $xAxis;
        $this->yAxis = $yAxis;
    }

    public function collection()
    {
        // Extract table and column names
        [$xTable, $xColumn] = explode('.', $this->xAxis);
        [$yTable, $yColumn] = explode('.', $this->yAxis);

        // Fetch data based on selected axes
        $data = DB::table('users')
            ->join('forms', 'users.id', '=', 'forms.user_id')
            ->join('payments', 'forms.id', '=', 'payments.form_id')
            ->select("$xTable.$xColumn as xAxis", "$yTable.$yColumn as yAxis")
            ->get();

        return $data;
    }
}
