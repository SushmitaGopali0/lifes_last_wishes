@extends('admin.layout.master')
@push('css')
<style>
.form-check-input:disabled {
    opacity: 1 !important; /*Restore full opacity*/
    filter: none !important; /* Remove any default grayscale effect */
    cursor: not-allowed; /* Keep the disabled cursor */
}

</style>
@endpush
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.page.index') }}"><button type="button"
                        class="btn btn-light btn-rounded btn-fw">←Back</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Page View Page </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.page.update', $page)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail3">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Title of page" name="title" value="{{ old('title', $page->title) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Slug</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Slug of page" name="slug" value="{{ old('slug', $page->slug) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pageCategory">Page Category</label>
                                <select class="form-select" name="page_category" id="pageCategory" disabled>
                                    <option class="form-control" selected disabled>Select Page Category</option>
                                    @foreach ($pageCategory as $pc)
                                        <option value="{{ $pc->id }}"
                                            {{ old('page_category', $page->page_category_id) == $pc->id ? 'selected' : '' }}>{{ $pc->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Excerpt</label>
                                <textarea class="form-control" id="exampleTextarea1" name="excerpt" placeholder="Excerpt" readonly>{{ old('excerpt', $page->excerpt) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Body</label>
                                <textarea class="ckeditor" id="editor" name="body" readonly>{{ old('body', $page->body) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div class="collections-create__sidebar--form mt-2">
                                    <img height="196px" width="240px" src="{{ asset('storage/' . $page->image) }}" alt="Display Image Here" id="image-preview">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Meta Description</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Meta Description" name="meta_description"
                                    value="{{ old('meta_description', $page->meta_description) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Meta Keywords</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Meta Keywords" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Status</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" id="optionsRadios2"
                                            value="active" checked="" {{ old('status', $page->status) == 'active' ? 'checked' : '' }} disabled>
                                        Active
                                        <i class="input-helper"></i></label>
                                </div>
                                <div class="form-check form-check-danger">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status"
                                            id="optionsRadios1" value="inactive"
                                            {{ old('status', $page->status) == 'inactive' ? 'checked' : '' }} disabled>
                                        Inactive
                                        <i class="input-helper"></i></label>
                                </div>
                                </div>
                            </div>
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
    <!-- Custom js for this page-->
    <script src="{{ asset('file-upload.js') }}"></script>
    <!-- End custom js for this page-->

    <script>
        // Function to preview selected image
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var imgElement = document.getElementById('image-preview');
                imgElement.src = reader.result;
                imgElement.style.display = 'block'; // Show the image element
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endpush
