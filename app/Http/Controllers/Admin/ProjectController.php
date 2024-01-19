<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

use App\Models\Category;

use App\Models\Technology;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // non voglio che un utente nuovo possa eliminarmi i dati che ho creato
        // creo una variabile che contenda l'utente attuale
        $currentUserId = Auth::id();
        // il metodo paginate(numeroelementidamostrare) invece di $projects = Project::all()
        // mi permette di gestire quanti elementi voglio in pagina
        // ma per la paginazione serve anche altro, apriamo la index di project...
        if ($currentUserId == 1) {
            $projects = Project::paginate(5);
        }else {
            // pesco quindi i project dove l'user_id dell'utente è uguale all'utente che attualmente ha fatto logIn
            $projects = Project::where('user_id', $currentUserId)->paginate(5);
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories= Category::all();
        $technologies= Technology::all();
        return view('admin.projects.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //
        $formData = $request->validated();
        $slug = Str::slug($formData['project_title'],'-');
        $formData['slug'] = $slug;

        // formula per la storage dei file img dal campo form "preview"
        if($request->hasFile('preview')) {
            $preview = Storage::put('previews', $formData['preview']);
            $formData['preview'] = $preview;
        }
        // prendo l'id dell'utente che sta creando questo pacchetto dati
        $userId = Auth::id();
        // e lo associo al dato in tabella user_id
        // in questo modo posso risalire al creatore del contenuto tramite l'user id
        $formData['user_id'] = $userId;
        $newProject = Project::create($formData);

        // dopo che ho salvato il new project ho il project id di quel pacchetto dati
        // che è legato alla tabella ponte (con technologies)
        // mi avarrò dei metodi attach() e detach()

        // se request ha elementi tecnologies dal form check technologies
        if($request->has('technologies')){
            // il new project richiamera la funzione technologies presente nel suo allaccio alla tabella ponte
            // in project model
            // e aggiungici gli elementi checked dal form
            $newProject->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.show', $newProject->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        // sei l'utente loggato che ha registrato quei progetti? bene accedi alla pagina
        // altrimenti abort(403)
        $currentUserId = Auth::id();
        if($currentUserId == $project->user_id || $currentUserId == 1){
            $categories= Category::all();
            $technologies= Technology::all();
            return view('admin.projects.show', compact('project', 'categories', 'technologies'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
        $currentUserId = Auth::id();
        if($currentUserId == $project->user_id || $currentUserId == 1){
            $categories= Category::all();
            $technologies= Technology::all();
            return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
        $formData = $request->validated();
        $slug = Str::slug($formData['project_title'],'-');
        $formData['slug'] = $slug;
        $formData['user_id'] = $project->user_id;
        if($request->hasFile('preview')) {
            // uguale a quella dello store ma qua devo specificare di cancellare prima la preview di quel project
            if ($project->preview){
                Storage::delete($project->preview);
            }
            $preview = Storage::put('previews', $formData['preview']);
            $formData['preview'] = $preview;
        }
        $project->update($formData);

        // se request ha elementi tecnologies dal form check technologies
        if($request->has('technologies')){
            // il new project richiamera la funzione technologies presente nel suo allaccio alla tabella ponte
            // in project model
            // e synca gli elementi in tabella con quelli presenti nell'array degli elementi checkati
            // cioè elimina quelli che non hanno il check
            $project->technologies()->sync($request->technologies);
        } else {
            // se non ha elementi selezionati
            // togli tutti gli elementi della tabella technologies associati a quell'id
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        $currentUserId = Auth::id();
        if($currentUserId != $project->user_id && $currentUserId != 1){
            abort(403);
        }
        // la funzione detach scollega automaticamente tutti gli elementi della tabella legati a quel campo
        // è utile solo in funzione del delete
        $project->technologies()->detach();

        if ($project->preview){
            Storage::delete($project->preview);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('message', "l'elemento $project->project_title è stato eliminato con successo");

    }
}
