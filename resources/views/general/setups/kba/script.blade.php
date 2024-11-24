@section('script-custom')
<script>
    let rowIndex = 0;

    // Add a new KBA row
    document.getElementById('add-row').addEventListener('click', () => addRow());

    // Add a new Sub-KBA row
    function addSubRow(parentRow) {
        const parentRowIndex = parentRow.dataset.rowIndex;
        const parentWeightInput = parentRow.querySelector('.weight-input');
        const hiddenWeightInput = parentRow.querySelector('.hidden-weight-input');

        // Disable parent weight input and set hidden input value to 0
        //parentWeightInput.value = 0;
        parentWeightInput.disabled = true;
        //hiddenWeightInput.value = 0;

        const subRow = document.createElement('tr');
        subRow.classList.add('dynamic-row', 'sub-kba-row');
        subRow.dataset.parentRowIndex = parentRowIndex;

        subRow.innerHTML = `
            <td></td>
            <td>
                <input type="text" name="kbas[${parentRowIndex}][sub_kbas][${++rowIndex}][description]" 
                    class="form-control" placeholder="Enter Sub-KBA description" required>
            </td>
            <td>
                <input type="number" name="kbas[${parentRowIndex}][sub_kbas][${rowIndex}][weight]" 
                    class="form-control weight-input" placeholder="e.g. 20" min="0" max="100" required>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-outline-danger btn-sm delete-row">
                    <i class="bx bxs-trash"></i>
                </button>
            </td>
        `;
        parentRow.insertAdjacentElement('afterend', subRow);
        attachRowEvents(subRow);
        calculateTotalWeight();
    }

    // Add a new row
    function addRow() {
        const tableBody = document.querySelector('#kba-table tbody');
        const row = document.createElement('tr');
        row.classList.add('dynamic-row');
        row.dataset.rowIndex = ++rowIndex;

        row.innerHTML = `
            <td>${rowIndex}</td>
            <td>
                <input type="text" name="kbas[${rowIndex}][description]" 
                    class="form-control" placeholder="Enter KBA description" required>
            </td>
            <td>
                <input type="number" name="kbas[${rowIndex}][weight]" 
                    class="form-control weight-input" placeholder="e.g. 20" min="0" max="100" required>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-outline-success btn-sm add-sub-kba">
                    Add Sub-KBA
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm delete-row">
                    <i class="bx bxs-trash"></i>
                </button>
            </td>
        `;
        tableBody.appendChild(row);
        attachRowEvents(row);
        calculateTotalWeight();
    }

    // Attach row event listeners
    function attachRowEvents(row) {
        row.querySelector('.delete-row').addEventListener('click', () => deleteRow(row));
        const addSubKbaBtn = row.querySelector('.add-sub-kba');
        if (addSubKbaBtn) {
            addSubKbaBtn.addEventListener('click', () => addSubRow(row));
        }
        row.querySelector('.weight-input').addEventListener('input', () => calculateTotalWeight());
    }

    // Delete a row and its sub-rows
    function deleteRow(row) {
        const parentRowIndex = row.dataset.rowIndex;
        const subRows = document.querySelectorAll(`[data-parent-row-index="${parentRowIndex}"]`);
        subRows.forEach(subRow => subRow.remove());

        // Enable parent weight input if no sub-KBAs exist
        if (row.classList.contains('dynamic-row') && !row.classList.contains('sub-kba-row')) {
            const parentWeightInput = row.querySelector('.weight-input');
            const hiddenWeightInput = row.querySelector('.hidden-weight-input');
            if (subRows.length > 0) {
                parentWeightInput.disabled = false;
                hiddenWeightInput.value = parentWeightInput.value; // Sync hidden input
            }
        }

        row.remove();
        updateRowNumbers();
        calculateTotalWeight();
    }

    // Update row numbers after adding or deleting rows
    function updateRowNumbers() {
        const parentRows = document.querySelectorAll('.dynamic-row:not(.sub-kba-row)');
        rowIndex = 0;

        parentRows.forEach((parentRow, index) => {
            rowIndex = index + 1;
            parentRow.dataset.rowIndex = rowIndex;
            parentRow.querySelector('td:first-child').textContent = rowIndex;

            const subRows = document.querySelectorAll(`[data-parent-row-index="${index + 1}"]`);
            subRows.forEach((subRow, subIndex) => {
                subRow.dataset.parentRowIndex = rowIndex;
            });
        });
    }

    // Calculate total weightage and validate
    function calculateTotalWeight() {
        const parentRows = document.querySelectorAll('.dynamic-row:not(.sub-kba-row)');
        let overallTotal = 0;

        parentRows.forEach(parentRow => {
            const parentWeight = parseFloat(parentRow.querySelector('.weight-input')?.value || 0);
            const subRows = document.querySelectorAll(`[data-parent-row-index="${parentRow.dataset.rowIndex}"]`);
            const subTotal = Array.from(subRows).reduce((sum, subRow) => 
                sum + parseFloat(subRow.querySelector('.weight-input')?.value || 0), 0);

            overallTotal += parentWeight + subTotal;
        });

        // Update total weight display
        document.getElementById('total-weight').textContent = `${overallTotal.toFixed(2)}%`;

        // Disable save button and show message if total exceeds 100
        const saveButton = document.getElementById('save-button');
        const weightMessage = document.getElementById('weight-message');

        if (overallTotal > 100) {
            saveButton.disabled = true;
            weightMessage.textContent = 'Total weightage exceeds 100%. Please adjust.';
            weightMessage.style.color = 'red';
        } else {
            saveButton.disabled = false;
            weightMessage.textContent = 'Total weightage is within limit.';
            weightMessage.style.color = 'green';
        }
    }
</script>
@endsection
