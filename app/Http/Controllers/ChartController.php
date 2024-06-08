<?php
namespace App\Http\Controllers;

use App\Exports\ChartDataExport;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Form;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ChartController extends Controller
{
    public function index()
    {
        return view('LTOusers.ChartReport');
    }

    public function chartData(Request $request)
    {
        $xAxis = $request->input('xAxis');
        $yAxis = $request->input('yAxis');

        // Extract table and column names from the inputs
        [$xTable, $xColumn] = explode('.', $xAxis);
        [$yTable, $yColumn] = explode('.', $yAxis);

        // Adjust the select statement to include table aliases to avoid ambiguity
        $data = DB::table('users')
            ->join('forms', 'users.id', '=', 'forms.user_id')
            ->join('payments', 'forms.id', '=', 'payments.form_id')
            ->select("$xTable.$xColumn as xAxis", "$yTable.$yColumn as yAxis")
            ->get();

        // Extract labels and data values
        $labels = $data->pluck('xAxis')->toArray();
        $dataValues = $data->pluck('yAxis')->toArray();

        return response()->json([
            'labels' => $labels,
            'data' => $dataValues,
        ]);
    }
    public function exportChartData(Request $request)
    {
        $xAxis = $request->input('xAxis');
        $yAxis = $request->input('yAxis');

        return Excel::download(new ChartDataExport($xAxis, $yAxis), 'chart_data.xlsx');
    }

}
