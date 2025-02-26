document.addEventListener("DOMContentLoaded", function () {
    // Checkbox Add Button & ?. is optional chaining operator
    document.querySelector(".add-checkbox-option")?.addEventListener("click", function () {
        let newRow = document.querySelector("#checkbox-options-list tr").outerHTML; // Clone row
        document.getElementById("checkbox-options-list").insertAdjacentHTML("beforeend", newRow); // Add row to table
    });

    // Radio Add Button
    document.querySelector(".add-radio-option")?.addEventListener("click", function () {
        let newRow = document.querySelector("#radio-options-list tr").outerHTML; 
        document.getElementById("radio-options-list").insertAdjacentHTML("beforeend", newRow); 
    });
    // dropdown Add Button
    document.querySelector(".add-dropdown-option")?.addEventListener("click", function () {
        let newRow = document.querySelector("#dropdown-options-list tr").outerHTML;
        document.getElementById("dropdown-options-list").insertAdjacentHTML("beforeend", newRow);  
    });

    // Remove Button for all
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-option")) {
            event.target.closest("tr").remove();
        }
    });
});
