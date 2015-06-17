@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        <i class="fa fa-user"></i>
        Pasien
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('pasien') }}"><i class="active"></i> Pasien</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
            <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif
        </div>

        <div class="col-lg-12">
            <div class="pull-right">
                <a href="{{ URL::to('pasien/create') }}" class="btn btn-flat btn-success" data-toggle="tooltip" data-placement="left" title="Pegawai Baru"><i class="fa fa-plus"></i></a>
            </div>
        </div>
            
        @foreach(array_chunk($patients->getCollection()->all(), 4) as $row)
            <div class="row">
                @foreach($row as $patient)
                    <div class="col-lg-3">
                        <center>
                            <h1 class="text-primary">
                                <i class="fa fa-user"></i>
                            </h1>
                            <a href="{{ URL::to('pasien') }}/{{ $patient->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Riwayat Kunjungan">{{ $patient->name }}</a><br/>
                            <small>{{ $patient->code }}</small><br/>
                            <small>{{ $patient->city->name }}</small>
                            <br/>
                            <a href="{{ URL::to('pasien') }}/{{ $patient->id }}/edit"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>&nbsp;
                            <a href="#" class="text-danger" onclick="destroy({{ $patient->id }})"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="right" title="Hapus"></i></a>&nbsp;
                        </center>
                    </div>
                @endforeach
            </div>
        @endforeach

        <center>{{ $patients->links() }}</center>
    </div>
</section>


<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}

<script type="text/javascript">
    $(function(){
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });
    })

    function destroy(id)
    {
        if(confirm('Yakin akan menghapus data ini?!'))
        {
            $.ajax({
                url:'pasien/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "pasien";
                }
            });
        }
    }
</script>
@stop