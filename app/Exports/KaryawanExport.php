<?php

namespace App\Exports;

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KaryawanExport implements FromView
{
    public function view(): View
    {
        return view('karyawan.tes', [
            'karyawans' => User::all()
        ]);
    }
}