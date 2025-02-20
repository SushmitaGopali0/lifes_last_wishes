@extends('admin.layout.master')

@section('body')
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .condition-box {
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .condition-header {
            background-color: #5DA2DD;
            color: white;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .condition-header h5 {
            margin: 0;
            font-size: 16px;
            flex-grow: 1;
        }

        .delete-btn {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        .delete-btn:hover {
            color: #ff4d4d;
        }

        .dropdown-arrow {
            font-size: 18px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .rotate {
            transform: rotate(180deg);
        }

        .condition-body {
            background: #fff;
            padding: 15px;
            display: none;
        }

        .btn-save {
            float: right;
            margin-top: 15px;
            margin-bottom: 10px;
        }
    </style>

<body>

<div class="container mt-4">
    <h4>
        📌 Add Conditions to Form Group (special event)
        <button id="addCondition" class="btn btn-success ms-3">+ New Condition</button>
    </h4>

    <div id="conditionContainer">
        <!-- Conditions will be added here dynamically -->
    </div>
</div>

<script>
    $(document).ready(function () {
        let conditionCount = 0;

        // Load conditions from localStorage
        function loadConditions() {
            let savedConditions = JSON.parse(localStorage.getItem("conditions")) || [];
            conditionCount = savedConditions.length; // Set count based on saved data

            savedConditions.forEach(condition => {
                addCondition(condition.id, false); // Load existing conditions
            });
        }

        // Function to add new condition
        function addCondition(id = null, saveToStorage = true) {
            conditionCount++;
            let conditionId = id ? id : conditionCount;

            let newCondition = `
                <div class="condition-box border shadow-sm" id="condition-${conditionId}">
                    <div class="condition-header">
                        <h5>Condition ${conditionId}</h5>
                        <span class="dropdown-arrow toggleArrow">🔽</span>
                        <button class="delete-btn" onclick="removeCondition(${conditionId})">❌</button>
                    </div>
                    <div class="condition-body">
                        <h6 class="mb-3">When</h6>
                        <div class="mb-3">
                            <label class="form-label">Form Element</label>
                            <select class="form-select">
                                <option>Do you have wish to travel?</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Condition</label>
                            <select class="form-select">
                                <option>Equals to</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Value</label>
                            <input type="text" class="form-control" value="yes">
                        </div>
                        <h6 class="mb-3">Do</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Action</label>
                                <select class="form-select">
                                    <option>Show</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Form Element</label>
                                <select class="form-select">
                                    <option>Do you have wish to attend event?</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-save">Save</button>
                    </div>
                </div>
            `;
            $("#conditionContainer").append(newCondition);

            // Save to localStorage
            if (saveToStorage) {
                let conditions = JSON.parse(localStorage.getItem("conditions")) || [];
                conditions.push({ id: conditionId });
                localStorage.setItem("conditions", JSON.stringify(conditions));
            }
        }

        // Add condition on button click
        $("#addCondition").click(function () {
            addCondition();
        });

        // Toggle condition body
        $(document).on("click", ".toggleArrow", function () {
            $(this).closest(".condition-box").find(".condition-body").slideToggle();
            $(this).toggleClass("rotate");
        });

        // Remove condition function
        window.removeCondition = function (id) {
            $("#condition-" + id).remove();

            // Remove from localStorage
            let conditions = JSON.parse(localStorage.getItem("conditions")) || [];
            conditions = conditions.filter(condition => condition.id !== id);
            localStorage.setItem("conditions", JSON.stringify(conditions));
        };

        // Load saved conditions on page load
        loadConditions();
    });
</script>

</body>
@endsection