@if (count($errors->all()) > 0)
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>{!! l('Error', [], 'layouts') !!}: </strong>
    {!! l('Please check the form below for errors', [], 'layouts') !!}
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>{!! l('Success', [], 'layouts') !!}: </strong>
    @if(is_array($message))
        @foreach ($message as $m)
            {!! $m !!}
        @endforeach
    @else
        {!! $message !!}
    @endif
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>{!! l('Error', [], 'layouts') !!}: </strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {!! $m !!}
    @endforeach
    @else
    {!! $message !!}
    @endif
</div>
@endif

@if ( ($message = Session::get('warning')) OR ($message = (isset($warning) AND count($warning)) ? $warning : '') )
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>{!! l('Warning', [], 'layouts') !!}: </strong>
    @if(is_array($message))
        <ul>
        @foreach ($message as $m)
            <li>{!! $m !!}</li>
        @endforeach
    <ul>
    @else
    {!! $message !!}
    @endif
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>{!! l('Info', [], 'layouts') !!}: </strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {!! $m !!}
    @endforeach
    @else
    {!! $message !!}
    @endif
</div>
@endif

@if ($message = Session::get('notice'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>{!! l('Success', [], 'layouts') !!}: </strong>
    @if(is_array($message))
    @foreach ($message as $m)
    {!! $m !!}
    @endforeach
    @else
    {!! $message !!}
    @endif
</div>
@endif
