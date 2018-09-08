<!-- jQuery 3 -->
<script src="{{URL::asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{URL::asset('plugins/iCheck/icheck.min.js')}}"></script>
<script>
   $(function () {
     $('input').iCheck({
       checkboxClass: 'icheckbox_square-blue',
       radioClass: 'iradio_square-blue',
       increaseArea: '20%' /* optional */
     });
   });
</script>
<script type="text/javascript">
	if (location.hash) {
	  $('a[href=\'' + location.hash + '\']').tab('show');
	}
	var activeTab = localStorage.getItem('activeTab');
	if (activeTab) {
	  $('a[href="' + activeTab + '"]').tab('show');
	}

	$('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
	  e.preventDefault()
	  var tab_name = this.getAttribute('href')
	  if (history.pushState) {
	    history.pushState(null, null, tab_name)
	  }
	  else {
	    location.hash = tab_name
	  }
	  localStorage.setItem('activeTab', tab_name)

	  $(this).tab('show');
	  return false;
	});
	$(window).on('popstate', function () {
	  var anchor = location.hash ||
	    $('a[data-toggle=\'tab\']').first().attr('href');
	  $('a[href=\'' + anchor + '\']').tab('show');
	});
</script>