@extends('layouts.app')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
            bis_skin_checked="1">
            <h1 class="h2">Projects list</h1>
            <div class="btn-toolbar mb-md-0">
                <div class="mx-2">
                    <form action="{{route('projects.index')}}">
                        <div class="d-flex">
                            <input type="search" name="keyword"
                                   class="form-control"
                                   id="exampleFormControlInput1"
                                   placeholder="Search">
                            <button type="submit"  class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-search"></i>
                            </button>
                            <a href="{{route('projects.index')}}"  class="btn btn-sm btn-outline-info">
                                <i class="bi bi-arrow-repeat"></i>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="btn-toolbar mb-2 mb-md-0" bis_skin_checked="1">
                    <div class="btn-group me-2" bis_skin_checked="1">
                        <a type="button" href="{{route('projects.create')}}" class="btn btn-sm btn-outline-primary">
                            + Add new
                        </a>
                    </div>

                </div>
            </div>

        </div>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    \Illuminate\Support\Facades\Session::forget('success');
                @endphp
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
                @php
                    \Illuminate\Support\Facades\Session::forget('success');
                @endphp
            </div>
        @endif

        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Task count</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($projects)>0)
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project->id}}</td>
                            <td>{{$project->title}}</td>
                            <td>{{$project->tasksCount}}</td>
                            <td>{{date('Y-m-d H:i:s',$project->crated_at)}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('projects.show',$project->id)}}" class="btn btn-outline-primary">
                                        <i class="bi bi-pen-fill"></i>
                                    </a>
                                    <form action="{{ route('projects.destroy', ['project' => $project->id ]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="project" value="{{ $project->id }}"/>
                                        <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-outline-primary">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>

                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                       <td  colspan="5" style="text-align: center">
                           <div class="alert alert-info" role="alert">
                               No data found
                           </div>
                       </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </main>
@endsection
