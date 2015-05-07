<!DOCTYPE html>
<html lang="{{ App\Configuration::get('DEF_LANGUAGE') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Smart, Simple, Intuitive Online Invoicing">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@section('title'):: Lara Billander @show </title>

        <link rel="shortcut icon" href="{{{ asset('billandercon.png') }}}" type="image/x-icon">
        <link href='//fonts.googleapis.com/css?family=Roboto:300,400,700,900,100' rel='stylesheet' type='text/css'>

        {!! HTML::style('css/bootstrap-united.min.css'); !!}
        {!! HTML::style('css/extra-buttons.css'); !!}
        {!! HTML::style('assets/font-awesome/css/font-awesome.min.css'); !!}

        {{-- HTML::style('assets/FS-css/datepicker.css'); --}}

        {!! HTML::style('css/custom.css'); !!}
        @yield('styles')
    </head>
    <body>
        @include('layouts/nav')
        <div class="container-fluid" style="margin: 10px 0px 10px 0px;"> 
            @include('layouts/notifications')
            @yield('content')
            @include('layouts/modal_feedback')
            @include('layouts/modal_about')
            @yield('modals')
       </div>
        @include('layouts/footer')

        {!! HTML::script('assets/jquery/jquery-2.1.3.min.js'); !!}
        {!! HTML::script('assets/bootstrap/js/bootstrap.min.js'); !!}

        {{-- HTML::script('assets/FS-js/bootstrap-datepicker.js'); --}}

        {!! HTML::script('js/base.js'); !!}
        {!! HTML::script('js/common.js'); !!}

        <script type="text/javascript">
        $(function(){
           $("#f_feedback").on('submit', function(e){
              e.preventDefault();
              $.post("{{ URL::to('contact') }}", $(this).serialize(), function(data){
                 if (data == 0) {
                    $("#error").addClass("alert alert-danger");
                    $("#error").html('<a class="close" data-dismiss="alert" href="#">×</a><li class="error">{{ l('There was an error. Your message could not be sent.', [], 'layouts') }}</li>');
                 } else {
                    if (isNaN(data)) {
                       $("#error").addClass("alert alert-danger");
                       $("#error").html('<a class="close" data-dismiss="alert" href="#">×</a>' + data + '');
                    } else {
                       $("#modal-body").html('<div class="alert alert-success">{{ l('Your email has been sent!', [], 'layouts') }}</div>');
                       $("#modal-footer").html('<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">{{ l('Continue', [], 'layouts') }}</button>');
                    }
                 }
              });
           });
        });
        </script>
        @yield('scripts')
    </body>
</html>