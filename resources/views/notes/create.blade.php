@extends('layouts.app')

@section('content')
    <h1>Add Note</h1>

    <form method="POST" action="/notes">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control">
        </div>  

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Note</button>
    </form>
@endsection