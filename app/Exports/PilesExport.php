<?php

namespace App\Exports;

use App\Models\Pile;
use Maatwebsite\Excel\Concerns\FromCollection;

class PilesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): \Illuminate\Support\Collection
    {
        return Pile::all();
    }
}
