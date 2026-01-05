<script src="{{ asset('frontAssets/js/jquery-3.6.0.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('frontAssets/js/bootstrap.bundle.js') }}"></script>
<!-- Meanu js -->
<script src="{{ asset('frontAssets/js/jquery.meanmenu.js') }}"></script>
<!-- Range js -->
<script src="{{ asset('frontAssets/js/nouislider.min.js') }}"></script>
<script src="{{ asset('frontAssets/js/wNumb.js') }}"></script>
<!-- owl carousefl js -->
<script src="{{ asset('frontAssets/js/owl.carousel.min.js') }}"></script>
<!-- wow.js -->
<script src="{{ asset('frontAssets/js/wow.min.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('frontAssets/js/custom.js') }}"></script>
<script src="{{ asset('frontAssets/js/add-form.js') }}"></script>
<script src="{{ asset('frontAssets/js/form-dropdown.js') }}"></script>

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
</script>
