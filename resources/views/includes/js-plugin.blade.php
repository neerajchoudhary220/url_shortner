<script src="{{ asset('assets/js/jquery.js') }}"></script>

<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ripple.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweet-alert.js') }}"></script>
<script src="{{ asset('assets/js/custom-js.js') }}"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            }
        })
        $('[data-bs-toggle="tooltip"]').tooltip();


        setTimeout(() => {
            $(".alert-msg").hide();
        }, 1000);
    })

</script>

@stack('custom-js')
