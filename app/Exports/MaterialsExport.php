<?php

namespace App\Exports;

use App\Models\Material;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

/**
 * @property Project $project
 */
class MaterialsExport implements FromCollection
{
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function collection(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Support\Collection
    {
        return Material::query()->where('project_id', $this->project->id)->get();
    }
}
