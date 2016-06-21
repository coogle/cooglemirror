<script src="/packages/cooglemirror/clock/js/moment.min.js"></script>
<script>
	function displayTime() {
		var time = moment().format('{{ \Config::get('cooglemirror-clock::widget.format') }}');
		$('#clock').html(time);
		setTimeout(displayTime, 1000);
	}
	
	$(document).ready(function() {
		displayTime();	
	})
</script>
<div id="clock" class="xlarge bright"></div>
