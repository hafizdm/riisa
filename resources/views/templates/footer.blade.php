<!-- jQuery 2.2.3 -->
<script src="{{ asset('AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('AdminLTE-2.3.11/plugins/iCheck/icheck.min.js') }}"></script>

<!-- iCheck -->
<script src="{{ asset('AdminLTE-2.3.11/plugins/fastclick/fastclick.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-2.3.11/dist/js/app.min.js') }}"></script>

<script src="{{ asset('js/moment.js') }}" defer></script>

<!-- Data Table -->
<script src="{{ asset('AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<!-- File input bootstrap -->
<script src="{{ asset('AdminLTE-2.3.11/plugins/fileinput-v4.5.2-0/js/plugins/piexif.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.3.11/plugins/fileinput-v4.5.2-0/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.3.11/plugins/fileinput-v4.5.2-0/js/plugins/purify.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.3.11/plugins/fileinput-v4.5.2-0/js/fileinput.min.js') }}"></script>

<script src="{{ asset('AdminLTE-2.3.11/plugins/jquery-validation-1.19.0/dist/jquery.validate.min.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

<!--updated by cici-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/locale/pt-br.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script type="text/javascript" src="{{asset('js/loader.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        /** add active class and stay opened when selected */
        var host = window.location.origin;
        var single_sub = window.location;
        var link = window.location.pathname;
        var url = link.slice(0, link.lastIndexOf('/'));
        // for sidebar menu entirely but not cover treeview
        var a = url.split('/');
        if ($.isNumeric([2])) {
            var last = a[2].replace(/\d+/, '');
            var numberic_url = host + '/' + a[1]
        } else {
            var numberic_url = host + '/' + a[1] + '/' + a[2];
        }
        //console.log(a[2]);
        $('ul.sidebar-menu a').filter(function() {
            return this.href == host + url || this.href == single_sub || this.href == numberic_url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
            return this.href == host + url || this.href == single_sub || this.href == numberic_url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
    });
</script>
{{-- my style  --}}
@stack('script')
</body>

</html>