@extends('admin.layout.master')
@push('css')
    <style>
        .image-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* border: 2px dashed #ccc; */
            padding: 10px;
            border-radius: 10px;
            width: 250px;
            height: 200px;
            text-align: center;
            position: relative;
            background-color: #f8f8f8;
        }

        .image-preview-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            display: none;
            /* Initially hide the image */
        }

        .image-preview-container span {
            color: #f8f8f8;
            font-size: 14px;
            font-weight: bold;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            white-space: nowrap;
        }
    </style>
@endpush
@section('body')
    <div class="col-md-6">
        <div class="card-body">
            <div class="template-demo">
                <a href="{{ route('admin.post.index') }}"><button type="button"
                        class="btn btn-light btn-rounded btn-fw">←Back</button></a>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Post Store form </h4>
                        <form class="forms-sample" method="POST" action="{{ route('admin.post.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail3">Title <small>(The title for your post)</small></label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Title"
                                    name="title" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Slug</label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Slug of post" name="slug" value="{{ old('slug') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Post Content</label>
                                <textarea class="ckeditor" id="editor" name="post_content">{{ old('post_content') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Excerpt <small>(Small decription for this post)</small></label>
                                <textarea class="form-control" id="exampleTextarea1" name="excerpt" placeholder="Excerpt">{{ old('excerpt') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="categories" class="form-check-label">Categories<br />
                                <input class="form-check-input" type="checkbox" name="categories[]" value="death"> Death<br />
                                <input class="form-check-input" type="checkbox" name="categories[]" value="fitness"> Fitness<br />
                                <input class="form-check-input" type="checkbox" name="categories[]" value="life"> Life<br />
                                <input class="form-check-input" type="checkbox" name="categories[]" value="relationship"> Relationship<br />
                                <input class="form-check-input" type="checkbox" name="categories[]" value="work"> Work<br />
                                <i class="input-helper"></i></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Tags</label>
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Tags"
                                    name="tags" value="{{ old('tags') }}">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div class="collections-create__sidebar--form mt-2">
                                    <div class="image-preview-container">
                                        <span id="image-text" class="preview-text">Upload Image</span>
                                        <img height="196px" width="240px"
                                            src="{{ isset($post) && $post->image ? asset('storage/' . $post->image) : 'https://via.placeholder.com/240x196?text=No+Image' }}"
                                            alt="Display Image Here" id="image-preview">
                                    </div>
                                    <br><br>
                                    <input type="file" name="image" class="file-upload-default" id="myfile"
                                        onchange="previewImage(event)">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary"
                                                type="button">Upload</button>
                                        </span>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Meta Description <small>(For SEO Content)</small> </label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Meta Description" name="meta_description"
                                    value="{{ old('meta_description') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Meta Keywords <small>(For SEO Content)</small></label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="Meta Keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">SEO Title <small>(For SEO Content)</small></label>
                                <input type="text" class="form-control" id="exampleInputEmail3"
                                    placeholder="SEO Content" name="seo_title" value="{{ old('seo_title') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Status</label>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div class="form-check form-check-danger">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios2" value="draft" checked=""
                                                {{ old('status') == 'draft' ? 'checked' : '' }}>
                                            Draft
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check form-check-success">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios1" value="published"
                                                {{ old('status') == 'published' ? 'checked' : '' }}>
                                            Published
                                            <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check form-check-warning">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="optionsRadios1" value="pending"
                                                {{ old('status') == 'pending' ? 'checked' : '' }}>
                                            Pending
                                            <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check form-check-success">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    Featured
                                    <i class="input-helper"></i></label>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Create</button>
                            <button type="reset" class="btn btn-light">Reset</button>
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
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var imgElement = document.getElementById('image-preview');
                var textElement = document.getElementById('image-text'); // Get text element
                imgElement.src = reader.result;
                imgElement.style.display = 'block'; // Show image
                textElement.style.display = 'none'; // Hide text when image is loaded
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endpush
