@extends('admin.layout.master')

@section('body')
<div class="container mt-4">
    <div class="card">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card-header d-flex align-items-center">
            <i class="fas fa-file-alt me-2"></i>
            <h4 class="mb-0">Add Elements to Form Group ({{ $formGroup->name }})</h4>
        </div>
        <div class="card-body">
            <button class="btn btn-success mb-3" id="openModal">
                <i class="fas fa-plus"></i> New Element
            </button>

            <ul id="sortable" class="list-group">
                @foreach($formGroup->elements as $element)
                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $element->id }}">
                    <span>{{ $element->label }}</span>
                    <div class="btn-group">
                        <button class="btn btn-primary btn-sm btn-edit" data-id="{{ $element->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        
                        <form action="{{ route('formelements.destroy', $element->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type = "submit" class="btn btn-danger btn-sm btn-delete" data-id="{{ $element->id }}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- Modal for Adding/Editing Elements -->
<div id="elementModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Element</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="elementForm" method="POST" action="{{ route('formelements.store') }}">
                    @csrf
                    <input type="hidden" id="element_id" name="element_id">
                    <input type="hidden" name="form_group_id" value="{{ $formGroup->id }}">
                
                    <div class="mb-3">
                        <label for="type">Element Type:</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="" disabled selected>Select Element Type</option>
                            <option value="TEXT">Text</option>
                            <option value="TEXTAREA">Textarea</option>
                            <option value="RADIO">Radio</option>
                            <option value="CHECKBOX">Checkbox</option>
                            <option value="DROPDOWN">Dropdown</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="label">Element Label:</label>
                        <input type="text" name="label" id="label" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pdf_label">PDF Label:</label>
                        <input type="text" name="pdf_label" id="pdf_label" class="form-control">
                    </div>

                    <div id="text-form" style="display: none;">
                        @include('admin.questionaries.form-groups.elements.text')
                    </div>

                    <div id="textarea-form" style="display: none;">
                        @include('admin.questionaries.form-groups.elements.textarea')
                    </div>
                
                    <div id="checkbox-form" style="display: none;">
                        @include('admin.questionaries.form-groups.elements.checkbox')
                    </div>

                    <div id="radio-form" style="display: none;">
                        @include('admin.questionaries.form-groups.elements.radio')
                    </div>

                    <div id="dropdown-form" style="display: none;">
                        @include('admin.questionaries.form-groups.elements.dropdown')
                    </div>
                   
                    <div class="mb-3">
                        <label for="show_in_pdf">Show in PDF:</label>
                        <select name="show_in_pdf" id="show_in_pdf" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/formbuilder.js') }}"></script>
<script>

   //for dynamic form
    document.getElementById("type").addEventListener("change", function () {
    let selectedType = this.value;
    document.getElementById("text-form").style.display = selectedType === "TEXT" ? "block" : "none";
    document.getElementById("textarea-form").style.display = selectedType === "TEXTAREA" ? "block" : "none";
    document.getElementById("checkbox-form").style.display = selectedType === "CHECKBOX" ? "block" : "none";
    document.getElementById("radio-form").style.display = selectedType === "RADIO" ? "block" : "none";
    document.getElementById("dropdown-form").style.display = selectedType === "DROPDOWN" ? "block" : "none";

});

   // Open Modal for Adding New Element
    document.getElementById("openModal").addEventListener("click", function () {
    document.getElementById("elementForm").reset(); // Reset the form fields
    document.getElementById("element_id").value = ''; // Clear hidden input for element ID
    document.querySelector(".modal-title").textContent = "Add Element"; // Set modal title
    var myModal = new bootstrap.Modal(document.getElementById("elementModal"));
    myModal.show();
});

 // Open Modal and Populate Data for Editing
    document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener("click", function () {
        const elementId = this.getAttribute('data-id'); // Get the ID of the element

        fetch(`/admin/allformelements/${elementId}/edit`) // send get request & fetch json response from server
            .then(response => response.json()) // Convert JSON to JavaScript object
            .then(data => {
                // Populate the form fields with the fetched data
                document.getElementById("element_id").value = data.id; 
                document.getElementById("label").value = data.label; //data.label is column name
                document.getElementById("pdf_label").value = data.pdf_label;       
                document.getElementById("show_in_pdf").value = data.show_in_pdf ? 1 : 0;
                document.getElementById("type").value = data.type; //from form name=type
 
                //display form interms of selected element type. 
                let typeSelect = document.getElementById("type");
                typeSelect.value = data.type; 
                typeSelect.dispatchEvent(new Event("change"));
    
            // Handle pre-filled text for TEXT and TEXTAREA
            let prefilledText = data.details && data.details.pre_filled ? data.details.pre_filled : '';
            document.getElementById("prefilled_text").value = data.type === "TEXT" ? prefilledText : "";
            document.getElementById("prefilled_textarea").value = data.type === "TEXTAREA" ? prefilledText : "";


        // Display saved options data for CHECKBOX or RADIO dynamically when editing.
            let optionsContainer = data.type === "CHECKBOX" ? document.getElementById("checkbox-options-list") 
            : data.type === "RADIO" ? document.getElementById("radio-options-list")       
            : document.getElementById("dropdown-options-list");

            if (data.type === "CHECKBOX" || data.type === "RADIO" || data.type === "DROPDOWN") {  
             optionsContainer.innerHTML = ""; // Clear previous data & show latest options data.
            if (data.details && data.details.options) {
                data.details.options.forEach(option => { //fetch data from database.
                    let newRow = `<tr>
                        <td><input type="text" name="${data.type.toLowerCase()}_options[]" class="form-control" value="${option}"></td>
                       <td><input type="${data.type === 'CHECKBOX' ? 'checkbox' : data.type === 'RADIO' ? 'radio' : data.type === 'DROPDOWN' ? 'radio' : ''}" 
                        name="default_${data.type.toLowerCase()}_option"></td>
                        <td><button type="button" class="btn btn-danger remove-option">❌</button></td>
                    </tr>`;
                    optionsContainer.insertAdjacentHTML('beforeend', newRow);
                });
            }
         
        }   
                // Change modal title to "Edit Element"
                document.querySelector(".modal-title").textContent = "Edit Element";

                // Open the modal
                var myModal = new bootstrap.Modal(document.getElementById("elementModal"));
                myModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Unable to load data.');
            });
    });
});

</script>

<style>
    .btn-group {
    display: flex;
    gap: 8px; 
    align-items: center;
}

.delete-form {
    display: inline-block;
    margin: 0;
}

</style>
@endsection
