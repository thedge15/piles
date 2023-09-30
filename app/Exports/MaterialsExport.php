<?php

namespace App\Exports;

use App\Http\Resources\Material\MaterialExportResource;
use App\Models\Material;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

/**
 * @property Project $project
 */
class MaterialsExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function collection(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $materials = Material::query()->where('project_id', $this->project->id)->get();
        return MaterialExportResource::collection($materials);
    }

    public function headings(): array
    {
        return [
            '##',
            'Элемент',
            'Наименование',
            'Количество',
            'Ед.изм.',
            'Краска',
            'Количество, кг',
            'Цвет',
        ];
    }
}
