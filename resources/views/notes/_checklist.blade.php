.@php
    $items = old('items', isset($note)
        ? $note->items->map(fn ($i) => ['text' => $i->text, 'done' => $i->is_done])->all()
        : []);
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label">Checklist</label>

    <div id="checklist">
        @foreach ($items as $i => $item)
            <div class="input-group mb-2">
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox"
                           name="items[{{ $i }}][done]" value="1" @checked(! empty($item['done']))>
                </div>
                <input type="text" name="items[{{ $i }}][text]" class="form-control" value="{{ $item['text'] ?? '' }}">
                <button type="button" class="btn btn-outline-danger remove-item">&times;</button>
            </div>
        @endforeach
    </div>

    <button type="button" class="btn btn-outline-secondary btn-sm" id="addItem">+ Add item</button>
</div>

<script>
    (function () {
        const list = document.getElementById('checklist');
        let next = Date.now();

        document.getElementById('addItem').addEventListener('click', function () {
            const i = next++;
            const row = document.createElement('div');
            row.className = 'input-group mb-2';
            row.innerHTML =
                '<div class="input-group-text"><input class="form-check-input mt-0" type="checkbox" name="items[' + i + '][done]" value="1"></div>' +
                '<input type="text" name="items[' + i + '][text]" class="form-control">' +
                '<button type="button" class="btn btn-outline-danger remove-item">&times;</button>';
            list.appendChild(row);
            row.querySelector('input[type=text]').focus();
        });

        list.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.input-group').remove();
            }
        });
    })();
</script>