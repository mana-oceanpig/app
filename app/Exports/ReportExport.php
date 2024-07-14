<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportExport implements FromView
{
    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function view(): View
    {
        return view('exports.report', ['report' => $this->report]);
    }

    public function download()
    {
        $pdf = Pdf::loadView('exports.report', ['report' => $this->report]);
        return $pdf->download('mental_health_report.pdf');
    }
}