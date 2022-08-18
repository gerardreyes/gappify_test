@extends('Layout')

@section('Content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $('#div_loading').remove();
        $('#div_main').css("display", "");
        $('#header_li_add_transaction').css('background', 'green');
    });
</script>

<?php
?>

@include('Loading')

<div id="div_main" class="border" style="display: none;">
    {{ Form::open(['route'=>'transactions.store']) }}
    <div>
        {{ Form::label('company_name','Company Name: ',array('class' => 'form-control')) }}
        {{ Form::select('company_name', $array_company_name, '', array('required'=>'required')) }}
    </div>
    <div>
        {{ Form::label('transaction_name','Transaction Name: ',array('class' => 'form-control')) }}
        {{ Form::text('transaction_name','',array('required' => 'required', 'maxlength'=>100)) }}
    </div>
    <div>
        {{ Form::label('remarks','Remarks: ',array('class' => 'form-control')) }}
        {{ Form::textarea('remarks','',array('required' => 'required')) }}
    </div>
    <div>
        {{ Form::Submit('Add',array('class' => 'btn btn-primary')) }}
    </div>
    {{ Form::close() }}
</div>

@stop