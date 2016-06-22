<!DOCTYPE html>
<html>
<head>
	<title>Magic Mirror</title>
	<meta name="google" content="notranslate" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="icon" href="data:;base64,iVBORw0KGgo=">
	
	
    @section('stylesheets')
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/fonts/roboto.css">
	<link rel="stylesheet" type="text/css" href="/css/animate.css">
	<link href="/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	@show
	<!-- custom.css is loaded by the loader.js to make sure it's loaded after the module css files. -->
    
    @section('javascript')
	<script src="/js/jquery-3.0.0.min.js"></script>
	<script>
		$(document).ready(function() {
			setTimeout(function() {
				location.reload();
			}, 5 * 60000);
		});
	</script>
	@show
	
</head>
<body>
    <canvas id="c" style="position: absolute; top:0; left:0; width:100%;height:100%; "></canvas>
	<div class="region fullscreen below">
	   <div class="container">
	   {{ $fullscreen_below }}
	   </div>
	</div>
	<div class="region top bar">
		<div class="container">
		  {{ $top_bar }}
		</div>
		<div class="region top left">
		  <div class="container">
		  {{ $top_left }}
		  </div>
		</div>
		<div class="region top center">
		  <div class="container">
		  {{ $top_center }}
		  </div>
		</div>
		<div class="region top right">
		  <div class="container">
		  {{ $top_right }}
		  </div>
	    </div>
	</div>
	<div class="region upper third">
	   <div class="container">
	   {{ $upper_third }}
	   </div>
	</div>
	<div class="region middle center">
	   <div class="container">
	   {{ $middle_center }}
	   </div>
	</div>
	<div class="region lower third">
	   <div class="container">
	   {{ $lower_third }}
	   </div>
	</div>
	<div class="region bottom bar">
		<div class="container">
		{{ $bottom_bar }}
		</div>
		<div class="region bottom left">
		  <div class="container">
		  {{ $bottom_left }}
		  </div>
		</div>
		<div class="region bottom center">
		  <div class="container">
		  {{ $bottom_center }}
		  @if(isset($exception))
		  {{ $exception }}
		  @endif
		  </div>
		</div>
		<div class="region bottom right">
		  <div class="container">
		  {{ $bottom_right }}
		  </div>
	    </div>
	</div>
	<div class="region fullscreen above">
	   <div class="container">
	   {{ $fullscreen_above }}
	   </div>
	</div>
</body>
</html>
