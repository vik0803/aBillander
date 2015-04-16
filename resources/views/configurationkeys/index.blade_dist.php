@extends('layouts.master')

@section('title') {{ Lang::get('customers.general.title') }} {{ Lang::get('general.settings') }} :: @parent @stop

@section('styles') 
{{ HTML::style('assets/lib/datatables-bootstrap3/css/datatables_fa.css'); }}
@stop

@section('content')

<div class="page-header">
    <div class="pull-right">
        <a href="{{{ URL::to('customers/create') }}}" class="btn btn-success"><i class="fa fa-plus"></i> Add new Customer</a>
  		@if (Input::get('onlyTrashed'))
        	<a class="btn btn-default" href="{{ URL::to('customers') }}">{{ Lang::get('customers.general.show_curent') }}</a>
        @else
        	<a class="btn btn-default" href="{{ URL::to('customers?onlyTrashed=true') }}">{{ Lang::get('customers.general.show_deleted') }}</a>
        @endif            
    </div>
    <h2>
        @if (Input::get('onlyTrashed'))
        	{{ Lang::get('customers.general.deleted') }}
        @else
        	Customers
        @endif
    </h2>        
</div>

@if ($customers->count())
<table id="customers" class="table table-bordered">
    <thead>
        <tr>
            <th class="col-md-5">{{ Lang::get('customers.table.name') }}</th>
            <th class="col-md-5">{{ Lang::get('customers.table.email') }}</th>
            <th class="col-md-2 text-right">{{ Lang::get('general.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->name_commercial }}</td>
            <td>{{{ $customer->email }}}</td>
            <td class="text-right">
                @if (  is_null($customer->deleted_at))
                <a class="btn btn-small btn-success" href="{{ URL::to('customers/' . $customer->id) }}"><i class="fa fa-eye"></i></a>               
                <a href="{{ URL::to('customers/' . $customer->id . '/edit') }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                <a data-html="false" class="btn btn-danger delete-customer" data-toggle="modal" href="{{ URL::to('customers/' . $customer->id ) }}" data-content="{{ Lang::get('customers.message.warning.delete') }}" data-title="{{ Lang::get('general.delete') }} {{ htmlspecialchars($customer->name) }}?" onClick="return false;"><i class="fa fa-trash-o"></i></a>
                @else
                <a href="{{ URL::to('customers/' . $customer->id. '/restore' ) }}" class="btn btn-warning"><i class="fa fa-reply"></i></a>
                <a href="{{ URL::to('customers/' . $customer->id. '/delete' ) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-warning alert-block">
    <i class="fa fa-warning"></i>
    {{ Lang::get('customers.table.noresults') }}
</div>
@endif

@include('layouts/modal')

@stop

@section('scripts')
{{ HTML::script('assets/lib/datatables/js/jquery.dataTables.js'); }}
{{ HTML::script('assets/lib/datatables-bootstrap3/js/datatables.js'); }}
<script type="text/javascript">
    $(document).ready(function () {
        $('#customers').dataTable({
            /* Set the defaults for DataTables initialisation */
            "bAutoWidth": false,
            // Disable sorting on the first and column
            "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [2]
                }],
            "sPaginationType": "bs_normal",
        });
        $('.delete-customer').click(function (evnt) {
            var href = $(this).attr('href');
            var message = $(this).attr('data-content');
            var title = $(this).attr('data-title');
            $('#myModalLabel').text(title);
            $('#dataConfirmModal .modal-body').text(message);
            $('#action').attr('action', href);
            $('#dataConfirmModal').modal({show: true});
            return false;
        });
    });
</script>

@stop