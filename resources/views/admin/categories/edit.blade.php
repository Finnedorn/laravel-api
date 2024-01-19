@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="card my-3 p-4">
                <h2 class="pb-3">
                    {{ $category->name }}
                </h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- form di edit  --}}
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- titolo del progetto --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Categoria</label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name"
                            value="@error('name') {{ old('name') }} @else{{ $category->name }}@enderror"
                            required>
                        @error('project_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>





                    {{-- bottoni --}}
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Conferma</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#delete_button">
                        Elimina
                    </button>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="delete_button" tabindex="-1" aria-labelledby="delete_button_label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete_button_label">Conferma</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Cliccando su conferma eliminerai {{$category->name}}. Sei sicuro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Torna Indietro</button>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Conferma</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>
@endsection
