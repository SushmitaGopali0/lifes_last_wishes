@extends('admin.layout.master')
@section('body')
    <div class="card-body dashboard-tabs">
        <ul class="nav nav-tabs px-4" role="tablist">
            @foreach ($groups as $index => $group)
                <li class="nav-item">
                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" id="tab-{{ Str::slug($group) }}-tab"
                        data-bs-toggle="tab" href="#tab-{{ Str::slug($group) }}" role="tab"
                        aria-controls="tab-{{ Str::slug($group) }}"
                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">{{ ucfirst($group) }}</a>
                </li>
            @endforeach
        </ul><br>
        <div style="margin-left: 40px;">
            <div class="row">
                <div class="tab-content">
                    @foreach ($groupedSettings as $group => $group_settings)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ Str::slug($group) }}"
                            role="tabpanel">
                            <form action="{{ route('admin.page-setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="settings-group">
                                    @foreach ($group_settings as $setting)
                                        <div class="form-group">
                                            <div class="d-flex align-items-center mb-2">
                                                <h4 class="me-2">{{ ucfirst(str_replace('_', ' ', $setting->name)) }}</h4>
                                                <code
                                                    class="badge bg-light text-danger">setting('{{ $setting->group . '.' . $setting->key }}')</code>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    @if ($setting->type == 'text')
                                                        <input type="text" class="form-control"
                                                            name="settings[{{ $setting->id }}][value]"
                                                            value="{{ $setting->value }}" />
                                                    @elseif($setting->type == 'text_area')
                                                        <textarea class="form-control" name="settings[{{ $setting->id }}][value]" rows="4">{{ $setting->value }}</textarea>
                                                    @elseif($setting->type == 'ck_editor')
                                                        <textarea class="ckeditor" id="editor-{{ $setting->id }}" name="settings[{{ $setting->id }}][value]">{{ $setting->value }}</textarea>
                                                    @elseif($setting->type == 'checkbox')
                                                        <input type="hidden" name="settings[{{ $setting->id }}][value]"
                                                            value="0">
                                                        <input type="checkbox" name="settings[{{ $setting->id }}][value]"
                                                            value="1" {{ $setting->value == '1' ? 'checked' : '' }} />
                                                    @elseif($setting->type == 'radio_btn')
                                                        <input type="radio" name="settings[{{ $setting->id }}][value]"
                                                            value="1" {{ $setting->value == '1' ? 'checked' : '' }}>
                                                        Option 1
                                                        <input type="radio" name="settings[{{ $setting->id }}][value]"
                                                            value="2" {{ $setting->value == '2' ? 'checked' : '' }}>
                                                        Option 2
                                                    @elseif($setting->type == 'select_dropdown')
                                                        <select class="form-select"
                                                            name="settings[{{ $setting->id }}][value]">
                                                            <option value="1"
                                                                {{ $setting->value == '1' ? 'selected' : '' }}>Option 1
                                                            </option>
                                                            <option value="2"
                                                                {{ $setting->value == '2' ? 'selected' : '' }}>Option 2
                                                            </option>
                                                        </select>
                                                    @elseif($setting->type == 'file')
                                                        <input type="file" class="form-control"
                                                            name="settings[{{ $setting->id }}][value]" /><br>
                                                        {{-- Display Current File --}}
                                                        @if ($setting->value && !in_array(pathinfo($setting->value, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                                            <p>Current file:
                                                                <a href="{{ asset('uploads/' . $setting->value) }}"
                                                                    target="_blank">
                                                                    {{ pathinfo($setting->value, PATHINFO_BASENAME) }}
                                                                </a>
                                                            </p>
                                                        @endif
                                                    @elseif($setting->type == 'image')
                                                        <input type="file" class="form-control"
                                                            name="settings[{{ $setting->id }}][value]"
                                                            accept="image/*" /><br>
                                                        {{-- Display Current Image --}}
                                                        @if ($setting->value && in_array(pathinfo($setting->value, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                                            <img src="{{ asset('uploads/' . $setting->value) }}"
                                                                alt="Uploaded Image" width="500">
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="col-sm-2">
                                                    <select class="form-select"
                                                        name="settings[{{ $setting->id }}][group]">
                                                        @foreach ($groups as $groupOption)
                                                            <option value="{{ $groupOption }}"
                                                                {{ $setting->group === $groupOption ? 'selected' : '' }}>
                                                                {{ ucfirst($groupOption) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-danger delete-setting"
                                                        style="background: none; border: none; padding: 0;"
                                                        data-setting-id="{{ $setting->id }}">
                                                        <i class="mdi mdi-delete" style="font-size: 25px; color:red"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
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
                                    placeholder="Name for the setting" name="name" value="{{ old('name') }}" required>
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
                                    <option value="ck_editor" {{ old('type') == 'ck_editor' ? 'selected' : '' }}>
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
                CKEDITOR.replace(editor.id);
            });
        });
    </script>
    <script>
        // Delete setting
        document.querySelectorAll('.delete-setting').forEach(button => {
            button.addEventListener('click', function() {
                let settingId = this.getAttribute('data-setting-id');
                let url = '{{ route('admin.setting.destroy', ':id') }}';
                url = url.replace(':id', settingId);

                if (confirm("Are you sure you want to delete this setting?")) {
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success("Setting deleted successfully.");
                                location.reload(); // Refresh the page
                            } else {
                                alert("Failed to delete the setting.");
                            }
                        });
                }
            });
        });
    </script>
@endpush

