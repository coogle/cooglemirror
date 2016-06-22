<script>
   var headlines = {{ json_encode($headlines) }};
   var currentHeadline = 0;
   
	var changeHeadline = function() {
		if((currentHeadline + 1) > headlines.length) {
			currentHeadline = 0;
		}
		
		$('#currentHeadline').addClass('fadeOut')
							 .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			
			$('#currentHeadline').html(headlines[currentHeadline]);
			$('#currentHeadline').removeClass('fadeOut')
								 .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
									currentHeadline++;
									setTimeout(changeHeadline, 5000);
			});		
		});
   };
	
   $(document).ready(changeHeadline);
</script>
<div id="currentHeadline" class="animated fadeIn">{{ $headlines[0] }}</div>