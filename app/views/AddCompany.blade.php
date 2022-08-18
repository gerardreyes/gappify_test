@extends('Layout')

@section('Content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $('#div_loading').remove();
        $('#div_main').css("display", "");
        $('#header_li_add').css('background', 'green');

        $("#date_established").datepicker();
        $("#date_established").datepicker("option", "dateFormat", "yy-mm-dd");
    });
</script>

@include('Loading')

<div id="div_main" class="border" style="display: none;">
    {{ Form::open(['route'=>'home.store']) }}
    <div>
        {{ Form::label('company_name','Company Name: ',array('class' => 'form-control')) }}
        {{ Form::text('company_name','',array('required' => 'required', 'maxlength'=>100)) }}
    </div>
    <div>
        {{ Form::label('remarks','Remarks: ',array('class' => 'form-control')) }}
        {{ Form::textarea('remarks','',array('required' => 'required')) }}
    </div>
    <div>
        {{ Form::label('date_established','Date Established: ',array('class' => 'form-control')) }}
        {{ Form::text('date_established','',array('required' => 'required')) }}
    </div>
    <div>
        {{ Form::Submit('Add',array('class' => 'btn btn-primary')) }}
    </div>
    {{ Form::close() }}
</div>

@stop