<script src="/packages/cooglemirror/clock/js/moment.min.js"></script>
<script>
	function displayTime() {
		var time = moment().format('{{ \Config::get('cooglemirror-clock::widget.time_format') }}');
		var date = moment().format('{{ \Config::get('cooglemirror-clock::widget.date_format') }}');
		$('#time').html(time);
		$('#date').html(date);
		setTimeout(displayTime, 1000);
	}
	
	$(document).ready(function() {
		displayTime();	
	})
</script>
<div class="bright"><span id="date"></span><br/><span id="time" class="large"></span></div>
