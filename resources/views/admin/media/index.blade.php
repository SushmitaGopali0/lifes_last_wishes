@extends('admin.layout.master')
@section('body')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="template-demo">
                                <button type="button" class="btn btn-success btn-icon-text" id="uploadBtn">
                                    <i class="mdi mdi-upload btn-icon-prepend"></i>
                                    Upload
                                </button>
                                <button type="button" class="btn btn-primary btn-icon-text" id="addFolderBtn">
                                    <i class="mdi mdi-folder btn-icon-prepend"></i>
                                    Add Folder
                                </button>
                            </div>
                            <div class="template-demo ms-auto">
                                <button type="button" class="btn btn-inverse-dark btn-icon-text" id="moveBtn">
                                    <i class="mdi mdi-cursor-move btn-icon-prepend"></i>
                                    Move
                                </button>
                                <button type="button" class="btn btn-inverse-dark btn-icon-text" id="renameBtn">
                                    <i class="mdi mdi-rename-box btn-icon-prepend"></i>
                                    Rename
                                </button>
                                <button type="button" class="btn btn-inverse-danger btn-icon-text" id="deleteBtn">
                                    <i class="mdi mdi-delete btn-icon-prepend"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("uploadBtn").addEventListener("click", function () {
            alert("Upload button clicked!");
            // Add your file upload logic here
        });

        document.getElementById("addFolderBtn").addEventListener("click", function () {
            let folderName = prompt("Enter folder name:");
            if (folderName) {
                alert("Folder '" + folderName + "' created!");
                // Add folder creation logic here
            }
        });

        document.getElementById("moveBtn").addEventListener("click", function () {
            alert("Move button clicked!");
            // Add move functionality here
        });

        document.getElementById("renameBtn").addEventListener("click", function () {
            let newName = prompt("Enter new name:");
            if (newName) {
                alert("Renamed to: " + newName);
                // Add rename functionality here
            }
        });

        document.getElementById("deleteBtn").addEventListener("click", function () {
            if (confirm("Are you sure you want to delete this?")) {
                alert("Deleted successfully!");
                // Add delete functionality here
            }
        });
    </script>
@endsection
