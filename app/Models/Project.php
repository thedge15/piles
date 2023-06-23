<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

//    public mixed $piles;
    protected $guarded = false;
    protected $table = 'projects';
    protected $with = 'bush';

    public function bush(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bush::class, 'bush_id', 'id');
    }

    public function piles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pile::class, 'project_id', 'id');
    }

    public function materials(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Material::class, 'project_id', 'id');
    }

    public function elements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Element::class, 'project_id', 'id');
    }
}
