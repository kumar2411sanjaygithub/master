<script>
$(document).ready(function() {
    $(".num").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110,190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
</script>
{{ Html::script('bower_components/jquery/dist/jquery.min.js') }}

      <!-- Bootstrap 3.3.7 -->
      {{ Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}
      <!-- Select2 -->
      {{ Html::script('bower_components/select2/dist/js/select2.full.min.js') }}
      <!-- InputMask -->
      {{ Html::script('plugins/input-mask/jquery.inputmask.js') }}
      {{ Html::script('plugins/input-mask/jquery.inputmask.date.extensions.js') }}
      {{ Html::script('plugins/input-mask/jquery.inputmask.extensions.js') }}
      <!-- date-range-picker -->
      {{ Html::script('bower_components/moment/min/moment.min.js') }}
      {{ Html::script('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}
      <!-- bootstrap datepicker -->
      {{ Html::script('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}
      <!-- bootstrap color picker -->
      {{ Html::script('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}
      <!-- bootstrap time picker -->
      {{ Html::script('plugins/timepicker/bootstrap-timepicker.min.js') }}
      <!-- SlimScroll -->
      {{ Html::script('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}
      <!-- iCheck 1.0.1 -->
      {{ Html::script('plugins/iCheck/icheck.min.js') }}
      <!-- FastClick -->
      {{ Html::script('bower_components/fastclick/lib/fastclick.js') }}
      <!-- AdminLTE App -->
      {{ Html::script('dist/js/adminlte.min.js') }}
      <!-- AdminLTE for demo purposes -->
      {{ Html::script('dist/js/demo.js') }}
