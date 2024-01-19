<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserDetail extends Model
{
    use HasFactory;
    // avendo creato ormai la tabella al singolare e il model al singolare, esco dalle convenzioni di laravel
    // pertanto con questa dicitura associo la tabella al model manualmente
    protected $table = 'user_detail';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
