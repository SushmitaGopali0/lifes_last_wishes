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
            <tr>
                <td>
                    <select class="form-select action-select" name="condition_actions[]">
                        <option value="" disabled selected>Please select</option>
                        <option value="Show">Show</option>
                        <option value="Hide">Hide</option>
                    </select>
                </td>
                <td>
                    <select class="form-select element" name="condition_elements[]">
                        <option value="" disabled selected>Select Form Element</option>
                        @foreach($formElements as $element)
                        <option value="{{ $element->id }}">{{ $element->label }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-option">❌</button>
                </td>
            </tr>
        </tbody>
    </table>
    <center><button type="button" class="btn btn-success add-condition-option">+</button></center>
</div>
