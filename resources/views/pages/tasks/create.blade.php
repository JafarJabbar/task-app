@extends('layouts.app')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
            bis_skin_checked="1">
            <h1 class="h2">Project add</h1>
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
        <form action="{{route('tasks.store')}}" method="Post">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title"
                       value="{{old('title')}}"
                       class="form-control"
                       id="exampleFormControlInput1"
                       placeholder="Title">
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif

            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <input type="text" name="priority"
                       value="{{old('priority')}}"
                       class="form-control"
                       id="priority"
                       placeholder="priority">
                @if ($errors->has('priority'))
                    <span class="text-danger">{{ $errors->first('priority') }}</span>
                @endif

            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select name="project_id" class="form-select" aria-label="Select Project">
                    @foreach($projects as $project)
                        <option value="{{$project->id}}">{{$project->title}}</option>
                    @endforeach
                </select>
                @if ($errors->has('project_id'))
                    <span class="text-danger">{{ $errors->first('project_id') }}</span>
                @endif

            </div>

            <div class="btn-toolbar mb-2 mb-md-0" bis_skin_checked="1">
                <div class="btn-group me-2" bis_skin_checked="1">
                    <button type="submit" class="btn btn-sm btn-outline-primary">
                        Save
                    </button>
                </div>
            </div>

        </form>
    </main>

@endsection
