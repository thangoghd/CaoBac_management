<!-- Bootstrap core JavaScript-->
<script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>

<script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
{{-- <script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script> --}}

{{-- Installation Font Awesome Kit --}}
<script src="https://kit.fontawesome.com/6c02325e2b.js" crossorigin="anonymous"></script>



{{-- Set timeout for alert message --}}
<script>
    setTimeout(() => {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
    }, 5000);
    $('.close-btn').click(function(){
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
    });
</script>

{{--Revenue chart --}}
