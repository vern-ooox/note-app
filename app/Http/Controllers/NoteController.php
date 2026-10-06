<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\CheckList;

class NoteController extends Controller
{
        public function index ()
    {
        $notes = Note::all();
        return view('notes.index', ['notes' => $notes]);
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        Note::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/notes');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect('/notes');
    }

    public function edit(Note $note)
    {
        return view('notes.edit', ['note' => $note]);
    }

    public function update(Request $request, Note $note)
    {
        $note->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/notes');
    }

    public function toggle(Request $request, Note $note)
{
    $note->update(['is_done' => $request->boolean('is_done')]);

    return response()->json(['is_done' => $note->is_done]);
}


}

