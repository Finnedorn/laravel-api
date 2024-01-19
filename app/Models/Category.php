<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // gli dico che cosa non deve salvare con guarded
    protected $fillable = ['name','slug'];

    public function projects() {
        return $this->hasMany(Project::class);
    }
}
