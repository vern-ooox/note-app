@extends('layouts.app')

@section('content')
    <h1>My Notes</h1>

    @forelse ($notes as $note)
        <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-start">
            <div class="d-flex align-items-start">
                <input class="form-check-input note-toggle me-3 mt-2" type="checkbox"
                       style="width: 1.5em; height: 1.5em;"
                       data-url="/notes/{{ $note->id }}/toggle" @checked($note->is_done)>

                <div class="{{ $note->is_done ? 'text-decoration-line-through text-muted' : '' }}">
                    <h5>{{ $note->title }}</h5>
                    <p>{{ $note->content }}</p>
                </div>
            </div>

            <div>
                <a href="/notes/{{ $note->id }}/edit" class="btn btn-primary btn-sm">Edit</a>

                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $note->id }}">
                    Delete
                </button>
            </div>

            <div class="modal fade" id="deleteModal{{ $note->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete "{{ $note->title }}"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form method="POST" action="/notes/{{ $note->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No notes yet.</p>
    @endforelse

    <script>
        document.querySelectorAll('.note-toggle').forEach(function (box) {
            const text = box.nextElementSibling;

            function paint() {
                text.classList.toggle('text-decoration-line-through', box.checked);
                text.classList.toggle('text-muted', box.checked);
            }

            box.addEventListener('change', async function () {
                paint();

                try {
                    const res = await fetch(box.dataset.url, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ is_done: box.checked })
                    });
                    if (!res.ok) throw new Error('Request failed');
                } catch (e) {
                    box.checked = !box.checked;
                    paint();
                    alert('Could not save that change. Please try again.');
                }
            });
        });
    </script>
@endsection