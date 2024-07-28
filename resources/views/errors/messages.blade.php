@if ($errors->any())
    <script type="module">
        $(".spinner-content").hide();

        Swal.fire(
            'Oops...',
            'Something went wrong!',
            'error'
        )
    </script>
@endif

@if (session('successMessage'))
    <script type="module">
        $(".spinner-content").hide();

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: "{{ session('successMessage') }}",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif

@if (session('successMessageWithButton'))
    <script type="module">
        $(".spinner-content").hide();

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: "{{ session('successMessageWithButton') }}",
        })
    </script>
@endif

@if (session('errorMessage'))
    <script type="module">
        $(".spinner-content").hide();

        Swal.fire(
            'Error',
            "{{ session('errorMessage') }}",
            'error'
        )
    </script>
@endif

@if (session('errorMessageWithButton'))
    <script type="module">
        $(".spinner-content").hide();

        Swal.fire({
            position: 'center',
            icon: 'error',
            title: "{{ session('errorMessageWithButton') }}",
        })
    </script>
@endif
