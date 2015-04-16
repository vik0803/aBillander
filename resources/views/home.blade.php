@extends('layouts.master')

@section('title') {{ l('Welcome') }} @parent @stop


@section('content')

<div class="page-header">
    <h2>
         <a href="{{{ URL::to('auth/logout') }}}">{{ Auth::user()->getFullName() }}</a> <span style="color: #cccccc;">/</span> {{ l('Home') }}
    </h2>        
</div>

<div class="jumbotron">
  <!-- h1>Jumbotron</h1>
  <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <p><a class="btn btn-primary btn-lg">Learn more</a></p -->
<img src="{{URL::to('/img/push_Billander.jpg')}}" title='"Don’t ever fight with Lisbeth Salander. Her attitude towards the rest of the world is that if someone threatens her with a gun, she’ll get a bigger gun.”

― Stieg Larsson, The Girl Who Played with Fire'
                    class="center-block"
                    style=" xborder: 2px solid black;
                            border-radius: 18px;
                            -moz-border-radius: 18px;
                            -khtml-border-radius: 18px;
                            -webkit-border-radius: 18px;">
{{-- HTML::image('img/picture.jpg', 'a picture', array('class' => 'thumb')) --}}
</div>

@stop
