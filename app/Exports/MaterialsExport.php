<?php

namespace App\Exports;

use App\Http\Resources\Material\MaterialExportResource;
use App\Models\Material;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

/**
 * @property Project $project
 */
class MaterialsExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use HasHeadings;
    /**
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }
    /**
     * @return AnonymousResourceCollection
     */
    public function collection(): AnonymousResourceCollection
    {
        $materials = Material::query()->where('project_id', $this->project->id)->get();
        return MaterialExportResource::collection($materials);
    }
    /**
     * @return string[]
     */
}
