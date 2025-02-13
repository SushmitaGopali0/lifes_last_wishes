@extends('admin.layout.master')

@section('body')
<div class="container">
    <h2>Edit Role</h2>

    <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ $role->name }}" required>
        </div>

        <div>
            <label>Display Name</label>
            <input type="text" name="display_name" value="{{ $role->display_name }}" required>
        </div>

        <div>
            <label>Permissions</label>
            <br>
            <a href="#" onclick="toggleCheckboxes(true)">Select All</a> /
            <a href="#" onclick="toggleCheckboxes(false)">Deselect All</a>

            @foreach ($permissions as $permission)
                <div style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="permissions[]" id="checkbox-{{ $permission->id }}"
                        value="{{ $permission->id }}" 
                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                    <label for="checkbox-{{ $permission->id }}">{{ $permission->key }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit">Update Role</button>
    </form>
</div>

<script>
    function toggleCheckboxes(selectAll) {
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = selectAll;
        });
    }
</script>

@endsection
