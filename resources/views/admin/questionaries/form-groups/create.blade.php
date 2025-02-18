@extends('admin.layout.master')

@section('body')
<div class="form-wrapper">
    <div class="form-header">
        Add Form Group
    </div>
    <form action="{{ route('formgroups.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-input" placeholder="Name">

        <label for="status">Status</label>
       
        <select id="status" name="status" class="form-select">
            <option value="DRAFT">Draft</option>
            <option value="PUBLISHED">Published</option>
        </select>

        <button type="submit" class="btn-submit">Save</button>
    </form>
</div>

<style>
    .form-wrapper {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 550px;
        margin-top: 40px;
        margin-bottom: 90px;
        margin-left: 60px;
    }
    .form-header {
        display: flex;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }
    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }
    .form-input, .form-select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .btn-submit {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 15px;
    }
    .btn-submit:hover {
        background-color: #0056b3;
    }
</style>
@endsection
