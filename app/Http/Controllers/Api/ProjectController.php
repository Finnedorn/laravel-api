<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //
    // con Request $request io sto effettuando una dependency injection: ovvero sto importando una classe
    // cioè request che mi gestisce i pacchetti di dati dal form (formData)
    // dentro la funzione index di un'altra classe che in questo caso è projectcontroller, per farla funzionare
    public function index(Request $request)
    {

        if($request->query('category')){
            $projects = Project::where('category_id', $request->query('category'))->get();
        } else {
            // anche qua al posto di Project::all() potrei usare la funzione paginate
            $projects = Project::with(['category', 'technologies'])->paginate(5);
        }

        // come nell'index del controller base anche qua la formula è simile
        // ma qua chiedo di resitutire un json
        return response()->json(
            [
                'success'=>true,
                'results'=>$projects
            ]
        );
    }

    public function show($slug)
    {
        // eager loading, la funzione with() mi permette di associare eventuali elementi in relazione con project
        // first() mi prende il primo risultato disponibile associato a quell'id e mi restituisce un oggetto e non un array come get
        // in with io andrò a richiamare le funzioni legate alle relazioni del model project
        $project = Project::where('slug', $slug)->with(['category', 'technologies'])->first();
        return response()->json(
            [
                'success'=>true,
                'results'=>$project
            ]
        );
    }
}
