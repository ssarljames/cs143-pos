<script src="/js/core/jquery.min.js"></script>
<script src="/js/core/popper.min.js"></script>
<script src="/js/core/bootstrap.min.js"></script>
<script src="/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
{{--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}
<!-- Chart JS -->
<script src="/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>

<script src="/js/app.js" type="text/javascript"></script>

@stack("scripts")

<script>
    $(document).ready(function () {
        window.livewire.on('livewireToast', e => {
            Swal.fire({
                title: e.title,
                text: e.text,
                toast: e.toast,
                position: e.position,
                timer: 10000,
                type: e.status
            });
        });
    });
</script>
