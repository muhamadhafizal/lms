@section('script-custom')
<script type="module">

    //////////////////////////////////////////////////////////////////////////
    // Client And Company
    //////////////////////////////////////////////////////////////////////////

    document.getElementById('client').addEventListener('change', function() {
        var clientSelect = this;
        var companySelect = document.getElementById('company');
        
        if (clientSelect.value) {
            // Enable company dropdown
            companySelect.disabled = false;
            
            var companiesData = clientSelect.options[clientSelect.selectedIndex].dataset.companies;
            var companies = companiesData ? JSON.parse(companiesData) : [];
            
            companySelect.innerHTML = '<option value="">Please Select</option>'; // Clear existing options

            companies.forEach(function(company) {
                var option = document.createElement('option');
                option.value = company.id;
                option.text = company.name;
                companySelect.appendChild(option);
            });
        } else {
            // Disable company dropdown
            companySelect.disabled = true;
            companySelect.innerHTML = '<option value="">Please Select</option>'; // Reset options
        }
    });

    // Ensure company dropdown is disabled on page load if no client is selected
    window.addEventListener('load', function() {
        var clientSelect = document.getElementById('client');
        var companySelect = document.getElementById('company');
        
        if (!clientSelect.value) {
            companySelect.disabled = true;
        }
    });

    window.addEventListener('load', function() {
        var companySelect = document.getElementById('company');
        var oldCompanyValue = "{{ old('company', Request::get('company')) }}";
        
        if (oldCompanyValue) {
            // Enable the company dropdown if there is an old value
            companySelect.disabled = false;
        }
    });



    //////////////////////////////////////////////////////////////////////////
    // Dynamic Form Fields Based on Header Selection
    //////////////////////////////////////////////////////////////////////////

    document.addEventListener('DOMContentLoaded', function () {
        const headerSelect = document.getElementById('header-select');
        const formFieldsContainer = document.getElementById('form-fields-container');

        // Function to generate form fields
        function generateFields(count) {
            // Clear the existing fields
            formFieldsContainer.innerHTML = '';

            for (let i = 1; i <= count; i++) {
                // Create a row with 3 form inputs: No, Legend, and Description
                const row = document.createElement('div');
                row.classList.add('row', 'mb-3');
                
                row.innerHTML = `
                    <div class="col-md-2">
                        <label class="form-label">No</label>
                        <input type="text" class="form-control" name="no[]" value="${i}" readonly required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Legend</label>
                        <input type="text" class="form-control" name="legend[]" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" name="description[]" required>
                    </div>
                `;

                // Append the row to the container
                formFieldsContainer.appendChild(row);
            }
        }

        // Event listener for the header select dropdown
        headerSelect.addEventListener('change', function () {
            const selectedValue = this.value;

            if (selectedValue === '3') {
                generateFields(3);  // Generate 3 sets of fields
            } else if (selectedValue === '5') {
                generateFields(5);  // Generate 5 sets of fields
            } else {
                formFieldsContainer.innerHTML = '';  // Clear fields if no selection
            }
        });
    });
</script>
@endsection