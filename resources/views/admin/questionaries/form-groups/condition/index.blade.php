@extends('admin.layout.master')

@section('body')

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
        .container{
            margin: 390px auto;
        }
    </style>
    
    <body>

        <div class="container mt-4">
            <h4>
             📌 Add Conditions to Form Group ({{ $formGroup->name }})
             <br>
             <button id="addCondition" class="btn btn-success ms-3" style="height: 38px;">+ New Condition</button>
            </h4>
    
            <div id="conditionContainer">
                <!-- Conditions will be added here dynamically -->
            </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                let conditionCount = 0;
        
                function addCondition() {
                    conditionCount++;
                    let newRow = `
                        <div class="condition-box border shadow-sm" id="condition-${conditionCount}">
                            <div class="condition-header">
                                <h5>Condition ${conditionCount}</h5>
                                <span class="dropdown-arrow toggleArrow">🔽</span>
                                <button type="button" class="btn btn-danger remove-condition" data-id="${conditionCount}">❌</button>
                            </div>
                            <div class="condition-body" style="display: none;">
                                <h6 class="mb-3">When</h6>
                                <div class="mb-3">
                                    <label class="form-label">Form Element</label>
                                    <select class="form-select">
                                        <option value="" disabled selected>Select Form Element</option>
                                        @foreach($formElements as $element)
                                        <option value="{{ $element->id }}">{{ $element->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Condition</label>
                                    <select class="form-select">
                                        <option>Equals to</option>
                                        <option>Does not equal to</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Value</label>
                                    <input type="text" class="form-control" value="yes">
                                </div>
                                <h6 class="mb-3">Do</h6>
                                <div class="condition-options-wrapper">
                                    @include('admin.questionaries.form-groups.condition.condition-form') <!-- Including the form -->
                                </div>
                                <button class="btn btn-primary btn-save mt-3">Save</button>
                            </div>
                        </div>`;
                    $("#conditionContainer").append(newRow);
                }
        
                $("#addCondition").click(function () {
                    addCondition();
                });
        
                $(document).on("click", ".toggleArrow", function () {
                    $(this).closest(".condition-box").find(".condition-body").slideToggle();
                });
        
                $(document).on("click", ".remove-condition", function () {
                    $(this).closest(".condition-box").remove();
                });
            });
        </script>
        <script src="{{ asset('js/condition-form.js') }}"></script>

    </body>      
@endsection
