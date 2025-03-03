$(document).ready(function () {
   
    $(document).on("click", ".add-condition-option", function () {
        // Find the closest condition-box and then find its corresponding condition-options-list
        let tableBody = $(this).closest(".condition-box").find(".condition-options-list");
        let newRow = tableBody.find("tr").first().clone(); // Clone the first condition option
    
        tableBody.append(newRow); 
     });

    // Remove condition option
    $(document).on("click", ".remove-option", function () {
        $(this).closest("tr").remove(); 
    });
});