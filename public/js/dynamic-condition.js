$(document).on("change", ".condition-box .element-select", function () {
    let elementId = $(this).val();
    let valueContainer = $(this).closest(".condition-body").find(".value-container");
    let savedValue = valueContainer.find('input[type="text"]').val() || ''; // Preserve existing value

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
                        <input type="text" class="form-control" name="value[]" value="${savedValue}" placeholder="Enter value">`);
                }
            })
            .catch(() => {
                valueContainer.html('<label class="form-label">Value</label><input type="text" class="form-control" value="${savedValue}" placeholder="Error fetching data">');
            });
    }
});