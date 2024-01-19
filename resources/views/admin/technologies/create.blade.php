@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="card my-2  p-4">
                <h2 class="pb-3">
                    Inserisci un nuova Tecnologia:
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
                <form action="{{ route('admin.technologies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome tecnologia:</label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name"
                            value="{{old('name')}}"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bottoni --}}
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>
@endsection
