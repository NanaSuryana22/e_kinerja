<?php

namespace App\Exports;

use App\Models\Kinerja;
use Maatwebsite\Excel\Concerns\FromCollection;

class KinerjaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja::all();
    }
}
