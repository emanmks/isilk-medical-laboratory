@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Jenis Pemeriksaan</h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ URL::to('pemeriksaan') }}"><i class="active"></i> Jenis Pemeriksaan</a></li>
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
            <div class="text-right">
                <button class="btn btn-flat btn-success" data-toggle="tooltip" data-placement="left" title="Tambahkan Bidang Pemeriksaan" onclick="showFormCreate()"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
    
    @foreach(array_chunk($classifications->all(), 4) as $rows)

        <div class="row">
            
            @foreach($rows as $classification)

                <div class="col-lg-3">

                    <div class="thumb-menu">

                        <h1 class="text-navy"><i class="fa fa-medkit"></i></h1>

                        <a href="#" data-toggle="tooltip" data-placement="left" title="Edit" onclick="showFormUpdate({{ $classification->id }})"><i class="fa fa-edit"></i></a>&nbsp;
                        
                        <a href="#" onclick="destroy()" data-toggle="tooltip" data-placement="right" title="Hapus" class="text-danger"><i class="fa fa-trash-o"></i></a><br/>
                        
                        <a href="{{ URL::to('klasifikasi') }}/{{ $classification->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Detail Kelompok Pemeriksaan">{{ $classification->code }} | {{ $classification->name }}</a><br/>

                        <input type="hidden" id="name-{{ $classification->id }}" value="{{ $classification->name }}">

                    </div>

                </div>

            @endforeach

        </div>

    @endforeach
    
</section>

<!-- Form Add Parent Classification [modal]
===================================== -->
<div id="formCreate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Bidang Pemeriksaan Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="name">Nama Bidang Pemeriksaan</label>
                        <div class="col-lg-7">
                            <input name="name" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="create()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Parent Classification [modal] -->

<!-- Form Update Parent Classification [modal]
===================================== -->
<div id="formUpdate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Update Bidang Pemeriksaan</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="updated_name">Nama Bidang Pemeriksaan</label>
                        <div class="col-lg-7">
                            <input name="updated_id" type="hidden" value="0">
                            <input name="updated_name" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="update()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Update Parent Classification [modal] -->

<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function showFormCreate()
    {
        $('#formCreate').modal('show');
        $('[name=name]').val('');
    }

    function showFormUpdate(id)
    {
        $('#formUpdate').modal('show');
        $('[name=updated_id]').val(id);
        $('[name=updated_name]').val($('#name-'+id).val());
    }

    function create()
    {
        var name = $('[name=name]').val();

        if(name != '')
        {
            $.ajax({
                url:"{{ URL::to('klasifikasi') }}",
                type:'POST',
                data:{name:name, parent_id:0},
                success:function(){
                    window.location = "{{ URL::to('pemeriksaan') }}";
                }
            });
        }
        else
        {
           window.alert('Nama Kelompok Pemeriksaan Harus Jelas');
        }
    }

    function update()
    {
        var id = $('[name=updated_id]').val();
        var name = $('[name=updated_name]').val();

        if(id != '0' && name != '')
        {
            $.ajax({
                url:"{{ URL::to('klasifikasi') }}/"+id,
                type:'PUT',
                data:{name:name},
                success:function(){
                    window.location = "{{ URL::to('pemeriksaan') }}";
                }
            });
        }
        else
        {
            window.alert('Nama Kelompok Pemeriksaan Harus Jelas');
        }
    }
    
    function destroy(id)
    {
        if(confirm('Yakin menghapus data ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('klasifikasi') }}"+id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('klasifikasi') }}";
                }
            });
        }
    }
</script>

@stop