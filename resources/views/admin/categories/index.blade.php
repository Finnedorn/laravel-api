@extends('layouts.app')


@section('content')
    <main>
        <div class="container">
            <div class="d-flex justify-content-between  align-items-center ">
                <h1 class="py-4">
                    Categorie:
                </h1>
                {{-- bottone della create --}}
                <div class="d-flex align-items-center">
                    <h4>
                        Non trovi la tua categoria ?
                    </h4>
                    <a href="{{route('admin.categories.create')}}">
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
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @forelse ($categories as $category)
                      <tr>
                        <td>
                            {{$category->name}}
                        </td>
                        <td>
                            <a href="{{route('admin.categories.edit', $category->id)}}">
                                <button class="btn btn-success rounded-3 border-0">
                                    <i class="fa-solid fa-pen" style="font-size: 0.7rem"></i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="{{route('admin.categories.show', $category->id)}}">
                                <button class="btn btn-primary rounded-3 border-0 me-2">
                                    <i class="fa-regular fa-file-lines" style="font-size: 1rem"></i>
                                </button>
                            </a>
                        </td>
                      </tr>
                      @empty
                      <div>Nessuna Categoria Disponibile</div>
                    @endforelse
                    </tbody>
                </table>
        </div>
    </main>
@endsection
