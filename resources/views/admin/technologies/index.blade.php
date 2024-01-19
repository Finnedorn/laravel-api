@extends('layouts.app')


@section('content')
    <main>
        <div class="container">
            <div class="d-flex justify-content-between  align-items-center ">
                <h1 class="py-4">
                    Tecnologie:
                </h1>
                {{-- bottone della create --}}
                <div class="d-flex align-items-center">
                    <h4>
                        Non trovi la tua Tecnologia ?
                    </h4>
                    <a href="{{route('admin.technologies.create')}}">
                        <button class="btn btn-primary rounded-3 mx-4 ">
                            Aggiungila!
                        </button>
                    </a>
                </div>
            </div>

            <div class="card p-4">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Nome</th>
                        @if (Auth::id() == 1)
                            <th scope="col"></th>
                            <th scope="col"></th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($technologies as $technology)
                      <tr>
                        <td>
                            {{$technology->name}}
                        </td>
                        @if (Auth::id() == 1)
                            <td>
                                <a href="{{route('admin.technologies.edit', $technology->id)}}">
                                    <button class="btn btn-success rounded-3 border-0">
                                        <i class="fa-solid fa-pen" style="font-size: 0.7rem"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('admin.technologies.show', $technology->id)}}">
                                    <button class="btn btn-primary rounded-3 border-0 me-2">
                                        <i class="fa-regular fa-file-lines" style="font-size: 1rem"></i>
                                    </button>
                                </a>
                            </td>
                        @endif
                      </tr>
                      @empty
                      <div>Nessuna Tecnologia Disponibile</div>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
