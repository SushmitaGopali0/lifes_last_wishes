@extends('admin.layout.master')

@section('body')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Groups</title>
    <style>
        /* styles.css */
body {
    font-family: Arial, sans-serif;
    background: #f8f9fa;
    padding: 20px;
}

.container {
    width: 80%;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
    margin-left: 40px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.add-btn {
    background: #28a745;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
}

.table-controls {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

input[type="text"] {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

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

.btn {
    padding: 5px 8px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 5px;
    color: white;
}

.customize { background: #28a745; }
.edit { background: #17a2b8; }
.delete { background: #dc3545; }
.preview { background: #007bff; }
.conditions { background: #ffc107; }

    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2><i class="icon"></i> Form Groups</h2>
            <button class="add-btn">+ Add New</button>
        </div>

        <div class="table-controls">
            <label>Show 
                <select>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select> entries
            </label>
            <input type="text" placeholder="Search...">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Shortcode</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>DK</td>
                    <td>[formgrouprender id="36"]</td>
                    <td class="status">Published</td>
                    <td>
                        <button class="btn customize">Customize</button>
                        <button class="btn edit">Edit</button>
                        <button class="btn delete">Delete</button>
                        <button class="btn preview">Preview</button>
                        <button class="btn conditions">Conditions</button>
                    </td>
                </tr>
                <tr>
                    <td>Other Last Wishes</td>
                    <td>[formgrouprender id="35"]</td>
                    <td class="status">Published</td>
                    <td>
                        <button class="btn customize">Customize</button>
                        <button class="btn edit">Edit</button>
                        <button class="btn delete">Delete</button>
                        <button class="btn preview">Preview</button>
                        <button class="btn conditions">Conditions</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
@endsection