@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        <i class="fa fa-building-o"></i>
        Kantor/Instansi
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('kantor') }}"><i class="active"></i> Kantor/Instansi</a></li>
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
                <a href="{{ URL::to('instansi/create') }}" class="btn btn-flat btn-success" data-toggle="tooltip" data-placement="left" title="Instansi Baru"><i class="fa fa-plus"></i></a>
            </div>
        </div>

        @foreach(array_chunk($offices->getCollection()->all(), 3) as $row)
            <div class="row">
                @foreach($row as $office)
                    <div class="col-lg-4">
                        <center>
                            <h1 class="text-primary">
                                <i class="fa fa-building-o"></i>
                            </h1>
                            <a href="{{ URL::to('instansi') }}/{{ $office->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Detail">{{ $office->name }}</a><br/>
                            <small><i class="fa fa-road"></i> {{ $office->address }}</small><br/>
                            <small><i class="fa fa-phone"></i> {{ $office->phone }}</small><br/>
                            <small><i class="fa fa-fax"></i> {{ $office->fax }}</small><br/>
                            <a href="{{ URL::to('instansi') }}/{{ $office->id }}/edit"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Koreksi"></i></a>&nbsp;
                            <a href="#" class="text-danger" onclick="destroy({{ $office->id }})"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></i></a>&nbsp;
                        </center>
                    </div>
                @endforeach
            </div>
        @endforeach

        <center>{{ $offices->links() }}</center>
    </div>
</section>

<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });
    
    function destroy(id)
    {
        if(confirm('Yakin akan menghapus data ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('instansi') }}"+id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('instansi') }}";
                }
            });
        }
    }
</script>
@stop