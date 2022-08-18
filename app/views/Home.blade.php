@extends('Layout')

@section('Content')

{{--DataTables--}}
{{HTML::style('DataTables/datatables.min.css')}}
{{HTML::script('DataTables/datatables.min.js')}}
{{HTML::script('bootbox.js/bootbox.min.js')}}

<script>
    $(document).ready(function () {
        $('#div_loading').remove();
        $('#div_main').css("display", "");
        $('#header_li_home').css('background', 'green');
        $('#table_main').DataTable({
            language: {
                search: "Smart Search"
            },
            "dom": '<"top"flB>t<"bottom"pi><"clear">',
            "buttons": [
                'copy', 'csv', 'excel', 'print'
            ],
            "order": [[0, "asc"]],
            'iDisplayLength': 50,
            'lengthMenu': [[50, 100, -1], [50, 100, "All"]]
        });
    });

    function DELETE_ENTRY(id) {
        $.get("{{ url('api/delete_company')}}", {id: id});
        alert('Successfully deleted.');
        location.reload();
    }

    function INITIALIZE() {
        $.get("{{ url('initialize')}}");
        alert('Initialization done!');
        location.reload();
    }

</script>

@include('Loading')

<?php
?>

<div id="div_main" class="border border-dark border-right-0" style="display: none;margin-top: 0px;padding-bottom: 10px;">
    <a onclick="INITIALIZE();" style="text-decoration: underline; color: red; cursor: pointer;">Click me to initialize data.</a>
    <table id="table_main" class="table table-striped table-bordered table-hover table-sm">
        <thead class="background-color-maxim">
            <tr>
                <th>Company ID</th>
                <th>Company Name</th>
                <th>Remarks</th>
                <th>Date Established</th>
                @if(isset(Auth::user()->access) && Auth::user()->access==1)
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($array_main_data as $value)
            <tr>
                <td>{{$value->id_company}}</td>
                <td>{{$value->company_name}}</td>
                <td>{{$value->remarks}}</td>
                <td>{{$value->date_established}}</td>
                @if(isset(Auth::user()->access) && Auth::user()->access==1)
                <td>
                    <a href="{{URL::to('edit_company/'.$value->id_company);}}">EDIT</a> | <a onclick="DELETE_ENTRY('<?php echo $value->id_company; ?>');" style="text-decoration: underline; color: red; cursor: pointer;">DELETE</a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop