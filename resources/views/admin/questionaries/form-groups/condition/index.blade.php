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
        .value-container .form-check {
          margin-left: 20px; 
        }
        .value-container .form-check-label {
         margin-left: 8px;
        }
        .value-container .form-check-input {
        margin-top: 2px; 
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
                <!-- Display saved conditions -->
                @if(is_array($savedConditions) && !empty($savedConditions))
                    @foreach($savedConditions as $index => $condition)
                        <div class="condition-box border shadow-sm" id="condition-{{ $index + 1 }}">
                            <form action="{{ route('formgroups.condition.save', $formGroup->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="condition_index" value="{{ $index }}">
                                <div class="condition-header">
                                    <h5>Condition {{ $index + 1 }}</h5>
                                    <span class="dropdown-arrow toggleArrow">🔽</span>
                                    <button type="button" class="btn btn-danger remove-condition" data-id="{{ $index + 1 }}">❌</button>
                                </div>
                                <div class="condition-body" style="display: none;">
                                    <h6 class="mb-3">When</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Form Element</label>
                                        <select class="form-select element-select" name="element_select">
                                            <option value="" disabled>Select Form Element</option>
                                            @foreach($formElements as $element)
                                                <option value="{{ $element->id }}" {{ $condition['triggerer']['form_element_id'] == $element->id ? 'selected' : '' }}>
                                                    {{ $element->label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="mb-3">
                                        <label class="form-label">Condition</label>
                                        <select class="form-select" name="condition">
                                            <option value="equals to" {{ $condition['condition'] == 'equals' ? 'selected' : '' }}>Equals to</option>
                                            <option value="does not equal to" {{ $condition['condition'] == 'does_not_equal' ? 'selected' : '' }}>Does not equal to</option>
                                        </select>
                                    </div>
            
                                    <div class="mb-3 value-container">
                                        <label class="form-label">Value</label>
                                        @if(in_array($condition['triggerer']['type'], ['RADIO', 'CHECKBOX', 'DROPDOWN']))
                                            @foreach($formElements->find($condition['triggerer']['form_element_id'])->details['options'] ?? [] as $option)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="value[]" value="{{ $option }}"
                                                        {{ in_array($option, $condition['value']) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        @else
                                            <input type="text" class="form-control" name="value[]" value="{{ $condition['value'][0] ?? '' }}">
                                        @endif
                                    </div>
                                    <br>
                                    <h6 class="mb-3">Do</h6>
                                    <div class="condition-options-wrapper">
                                        <div class="mb-3">
                                            <label>Conditions:</label>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>Form Element</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="condition-options-list">
                                                    @foreach($condition['triggered'] as $triggered)
                                                        <tr>
                                                            <td>
                                                                <select class="form-select action-select" name="condition_actions[]">
                                                                    <option value="Show" {{ $triggered['action'] == 'show' ? 'selected' : '' }}>Show</option>
                                                                    <option value="Hide" {{ $triggered['action'] == 'hide' ? 'selected' : '' }}>Hide</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-select element" name="condition_elements[]">
                                                                    <option value="" disabled>Select Form Element</option>
                                                                    @foreach($formElements as $element)
                                                                        <option value="{{ $element->id }}" {{ $triggered['form_element_id'] == $element->id ? 'selected' : '' }}>
                                                                            {{ $element->label }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger remove-option">❌</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <center><button type="button" class="btn btn-success add-condition-option">+</button></center>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-save mt-3">Save</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
            </div>
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                let conditionCount = {{ count($savedConditions) }}; // Start counter from saved conditions
    
                function addCondition() {
                    conditionCount++;
                    let newRow = `
                        <div class="condition-box border shadow-sm" id="condition-${conditionCount}">
                            <form action="{{ route('formgroups.condition.save', $formGroup->id) }}" method="POST">
                                @csrf
                                <div class="condition-header">
                                    <h5>Condition ${conditionCount}</h5>
                                    <span class="dropdown-arrow toggleArrow">🔽</span>
                                    <button type="button" class="btn btn-danger remove-condition" data-id="${conditionCount}">❌</button>
                                </div>
                                <div class="condition-body" style="display: none;">
                                    <h6 class="mb-3">When</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Form Element</label>
                                        <select class="form-select element-select" name="element_select">
                                            <option value="" disabled selected>Select Form Element</option>
                                            @foreach($formElements as $element)
                                            <option value="{{ $element->id }}">{{ $element->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="mb-3">
                                        <label class="form-label">Condition</label>
                                        <select class="form-select" name="condition">
                                            <option value="equals to">Equals to</option>
                                            <option value="does not equal to">Does not equal to</option>
                                        </select>
                                    </div>
    
                                    <div class="mb-3 value-container">
                                        <label class="form-label">Value</label>
                                        <!-- Checkbox or text input will be inserted here dynamically -->
                                    </div>
                                    <br>
                                    <h6 class="mb-3">Do</h6>
                                    <div class="condition-options-wrapper">
                                        @include('admin.questionaries.form-groups.condition.condition-form')
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-save mt-3">Save</button>
                                </div>
                            </form>
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
        <script src="{{ asset('js/dynamic-condition.js') }}"></script>
    </body>
@endsection

