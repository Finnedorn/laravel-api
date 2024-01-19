@extends('layouts.app')

@section('content')
    <main>
        <div id="character-detail" class="container py-5">
            <div class="row pt-5">
                <div class="container">
                    <div>
                        <div class="d-flex justify-content-between  align-items-center w-75">
                            <h1 class="pb-3">
                                {{ $technology->name }}
                            </h1>
                        </div>
                        <ul>
                            @forelse ($technology->projects as $project)
                                <li>
                                    {{$project->project_title}}
                                </li>
                            @empty
                                <li>
                                    Non ci sono elementi per questa categoria
                                </li>
                            @endforelse
                        </ul>
                        <div class="pt-4">
                            <a href="{{route('admin.technologies.index')}}">
                                <i class="fa-solid fa-chevron-left text-primary" style="font-size: 2.5rem"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
