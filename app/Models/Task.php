<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'project',
        'hours',
        'remarks',
        'date',
        'user_id',
        'updated_by',
    ];
    public function projects()
    {
        return $this->belongsTo(Project::class, 'project', 'id');
    }
    public function employee()
    {
        return $this->belongsTo(Employes::class, 'user_id', 'id');
    }
}
