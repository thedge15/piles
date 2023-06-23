<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pile extends Model
{
    protected $guarded = false;
    protected $table = 'piles';

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
