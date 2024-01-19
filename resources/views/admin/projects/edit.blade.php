@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="card my-3 p-4">
                <h2 class="pb-3">
                    {{ $project->project_title }}
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
                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- titolo del progetto --}}
                    <div class="mb-3">
                        <label for="project_title" class="form-label">Titolo del Progetto</label>
                        <input type="text"
                            class="form-control @error('project_title') is-invalid @enderror"
                            id="project_title" name="project_title"
                            value="@error('project_title') {{ old('project_title') }} @else{{ $project->project_title }}@enderror"
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
                            {{old('category_id',$project->category_id) === $category->id ? 'selected': ''}}>
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
                                    @if($errors->any())
                                    <input type="checkbox" class="form-check-input" name="technologies[]" value="{{$technology->id}}"
                                    {{in_array($technology->id,old('technologies',[])) ? 'checked' : '' }}>
                                    @else
                                    <input type="checkbox" class="form-check-input" name="technologies[]" value="{{$technology->id}}"
                                    {{$project->technologies->contains($technology->id) ? 'checked' : '' }}>
                                    @endif
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
                        <label for="repo_name" class="form-label">Nome della Repostory</label>
                        <input type="text"
                            class="form-control @error('repo_name') is-invalid @enderror"
                            id="repo_name" name="repo_name"
                            value="@error('repo_name') {{ old('repo_name') }} @else{{ $project->repo_name }}@enderror"
                            required>
                        @error('repo_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- link alla repo --}}
                    <div class="mb-3">
                        <label for="repo_link" class="form-label">Link alla Repostory</label>
                        <input type="text"
                            class="form-control @error('repo_link') is-invalid @enderror"
                            id="repo_link" name="repo_link"
                            value="@error('repo_link') {{ old('repo_link') }} @else{{ $project->repo_link }}@enderror"
                            required>
                        @error('repo_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label" rows="10">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">
                            @error('description')
                                {{ old('description') }}@else{{ $project->description }}
                            @enderror
                        </textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- preview --}}
                    <div class="mb-3">
                        <label for="preview" class="form-label">Preview</label>
                        <input class="form-control @error('preview') is-invalid @enderror" name="preview" type="file" id="preview" value="{{ old('preview') }}">
                        @error('preview')
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
                    Cliccando su conferma eliminerai {{$project->project_title}}. Sei sicuro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Torna Indietro</button>
                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
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
