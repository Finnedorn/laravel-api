@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="card my-2  p-4">
                <h2 class="pb-3">
                    Inserisci un nuovo Progetto:
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
                {{-- aggiungo il metodo enctype="multipart/form-data" così da poter uploadare il file img in preview --}}
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- titolo del progetto --}}
                    <div class="mb-3">
                        <label for="project_title" class="form-label">Titolo del Progetto</label>
                        <input type="text"
                            class="form-control @error('project_title') is-invalid @enderror"
                            id="project_title" name="project_title"
                            value="{{old('project_title')}}"
                            required>
                        @error('project_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- categoria --}}
                    <label for="category_id" class="form-label">Categoria</label>
                    <select
                        class="form-control @error('category_id') is-invalid @enderror"
                        id="category" name="category_id" required>
                        <option value="">Seleziona la Categoria</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"
                        {{old('category_id') == $category->id ? 'selected': ''}}>
                        {{$category->name}}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    {{-- tecnologia --}}
                    <div class="mb-3">
                        <div class="form-group">
                            <h6>Seleziona la Tecnologia utilizzata:</h6>
                            @foreach ($technologies as $technology)
                                <div class="form-check @error('technologies') is-invalid @enderror">
                                    <input type="checkbox" class="form-check-input" name="technologies[]" value="{{$technology->id}}"
                                    {{in_array($technology->id,old('technologies',[])) ? 'checked' : '' }}>
                                    <label for="technologies[]" class="form-check-label">
                                    {{$technology->name}}
                                    </label>
                                </div>
                            @endforeach
                            @error('technologies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    {{-- nome della repo --}}
                    <div class="mb-3">
                        <label for="repo_name" class="form-label">Nome della Repository</label>
                        <input type="text"
                            class="form-control @error('repo_name') is-invalid @enderror"
                            id="repo_name" name="repo_name"
                            value="{{old('repo_name')}}"
                            required>
                        @error('repo_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- link alla repo --}}
                    <div class="mb-3">
                        <label for="repo_link" class="form-label">Link alla Repository</label>
                        <input type="text"
                            class="form-control @error('repo_link') is-invalid @enderror"
                            id="repo_link" name="repo_link"
                            value="{{old('repo_link')}}"
                            required>
                        @error('repo_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label" rows="10">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        value="{{old('description')}}">
                        </textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- preview --}}
                    <div class="mt-3">
                        <label for="preview" class="form-label">Preview</label>
                        <div class="d-flex mb-4">
                            <div class="me-3 img-preview-box">
                                <img id="uploaded" src="https://via.placeholder.com/200x110" width="100">
                            </div>
                            <div class="mb-3">
                                <input class="form-control " name="preview" type="file" id="preview" value="{{ old('preview') }}">
                                @error('preview')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- bottoni --}}
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#delete_button">
                        Delete
                    </button> --}}
                </form>
            </div>
        </div>
    </main>
@endsection
