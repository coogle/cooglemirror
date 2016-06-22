<p><span class="xlarge fa fa-fw fa-bomb"></span></p>
<p>An error has occurred:</p>
<p>{{ $exception->getMessage() }}</p>
<p class="small">{{ $exception->getFile() }}:{{ $exception->getLine() }}</p>
<p class="small align-left">Backtrace</p>

<?php $limit = 8; $i = 1;?>
@foreach(explode("\n", $exception->getTraceAsString()) as $line)
<p class="xsmall align-left">{{ $line }}</p>
<?php if(++$i >= $limit) break; ?> 
@endforeach