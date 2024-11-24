@section('script-custom')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const weightInputs = document.querySelectorAll('.weight-input');
        const totalWeight = document.getElementById('total-weight');

        const calculateTotalWeight = () => {
            let total = 0;
            weightInputs.forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            totalWeight.innerText = `${total.toFixed(2)}%`;
        };

        weightInputs.forEach(input => {
            input.addEventListener('input', calculateTotalWeight);
        });

        // Initial Calculation
        calculateTotalWeight();
    });
</script>

@endsection
