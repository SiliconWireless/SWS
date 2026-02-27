<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function pdf()
    {
        $assets = Asset::where('organization_id', Auth::user()->organization_id)->get();
        $pdf = Pdf::loadView('admin.reports.assets_pdf', compact('assets'));

        return $pdf->download('asset-report-user.pdf');
    }

    public function excel()
    {
        return Excel::download(new \App\Reports\AssetsExport(Auth::user()->organization_id), 'asset-report-user.xlsx');
    }
}
