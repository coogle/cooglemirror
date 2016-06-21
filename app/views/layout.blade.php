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
	@show
	<!-- custom.css is loaded by the loader.js to make sure it's loaded after the module css files. -->
    
    @section('javascript')
	<script src="/js/jquery-3.0.0.min.js"></script>
	@show
	
</head>
<body>
	<div class="region fullscreen below">
	   <div class="container">
	   @yield('fullscreen-below')
	   </div>
	</div>
	<div class="region top bar">
		<div class="container">
		  @yield('top-bar')
		</div>
		<div class="region top left">
		  <div class="container">
		  @yield('top-left')
		  </div>
		</div>
		<div class="region top center">
		  <div class="container">
		  @yield('top-center')
		  </div>
		</div>
		<div class="region top right">
		  <div class="container">
		  @yield('top-right')
		  </div>
	    </div>
	</div>
	<div class="region upper third">
	   <div class="container">
	   @yield('upper-third')
	   </div>
	</div>
	<div class="region middle center">
	   <div class="container">
	   @yield('middle-center')
	   </div>
	</div>
	<div class="region lower third">
	   <div class="container">
	   @yield('lower-third')
	   </div>
	</div>
	<div class="region bottom bar">
		<div class="container">
		@yield('bottom-bar')
		</div>
		<div class="region bottom left">
		  <div class="container">
		  @yield('bottom-left')
		  </div>
		</div>
		<div class="region bottom center">
		  <div class="container">
		  @yield('bottom-center')
		  @if(isset($exception))
		  {{ $exception }}
		  @endif
		  </div>
		</div>
		<div class="region bottom right">
		  <div class="container">
		  @yield('bottom-right')
		  </div>
	    </div>
	</div>
	<div class="region fullscreen above">
	   <div class="container">
	   @yield('fullscreen-above')
	   </div>
	</div>
</body>
</html>