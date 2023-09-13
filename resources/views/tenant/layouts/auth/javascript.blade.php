<!--   Core JS Files   -->
<script src="{{ asset('assets/creative-tim/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/creative-tim/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/creative-tim/js/plugins/perfect-scrollbar.min.js') }}"></script>
<!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
<script src="{{ asset('assets/creative-tim/js/plugins/countup.min.js') }}"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
<script src="{{ asset('assets/creative-tim/js/plugins/rellax.min.js') }}"></script>
<!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
<script src="{{ asset('assets/creative-tim/js/plugins/tilt.min.js') }}"></script>
<!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
<script src="{{ asset('assets/creative-tim/js/plugins/choices.min.js') }}"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="{{ asset('assets/creative-tim/js/plugins/parallax.min.js') }}"></script>
<!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src="{{ asset('assets/creative-tim/js/soft-design-system.min.js?v=1.0.9') }}" type="text/javascript"></script>
<script type="text/javascript">
    if (document.getElementById('state1')) {
        const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
        if (!countUp.error) {
            countUp.start();
        } else {
            console.error(countUp.error);
        }
    }
    if (document.getElementById('state2')) {
        const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
        if (!countUp1.error) {
            countUp1.start();
        } else {
            console.error(countUp1.error);
        }
    }
    if (document.getElementById('state3')) {
        const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
        if (!countUp2.error) {
            countUp2.start();
        } else {
            console.error(countUp2.error);
        };
    }
</script>
