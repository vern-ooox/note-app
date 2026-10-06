@extends('layouts.app')

@section('content')
    <h1>Edit Note</h1>

    <form method="POST" action="/notes/{{ $note->id }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $note->title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="4">{{ old('content', $note->content) }}</textarea>
        </div>

        @include('notes._checklist')

        <button type="submit" class="btn btn-primary">Update Note</button>
    </form>
@endsection