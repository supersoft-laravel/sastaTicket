<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>
{{-- <script src="../../../unpkg.com/%40googlemaps/markerclusterer%402.0.13/dist/index.min.js"></script> --}}

<script src="{{ asset('assets/js/vendors.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>


<!-- jQuery (required for Toastr) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    toastr.options = {
        "closeButton": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "2000"
    };
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('message'))
        toastr.info("{{ session('message') }}");
    @endif

    @if ($errors->any())
        toastr.error("{{ $errors->first() }}");
    @endif

    $(document).on('click', '.delete_confirmation', function (event) {
        event.preventDefault();

        var form = $(this).closest("form");

        var confirmDelete = confirm("Are you sure?\nYou would not be able to revert this!");

        if (confirmDelete) {
            form.submit();
        } else {
            alert("Your data is safe!");
        }
    });

</script>
