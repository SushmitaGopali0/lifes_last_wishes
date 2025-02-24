@extends('admin.layout.master')
@section('body')
    <div class="card-body dashboard-tabs">
        <ul class="nav nav-tabs px-4" role="tablist">
            @foreach ($groups as $index => $g)
                <li class="nav-item">
                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" id="tab-{{ Str::slug($g) }}-tab"
                        data-bs-toggle="tab" href="#tab-{{ Str::slug($g) }}" role="tab"
                        aria-controls="tab-{{ Str::slug($g) }}"
                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">{{ $g }}</a>
                </li>
            @endforeach
        </ul>
<div class="row">
        <div class="tab-content">
            @foreach ($settings as $group => $group_settings)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ Str::slug($group) }}"
                    role="tabpanel">
                    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @foreach ($group_settings as $setting)
                            <div class="form-group">
                                <label>{{ ucfirst($setting->name) }}</label>
                                <div class="col-9 grid-margin stretch-card">
                                    @if ($setting->type == 'text')
                                        <input type="text" class="form-control" name="{{ $setting->key }}"
                                            value="{{ $setting->value }}">
                                    @elseif ($setting->type == 'text_area')
                                        <textarea class="form-control" name="{{ $setting->key }}">{{ $setting->value }}</textarea>
                                    @elseif ($setting->type == 'ck_editor')
                                        <textarea class="form-control ckeditor" id="editor" name="{{ $setting->key }}">{{ $setting->value }}</textarea>
                                    @elseif ($setting->type == 'file')
                                        <input type="file" name="{{ $setting->key }}" class="form-control">
                                        @if ($setting->value)
                                            <a href="{{ asset('storage/' . $setting->value) }}" target="_blank">View
                                                File</a>
                                        @endif
                                    @elseif ($setting->type == 'image')
                                        <input type="file" name="{{ $setting->key }}" class="form-control">
                                        @if ($setting->value)
                                            <img src="{{ asset('storage/' . $setting->value) }}" width="100">
                                        @endif
                                    @elseif ($setting->type == 'select_dropdown')
                                        @php $options = json_decode($setting->details, true)['options'] ?? []; @endphp
                                        <select class="form-control" name="{{ $setting->key }}">
                                            @foreach ($options as $key => $option)
                                                <option value="{{ $key }}"
                                                    {{ $setting->value == $key ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @elseif ($setting->type == 'checkbox')
                                        <input type="checkbox" name="{{ $setting->key }}" value="1"
                                            {{ $setting->value == 1 ? 'checked' : '' }}>
                                    @elseif ($setting->type == 'radio_btn')
                                        @php $options = json_decode($setting->details, true)['options'] ?? []; @endphp
                                        @foreach ($options as $key => $option)
                                            <input type="radio" name="{{ $setting->key }}" value="{{ $key }}"
                                                {{ $setting->value == $key ? 'checked' : '' }}>
                                            {{ $option }}
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-3 grid-margin stretch-card">
                                    <div class="w-25 me-3">
                                        <select id="group" class="form-select" name="group">
                                            <option selected disabled>Select Group</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group }}"
                                                    {{ old('group', $setting->group) == $group ? 'selected' : '' }}>
                                                    {{ $group }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.setting.destroy', $setting->id) }}" method="POST"
                                        class="ms-3">
                                        @csrf
                                        {{-- @method('DELETE') --}}
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this setting?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Save Settings</button>
            </form>
        </div>
</div>
<br>

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
                                        placeholder="Name for the setting" name="name" value="{{ old('name') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Key</label>
                                    <input type="text" class="form-control" id="exampleInputEmail3"
                                        placeholder="Key for the setting" name="key" value="{{ old('key') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Type</label>
                                    <select class="form-select" id="exampleFormControlSelect2" name="type" required>
                                        <option value="" class="form-control" selected disabled>Choose type</option>
                                        <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                                        <option value="text_area" {{ old('type') == 'text_area' ? 'selected' : '' }}>
                                            Textarea
                                        </option>
                                        <option value="ck_eidtor" {{ old('type') == 'ck_editor' ? 'selected' : '' }}>
                                            Ckeditor
                                        </option>
                                        <option value="checkbox" {{ old('type') == 'checkbox' ? 'selected' : '' }}>Checkbox
                                        </option>
                                        <option value="radio_btn" {{ old('type') == 'radio_btn' ? 'selected' : '' }}>Radio
                                            Button</option>
                                        <option value="select_dropdown"
                                            {{ old('type') == 'select_dropdown' ? 'selected' : '' }}>Select Dropdown
                                        </option>
                                        <option value="file" {{ old('type') == 'file' ? 'selected' : '' }}>File</option>
                                        <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Group</label>
                                    <div class="input-group">
                                        <div class="w-25">
                                            <select id="group" class="form-select" name="group">
                                                <option selected disabled>Select Group</option>
                                                @foreach ($groups as $group)
                                                    <option value="{{ $group }}"
                                                        {{ old('group') == $group ? 'selected' : '' }}>{{ $group }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="text" class="form-control" name="new_group"
                                            aria-label="Text input with dropdown button" placeholder="or add new group"
                                            value="{{ old('new_group') }}">
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
    @push('js')
        <!-- CKEditor CDN -->
        {{-- 4.22.1 version --}}
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <!-- Custom js for this page-->
        <script>
            CKEDITOR.replace('editor', {
                height: 500
            });
        </script>
        <!-- End custom js for this page-->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.ckeditor').forEach(editor => {
                    CKEDITOR.replace(editor.name);
                });
            });
            </script>
    @endpush
