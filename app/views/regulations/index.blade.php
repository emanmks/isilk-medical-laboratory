@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        <i class="fa fa-gears"></i>
        Referensi
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('referensi') }}"><i class="active"></i> Referensi</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <a href="{{ URL::to('referensi') }}/create" class="btn btn-flat btn-success" data-toggle="tooltip" data-placement="left" title="Tambahkan Regulasi / Peraturan / Standarisasi"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>

    @foreach(array_chunk($regulations->all(), 4) as $rows)

        <div class="row">
            
            @foreach($rows as $regulation)

                <div class="col-lg-3">
                    <div class="thumb-menu">
                        <h1 class="text-navy"><i class="fa fa-gears"></i></h1>
                        <a href="{{ URL::to('referensi') }}/{{ $regulation->id }}/edit" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                        <a href="#" onclick="destroy({{ $regulation->id }})" data-toggle="tooltip" data-placement="right" title="Hapus" class="text-danger"><i class="fa fa-trash-o"></i></a><br/>
                        <a href="{{ URL::to('referensi') }}/{{ $regulation->id }}" data-toggle="tooltip" data-placement="top" title="Detail">{{ $regulation->name }}</a><br/>
                    </div>
                </div>

            @endforeach

        </div>

    @endforeach

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
                url:'referensi/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "referensi";
                }
            });
        }
    }
</script>
@stop