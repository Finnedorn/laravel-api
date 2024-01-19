<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // perche nei fillable non ho il campo tecnology ?
    // perchè mentre per category o u colegamento uno a molti tramite la category id
    // nel caso delle technologies ho un collegamento tramite project>id direttamente con la tabella ponte
    // quindi non mi serve dichiararlo nei fillable
    protected $fillable = ['user_id', 'project_title', 'repo_name','repo_link','slug','preview','description', 'category_id'];

    // ...qua invece creerò una funzione al singolare
    // in quanto user è uno a molti in relazione con projects
    // belongsTo(nomemodeltabelladiuno::class)
    // fatto abbiamo linkato le tabelle in relazione!
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function technologies() {
        // la funzione withTimeStamps() mi permette di passare alle entità di timestamps nella tabella ponte i
        // dati ogni qualvolta io interagisca con la tabella ponte per passare dati a technologies
        return $this->belongsToMany(Technology::class)->withTimestamps();
    }
}
