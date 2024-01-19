@extends('layouts.app')


@section('content')
    <main>
        <div class="container">
            <div class="d-flex justify-content-between  align-items-center ">
                <h1 class="py-4">
                    Progetti:
                </h1>
                {{-- bottone della create --}}
                <div class="d-flex align-items-center">
                    <h4>
                        Non trovi il tuo Progetto ?
                    </h4>
                    <a href="{{route('admin.projects.create')}}">
                        <button class="btn btn-primary rounded-3 mx-4 ">
                            Aggiungilo!
                        </button>
                    </a>
                </div>
            </div>

            <div class="card p-4 ">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Titolo del Progetto</th>
                        <th scope="col">Nome della Repository</th>
                        <th scope="col">Link alla Repository</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($projects as $project)
                      <tr>
                        <td>
                            {{$project->project_title}}
                        </td>
                        <td>{{$project->repo_name}}</td>
                        <td>{{$project->repo_link}}</td>
                        <td>
                            <a href="{{route('admin.projects.edit', $project->id)}}">
                                <button class="btn btn-success rounded-3 border-0">
                                    <i class="fa-solid fa-pen" style="font-size: 0.7rem"></i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="{{route('admin.projects.show', $project->id)}}">
                                <button class="btn btn-primary rounded-3 border-0 me-2">
                                    <i class="fa-regular fa-file-lines" style="font-size: 1rem"></i>
                                </button>
                            </a>
                        </td>
                      </tr>
                      @empty
                      <div>Nessun Progetto Disponibile</div>
                    @endforelse
                    </tbody>
                </table>
                {{-- ...lavoriamo sulla paginazione --}}
                {{-- dopo aver dato il comando di paginate alla query di project index --}}
                {{-- dopo aver creto la cartella vendor pagination  --}}
                {{-- posso linkarla attraverso la stessa dicitura che si usa per le route pages --}}
                {{-- aprendo il file vendor.pagination.bootstrap-5 è possibile customizzare la grafica del file --}}
                {{$projects->links('vendor.pagination.bootstrap-5')}}
            </div>
        </div>
    </main>
@endsection
