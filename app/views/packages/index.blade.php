@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Paket Pemeriksaan</h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ URL::to('paket') }}"><i class="active"></i> Paket Pemeriksaan</a></li>
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
            <div class="text-right">
                <a class="btn btn-flat btn-success" href="{{ URL::to('paket/create') }}" data-toggle="tooltip" data-placement="left" title="Tambahkan Paket Pemeriksaan Baru"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>

    @foreach(array_chunk($packages->all(), 4) as $rows)

        <div class="row">
            
            @foreach($rows as $package)

                <div class="col-lg-3">
                    <div class="thumb-menu">
                        <h1 class="text-navy"><i class="fa fa-medkit"></i></h1>
                        <a href="#" onclick="showFormUpdate({{ $package->id }})" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                        <a href="#" onclick="destroy({{ $package->id }})" data-toggle="tooltip" data-placement="right" title="Hapus" class="text-danger"><i class="fa fa-trash-o"></i></a><br/>
                        <strong><a href="{{ URL::to('paket') }}/{{ $package->id }}" data-toggle="tooltip" data-placement="top" title="Detail Paket Pemeriksaan">{{ $package->name }}</a></strong><br/>
                        <span class="text-warning">Rp{{ number_format($package->price,2,",",".") }}</span>

                        <input type="hidden" id="name-{{ $package->id }}" value="{{ $package->name }}">
                        <input type="hidden" id="price-{{ $package->id }}" value="{{ number_format($package->price,2,",",".") }}">
                    </div>
                </div>

            @endforeach

        </div>

    @endforeach

</section>

<!-- Form Update package [modal]
===================================== -->
<div id="formUpdate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Edit package</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="updated_name">Nama Paket</label>
                        <div class="col-lg-7">
                            <input name="updated_name" class="form-control" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="updated_price">Tarif</label>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input name="updated_price" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="update({{ $package->id }})" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Update package [modal] -->

<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">

    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

        $('[name=updated_price]').keyup(function(){
            $(this).val(formatCurrency($(this).val()));
        });
    });

    function showFormUpdate(id)
    {
        $('#formUpdate').modal('show');
        $('[name=updated_name]').val($('#name-'+id).val());
        $('[name=updated_price]').val($('#price-'+id).val());
    }

    function update(id)
    {
        var name = $('[name=updated_name]').val();
        var price = $('[name=updated_price]').val();

        if(name)
        {
            $.ajax({
                url:"{{ URL::to('paket') }}/"+id,
                type:'PUT',
                data:{name:name,price:price},
                success:function(){
                    window.location = "{{ URL::to('paket') }}";
                }
            });
        }
        else
        {
            window.alert('Input Belumg Lengkap!');
        }
    }
    
    function destroy(id)
    {
        if(confirm('Yakin akan menghapus data ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('paket') }}/"+id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('paket') }}";
                }
            });
        }
    }
</script>
@stop