<?php
namespace App\Http\Controllers;

use App\Models\Laporan;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.laporan.index', compact('laporans'));
    }
}
