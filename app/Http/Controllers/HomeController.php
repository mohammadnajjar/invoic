<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
// احصائية نسبة تنفيذ الحالات

        $count_all = Invoice::count();
        $count_invoices1 = Invoice::where('value_status', 1)->count() / $count_all * 100;
        $count_invoices2 = Invoice::where('value_status', 2)->count() / $count_all * 100;
        $count_invoices3 = Invoice::where('value_status', 3)->count() / $count_all * 100;
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 250])
            ->labels(['', 'غير المدفوعة', 'المدفوعة', 'المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "",
                    'backgroundColor' => ['#005EE9'],
                    'data' => [1]
                ],
                [
                    "label" => "غير المدفوعة",
                    'backgroundColor' => ['#F84D69'],
                    'data' => [$count_invoices1]
                ],
                [
                    "label" => "المدفوعة",
                    'backgroundColor' => ['#089B6B'],
                    'data' => [$count_invoices2]
                ],
                [
                    "label" => "المدفوعة جزئيا",
                    'backgroundColor' => ['#F67435'],
                    'data' => [$count_invoices3]
                ],

            ])
            ->options([]);

        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$count_invoices1, $count_invoices2, $count_invoices3]
                ]
            ])
            ->options([]);


        return view('home', compact('chartjs', 'chartjs_2'));
    }
}
