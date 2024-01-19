@extends('layouts.app')

@section('content')
    <main>
        <div id="character-detail" class="container py-5">
            <div class="row pt-5">
                <div class="container">
                    <div>
                        @if (Auth::id() == $project->user_id || Auth::id() == 1)
                            <div class="d-flex justify-content-between  align-items-center w-75">
                                <h1 class="pb-3">
                                    {{ $category->name }}
                                </h1>
                            </div>
                            <ul>
                                @forelse ($category->projects as $project)
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
                                <a href="{{route('admin.categories.index')}}">
                                    <i class="fa-solid fa-chevron-left text-primary" style="font-size: 2.5rem"></i>
                                </a>
                            </div>
                        @else
                            <div>Non vi sono elementi legati a questa categoria per questo account</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
