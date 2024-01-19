<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //
    public function index()
    {
        // anche qua al posto di Project::all() potrei usare la funzione paginate
        $projects = Project::with(['category', 'technologies'])->paginate(5);
        // come nell'index del controller base anche qua la formula è simile
        // ma qua chiedo di resitutire un json
        return response()->json(
            [
                'success'=>true,
                'results'=>$projects
            ]
        );
    }

    public function show($id)
    {
        // eager loading, la funzione with() mi permette di associare eventuali elementi in relazione con project
        // first() mi prende il primo risultato disponibile associato a quell'id
        $project = Project::where('id', $id)->with(['category', 'technologies'])->first();
        return response()->json(
            [
                'success'=>true,
                'results'=>$project
            ]
        );
    }
}
