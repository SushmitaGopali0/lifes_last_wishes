@extends('admin.layout.master')
@section('body')
<div class="card-body dashboard-tabs">
    <ul class="nav nav-tabs px-4" role="tablist">
        @foreach ($groups as $index => $g)
            <li class="nav-item">
                <a class="nav-link {{ $index === 0 ? 'active' : '' }}" id="tab-{{ Str::slug($g) }}-tab" data-bs-toggle="tab" href="#tab-{{ Str::slug($g) }}" role="tab" aria-controls="tab-{{ Str::slug($g) }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">{{ $g }}</a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach ($groups as $index => $g)
            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="tab-{{ Str::slug($g) }}" role="tabpanel" aria-labelledby="tab-{{ Str::slug($g) }}-tab">
                <p>Content for {{ $g }} tab</p>
            </div>
        @endforeach
    </div>
</div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New Setting </h4>
                        <form class="forms-sample" method="POST" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail3">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Name for the setting" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Key</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Key for the setting" name="key" value="{{ old('key') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Type</label>
                                <select class="form-select" id="exampleFormControlSelect2" name="type" required>
                                    <option value="" class="form-control" selected disabled>Choose type</option>
                                    <option value="text" {{ old('type') == "text" ? 'selected' : '' }}>Text</option>
                                    <option value="text_area" {{ old('type') == "text_area" ? 'selected' : '' }}>Textarea</option>
                                    <option value="ck_eidtor" {{ old('type') == "ck_editor" ? 'selected' : '' }}>Ckeditor</option>
                                    <option value="checkbox" {{ old('type') == "checkbox" ? 'selected' : '' }}>Checkbox</option>
                                    <option value="radio_btn" {{ old('type') == "radio_btn" ? 'selected' : '' }}>Radio Button</option>
                                    <option value="select_dropdown" {{ old('type') == "select_dropdown" ? 'selected' : '' }}>Select Dropdown</option>
                                    <option value="file" {{ old('type') == "file" ? 'selected' : '' }}>File</option>
                                    <option value="image" {{ old('type') == "image" ? 'selected' : '' }}>Image</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Group</label>
                                <div class="input-group">
                                    <div class="w-25">
                                    <select id="group" class="form-select" name="group">
                                        <option selected disabled>Select Group</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group }}" {{ old('group') == $group ? 'selected' : '' }}>{{ $group }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <input type="text" class="form-control" name="new_group" aria-label="Text input with dropdown button"
                                        placeholder="or add new group" value="{{ old('new_group') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

