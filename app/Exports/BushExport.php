<?php

namespace App\Exports;

use App\Http\Resources\Material\MaterialExportResource;
use App\Models\Bush;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

/**
 * @property Bush $bush
 */
class BushExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use HasHeadings;
    public function __construct(Bush $bush)
    {
        $this->bush = $bush;
    }

    public function collection(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $projects = $this->bush->projects;

        /** @var TYPE_NAME $bushMaterials */
        $bushMaterials = [];

        foreach ($projects as $project) {
            foreach ($project->materials as $item) {
                $bushMaterials[] = $item;
            }
        }

        return MaterialExportResource::collection($bushMaterials);
    }
}
