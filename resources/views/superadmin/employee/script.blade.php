@section('script-custom')

<script type="module">

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


</script>

@endsection