// Fetch and display element type/options dynamically as checkboxes or text input
$(document).on("change", ".condition-box .element-select", function () {
    let elementId = $(this).val();
    let valueContainer = $(this).closest(".condition-body").find(".value-container");

    if (elementId) {
        fetch(`/admin/formelements/${elementId}/type`)
            .then(response => response.json())
            .then(data => {
                valueContainer.empty();
                valueContainer.append('<label class="form-label">Value</label>');
                if (['RADIO', 'CHECKBOX', 'DROPDOWN'].includes(data.type)) {
                    valueContainer.append(data.options.map(option => `
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="value[]" value="${option}">
                            <label class="form-check-label">${option}</label>
                        </div>`).join(''));
                } else {
                    valueContainer.append(`
                        <input type="text" class="form-control" placeholder="Enter value" name="value">`);
                }
            })
            .catch(() => {
                valueContainer.html('<label class="form-label">Value</label><input type="text" class="form-control" placeholder="Error fetching data">');
            });
         }
       });
       