@extends('admin.layout.master')

@section('body')
<div class="container">
    <div class="header">
        <h2><i class="icon"></i> Form Groups</h2>
        <a href="{{ route('formgroups.create') }}" class="btn btn-primary">+ Add New</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Shortcode</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formGroups as $formGroup)
            <tr>
                <td>{{ $formGroup->name }}</td>
                <td>[formgrouprender id="{{ $formGroup->id }}"]</td>
                <td class="status">{{ $formGroup->status }}</td>
                <td>
                    <a href="{{ route('formgroups.edit', $formGroup->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('formgroups.destroy', $formGroup->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href = "{{ route('formgroups.preview', $formGroup->id) }}" class="btn btn-info">Preview</button>
                    <a href="{{ route('formgroups.customize', $formGroup->id) }}" class="btn btn-customize">Customize</a>
                    <a href="{{ route('formgroups.condition', $formGroup->id) }}" class="btn btn-secondary">Conditions</button>   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>

    .container {
        width: 80%;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .btn {
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        color: white;
    }
    .btn-customize {
    background: #28a745; 
    margin-top: 15px;
    color: white;
}

    .btn-primary { background: #007bff; }
    .btn-warning { background: #ffc107; margin-top: 14px }
    .btn-danger { background: #dc3545; }
    .btn-info { background: #17a2b8; margin-top: 14px; margin-right: 4px;}
    .btn-secondary { background: #6c757d; margin-top: 14px;}
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    th {
        background: #f1f1f1;
    }
    .status {
        color: #007bff;
    }
</style>
@endsection
