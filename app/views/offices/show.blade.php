@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-building-o"></i>
        Kantor/Instansi
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('kantor') }}"> Kantor/Instansi</a></li>
        <li><a href="{{ URL::to('kantor') }}/{{ $office->id }}"><i class="active"></i> {{ $office->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <center>
                    <h1><i class="fa fa-building-o text-info"></i></h1>
                    <h1 class="text-info">{{ $office->name }}</h1>
                    <i class="fa fa-road"></i> {{ $office->address }}<br/>
                    <i class="fa fa-phone"></i> {{ $office->phone }} &nbsp;
                    <i class="fa fa-fax"></i> {{ $office->fax }}<br/>
                    <i class="fa fa-file"></i> Mendaftar sebanyak 0 kali
                </center>
            </div>
        </div>
    </div>


</section>

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/datatables/dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/AdminLTE/app.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('#data-table').dataTable();
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function showFormCreate()
    {
        $('#formCreate').modal('show');
        $('#inputName').val('');
        $('#inputAddress').val('');
        $('#inputPhone').val('');
        $('#inputFax').val('');
    }

    function showFormUpdate(id)
    {
        $('#formUpdate').modal('show');
        $('#inputID').val(id);
        $('#inputUName').val($('#name-'+id).val());
        $('#inputUAddress').val($('#address-'+id).val());
        $('#inputUPhone').val($('#phone-'+id).val());
        $('#inputUFax').val($('#fax-'+id).val());
    }

    function create()
    {
        var name = $('#inputName').val();
        var address = $('#inputAddress').val();
        var phone = $('#inputPhone').val();
        var fax = $('#inputFax').val();

        if(name != '')
        {
            $.ajax({
                url:'instansi',
                type:'POST',
                data:{name : name, address : address, phone : phone, fax : fax},
                success:function(){
                    window.location = "instansi";
                }
            });
        }
        else
        {
            window.alert('Nama Instansi harus diisi');
        }
    }

    function update()
    {
        var id = $('#inputID').val();
        var name = $('#inputUName').val();
        var address = $('#inputUAddress').val();
        var phone = $('#inputUPhone').val();
        var fax = $('#inputUFax').val();

       if(name != '')
        {
            $.ajax({
                url:'instansi/'+id,
                type:'PUT',
                data:{name : name, address : address, phone : phone, fax : fax},
                success:function(){
                    window.location = "instansi";
                }
            });
        }
        else
        {
            window.alert('Nama Instansi harus jelas');
        }
    }
    
    function destroy(id)
    {
        if(confirm('Yakin akan menghapus data ini?!'))
        {
            $.ajax({
                url:'instansi/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "instansi";
                }
            });
        }
    }
</script>
@stop