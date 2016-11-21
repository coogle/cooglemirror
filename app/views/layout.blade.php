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
	<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
	<script>
		$(document).ready(function() {
			setTimeout(function() {
				location.reload();
			}, 5 * 60000);
		});
	</script>
    <script type="text/javascript">
            var socket = io.connect('http://192.168.1.9:3000/');

            socket.on('connect', function(data) {
				console.log("Socket connected");
            });
            
            socket.on('cooglemirror.ui.switch_url', function(url) {
                console.log("Switching URL to: " + url);
				window.location = url;
            });
            
            socket.on('cooglemirror.ui.timed_url', function (data) {
                data = $.parseJSON(data);

                if(!data.url) {
                    return;
                }

                if(!data.timeout) {
                    data.timeout = 10000;
                }
                
                console.log("Received Event to display Timed URL: ", data);

                $('#urlOverlay').attr('src', data.url).show();
                				//.fadeIn(1000);

				setTimeout(function() {

					$('#urlOverlay').fadeOut(1000, function() {
						$('#urlOverlay').hide().attr('src', '');
					});
					
				}, data.timeout);
				
            });
 
    </script>
	@show
	
</head>
<body>
    <iframe id="urlOverlay"
            scrolling="no" 
            style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;display:none">
        Does not support iFrames!
    </iframe>
    
	<div class="region fullscreen below">
	   <div class="container">
	   @section('fullscreen_below')
	   {{ $fullscreen_below }}
	   @show
	   </div>
	</div>
	<div class="region top bar">
		<div class="container">
		  @section('top_bar')
		  {{ $top_bar }}
		  @show
		</div>
		<div class="region top left">
		  <div class="container">
		  @section('top_left')
		  {{ $top_left }}
		  @show
		  </div>
		  <div class="container">
		  @section('left_middle')
		  {{ $left_middle }}
		  @show
		  </div>
		</div>
		<div class="region top center">
		  <div class="container">
		  @section('top_center')
		  {{ $top_center }}
		  @show
		  </div>
		</div>
		<div class="region top right">
		  <div class="container">
		  @section('top_right')
		  {{ $top_right }}
		  @show
		  </div>
		  <div class="container">
		  @section('right_middle')
		  {{ $right_middle }}
		  @show
		  </div>
	    </div>
	</div>
	<div class="region upper third">
	   <div class="container">
	   @section('upper_third')
	   {{ $upper_third }}
	   @show
	   </div>
	</div>
	<div class="region middle center">
	   <div class="container">
	   @section('middle_center')
	   {{ $middle_center }}
	   @show
	   </div>
	</div>
	<div class="region lower third">
	   <div class="container">
	   @section('lower_third')
	   {{ $lower_third }}
	   @show
	   </div>
	</div>
	<div class="region bottom bar">
		<div class="container">
		@section('bottom_bar')
		{{ $bottom_bar }}
		@show
		</div>
		<div class="region bottom left">
		  <div class="container">
		  @section('bottom_left')
		  {{ $bottom_left }}
		  @show
		  </div>
		</div>
		<div class="region bottom center">
		  <div class="container">
		  @section('bottom_center')
		  {{ $bottom_center }}
		  @show
		  @if(isset($exception))
		  {{ $exception }}
		  @endif
		  </div>
		</div>
		<div class="region bottom right">
		  <div class="container">
		  @section('bottom_right')
		  {{ $bottom_right }}
		  @show
		  </div>
	    </div>
	</div>
	<div class="region fullscreen above">
	   <div class="container">
	   @section('fullscreen_above')
	   {{ $fullscreen_above }}
	   @show
	   </div>
	</div>
</body>
</html>
