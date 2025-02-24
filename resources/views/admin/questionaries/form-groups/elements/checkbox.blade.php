

<!-- Options Table -->
<div class="mb-3">
    <label>Options:</label>
    <table class="table">
        <thead>
            <tr>
                <th>Value</th>
                <th>Set as default</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="options-list">
            <tr>
                <td><input type="text" name="options[]" class="form-control" placeholder="Enter a value"></td>
                <td><input type="checkbox" name="default_option"></td>
                <td><button type="button" class="btn btn-danger remove-option">❌</button></td>
            </tr>
        </tbody> 
    </table>
    <center> <button type="button" class="btn btn-success" id="add-option">+</button></center>
</div>

<script>
document.getElementById("add-option").addEventListener("click", function () {
    let newRow = document.querySelector("#options-list tr").outerHTML; // Get existing row HTML
    document.getElementById("options-list").insertAdjacentHTML("beforeend", newRow);
});

document.getElementById("options-list").addEventListener("click", function (event) {
    if (event.target.classList.contains("remove-option")) {
        event.target.closest("tr").remove();
    }
});
</script>
