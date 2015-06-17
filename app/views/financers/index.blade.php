@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        <i class="fa fa-credit-card"></i>
        Pembiayaan
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ URL::to('data') }}"> Data & Pengaturan</a></li>
        <li><a href="{{ URL::to('pembiayaan') }}"><i class="active"></i> Pembiayaan</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @if(Session::has('message'))
            <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif

            <div class="row">
                <div class="col-xs-12">
                    <div class="text-right">
                        <a class="btn btn-flat btn-success" href="{{ URL::to('pembiayaan/create') }}" data-toggle="tooltip" data-placement="left" title="Tambahkan Paket Pemeriksaan Baru"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>

            @foreach(array_chunk($financers->all(), 4) as $rows)

                <div class="row">
                    
                    @foreach($rows as $financer)

                        <div class="col-lg-3">
                            <div class="thumb-menu">
                                <h1 class="text-navy"><i class="fa fa-credit-card"></i></h1>
                                <a href="{{ URL::to('pembiayaan') }}/{{ $financer->id }}/edit" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                                <a href="#" onclick="destroy({{ $financer->id }})" data-toggle="tooltip" data-placement="right" title="Hapus" class="text-danger"><i class="fa fa-trash-o"></i></a><br/>
                                <strong><a href="{{ URL::to('pembiayaan') }}/{{ $financer->id }}" data-toggle="tooltip" data-placement="top" title="Statistik Layanan">{{ $financer->name }}</a></strong><br/>
                            </div>
                        </div>

                    @endforeach

                </div>

            @endforeach
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('[name=]')
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
                url:'pembiayaan/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "metode";
                }
            });
        }
    }
</script>
@stop