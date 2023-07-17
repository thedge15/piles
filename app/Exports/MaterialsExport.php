<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;

class MaterialsExport implements FromCollection
{


    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
    * @return Project
     */
    public function collection(): Project
    {

        return $this->project;
    }
}
