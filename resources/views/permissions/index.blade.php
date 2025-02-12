<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #5da1e7;
            color: white;
            padding: 10px;
            font-size: 20px;
            border-radius: 8px 8px 0 0;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .permissions {
            margin-top: 10px;
        }

        .select-all {
            color: #1a73e8;
            cursor: pointer;
            font-size: 14px;
            margin-left: 5px;
        }

        .checkbox-group {
            margin-left: 20px;
        }

        .checkbox-group label {
            font-weight: normal;
        }

        .category {
            font-weight: bold;
            margin-top: 10px;
        }

        .checkbox-group input {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<form action="{{route('permissions.store')}}" method="post">
    @csrf
    <div class="container">
        <div class="header">Role Details</div>

        <label for="name">Name</label>
        <input type="text" id="name" name = "name" placeholder="Name">

        <label for="displayName">Display Name</label>
        <input type="text" id="displayName" name="display_name" placeholder="Display Name">

        <div class="permissions">
            <label>Permissions</label>
            <span class="select-all" onclick="toggleAll()">Select All / Deselect All</span>
            @foreach ($permissions as $permission)
            <div class="">
                <div>
                    <input type="checkbox" name="permissions[]" id="checkbox-{{ $permission->id }}"
                        value="{{ $permission->id }}">
                </div>
                <div>
                    <label for="checkbox-{{ $permission->id }}">{{ $permission->key }}</label>
                </div>
            </div>
        @endforeach
            <button type ="submit">Submit</button>
        </div>
    </div>
</form>
    <script>
        function toggleSubCheckboxes(mainCheckboxId, subCheckboxClass) {
            let mainCheckbox = document.getElementById(mainCheckboxId);
            let subCheckboxes = document.getElementsByClassName(subCheckboxClass);

            for (let checkbox of subCheckboxes) {
                checkbox.checked = mainCheckbox.checked;
            }
        }

        function toggleAll() {
            let allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
            let isChecked = allCheckboxes[0].checked;

            for (let checkbox of allCheckboxes) {
                checkbox.checked = !isChecked;
            }
        }
    </script>

</body>
</html>
