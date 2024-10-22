@section('script-custom')

<script type="module">

    //////////////////////////////////////////////////////////////////////////
    // Client and Company
    //////////////////////////////////////////////////////////////////////////

    document.addEventListener('DOMContentLoaded', function() {
        var clientSelect = document.getElementById('client');
        var companySelect = document.getElementById('company');
        var oldCompanyValue = "{{ old('company', Request::get('company')) }}";
        
        // Disable company dropdown if no client is selected
        if (!clientSelect.value) {
            companySelect.disabled = true;
        }

        // If old company value exists (e.g., on form validation error), enable the company dropdown
        if (oldCompanyValue) {
            companySelect.disabled = false;
        }

        // Listen for changes on client dropdown to enable/disable company dropdown
        clientSelect.addEventListener('change', function() {
            if (clientSelect.value) {
                companySelect.disabled = false;
                var companies = JSON.parse(clientSelect.options[clientSelect.selectedIndex].dataset.companies);

                companySelect.innerHTML = '<option value="">Please Select</option>';
                companies.forEach(function(company) {
                    var option = document.createElement('option');
                    option.value = company.id;
                    option.text = company.name;
                    companySelect.appendChild(option);
                });
            } else {
                companySelect.disabled = true;
                companySelect.innerHTML = '<option value="">Please Select</option>';
            }
        });

        // Fetch supervisors based on the selected company
        companySelect.addEventListener('change', function() {
            var companyId = this.value;
            var supervisorOneSelect = document.querySelector('[name="supervisor_one"]');
            var supervisorTwoSelect = document.querySelector('[name="supervisor_two"]');

            if (companyId) {
                fetch(`/get-users/${companyId}`)
                    .then(response => response.json())
                    .then(data => {
                        supervisorOneSelect.innerHTML = '<option value="">Please Select</option>';
                        supervisorTwoSelect.innerHTML = '<option value="">Please Select</option>';

                        data.forEach(function(user) {
                            var optionOne = document.createElement('option');
                            var optionTwo = document.createElement('option');

                            optionOne.value = user.id;
                            optionOne.text = user.user_name;
                            optionTwo.value = user.id;
                            optionTwo.text = user.user_name;

                            supervisorOneSelect.appendChild(optionOne);
                            supervisorTwoSelect.appendChild(optionTwo);
                        });
                    })
                    .catch(error => console.error('Error fetching users:', error));
            } else {
                supervisorOneSelect.innerHTML = '<option value="">Please Select</option>';
                supervisorTwoSelect.innerHTML = '<option value="">Please Select</option>';
            }
        });
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
