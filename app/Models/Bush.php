<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bush extends Model
{
    use HasFactory;

//    public mixed $projects;
    protected $guarded = false;
    protected $table = 'bushes';

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class, 'bush_id', 'id');
    }
}
