@extends('admin.layout.master')

@section('body')
<div class="container mt-4">
    <div class="card">

        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        <div class="card-header d-flex align-items-center">
            <i class="fas fa-file-alt me-2"></i>
            <h4 class="mb-0">Add Elements to Form Group ({{ $formGroup->name }})</h4>
        </div>
        <div class="card-body">
            <button class="btn btn-success mb-3" id="openModal">
                <i class="fas fa-plus"></i> New Element
            </button>

            <ul id="sortable" class="list-group">
                @foreach($formGroup->elements as $element)
                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $element->id }}">
                    <span>{{ $element->label }}</span>
                    <div>
                        <button class="btn btn-primary btn-sm btn-edit" data-id="{{ $element->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $element->id }}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Modal for Adding Elements -->
<div id="elementModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Element</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="elementForm" method="POST" action="{{ route('formelements.store') }}">
                    @csrf
                    <input type="hidden" name="form_group_id" value="{{ $formGroup->id }}">

                    <div class="mb-3">
                        <label for="type" class="form-label">Element Type:</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="TEXT">Text</option>
                            <option value="TEXTAREA">Textarea</option>
                            <option value="RADIO">Radio</option>
                            <option value="CHECKBOX">Checkbox</option>
                            <option value="DROPDOWN">Dropdown</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="label" class="form-label">Element Label:</label>
                        <input type="text" name="label" id="label" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="pdf_label" class="form-label">PDF Label:</label>
                        <input type="text" name="pdf_label" id="pdf_label" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="prefilled_text" class="form-label">Pre-filled Text:</label>
                        <input type="text" name="prefilled_text" id="prefilled_text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="show_in_pdf" class="form-label">Show in PDF:</label>
                        <select name="show_in_pdf" id="show_in_pdf" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.getElementById("openModal").addEventListener("click", function () {
        var myModal = new bootstrap.Modal(document.getElementById("elementModal"));
        myModal.show();
    });

</script>

@endsection
