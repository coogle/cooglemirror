@extends('layout')

@section('top_left')
<table style="width: 400px">
    <tr>
        <td colspan="3" class="normal bright" align="center">{{ $recipe->title }}</td>
    </tr>
    <tr>
        <td colspan="3">
            <img src="{{ $recipe->photo_url or ''}}" style="width:400px; height:284;">
        </td>
    </tr>
    <tr>
        <td><span class="fa fa-fw fa-clock-o"></span></td>
        <td>Prep Time</td>
        <td class="large bright">{{ $recipe->time['prep'] or '??'}}&nbsp;min</td>
    </tr>
    <tr>
        <td><span class="fa fa-fw fa-clock-o"></span></td>
        <td>Cook Time</td>
        <td class="large bright">{{ $recipe->time['cook'] or '??'}}&nbsp;min</td>
    </tr>
</table>
@stop

@section('top_right')
<table style="width:550px">
    <tr>
        <td align="center" class="bright" style="border-bottom: thin solid white;">Ingredients<br/><span class="small">(6 servings)</span></td>
    </tr>
    @foreach($recipe->ingredients as $ingredientLists)
        @if(!empty($ingredientLists['name']))
        <tr>
            <td class="small bright" align="center">{{ $ingredientLists['name'] }}</td>
        </tr>
        @endif 
        @foreach($ingredientLists['list'] as $ingredient)
        <tr>
            <td class="small">{{ $ingredient }}</td>
        </tr>
        @endforeach
    @endforeach
</table>
@stop

@section('middle_center')
<table>
    <tr>
        <td class="bright" align="center">Instructions</td>
    </tr>
    @foreach($recipe->instructions as $instructionLists)
        @if(!empty($instructionLists['name']))
        <tr>
            <td class="normal bright" align="center">{{ $instructionLists['name'] }}</td>
        </tr>
        @endif
        @foreach($instructionLists['list'] as $instruction)
        <tr>
            <td class="normal" align="left"><span class="fa fa-fw fa-caret-right"></span> {{ $instruction }}</td>
        </tr>
        @endforeach
   @endforeach
</table>
@stop
