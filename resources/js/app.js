 
 
$(document).ready(function() {
    // Initialize validation

    // Show wedding date field only for married individuals
    $("input[name='marital_status']").on("change", function() {
        if ($(this).val() === "Married") {
            $("#wedding-date-section").slideDown();
        } else {
            $("#wedding-date-section").slideUp();
        }
    });

    $('#state').on('change', function() {
        var state = $(this).val(); 
        if (state) {
            $.getJSON('/family/getcities', { state: state }, function(cities) {
                $('#city').empty(); // Clear previous cities
                $('#city').append('<option value="">Select City</option>'); // Add default option

                // Populate cities dropdown
                $.each(cities, function(index, city) {
                    $('#city').append('<option value="' + city + '">' + city + '</option>');
                });
            });
        } else {
            $('#city').empty().append('<option value="">Select City</option>'); // Clear cities if no state is selected
        }
    });

    // Function to dynamically add hobbies
 function addHobby() {
        const newHobby = `
            <div class="mb-3 hobby-field">
                <label class="d-none">Hobbies</label>
                <input type="text" name="hobbies[]" class="form-control mt-2 w-100" placeholder="Enter hobby">
                <button type="button" class="btn btn-danger mt-2 remove-hobby">Remove</button>
            </div>`;
        $(".hobby-field").last().after(newHobby); // Add the new hobby field after the last existing one
    }

    // Bind event to the 'Add Hobby' button
    $(document).on("click", ".add-hobby-btn", addHobby);

    // Dynamically remove hobby field
    $(document).on("click", ".remove-hobby", function () {
        $(this).closest(".hobby-field").remove();
    });


  

});


