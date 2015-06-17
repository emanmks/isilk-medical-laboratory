@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->


<section class="content-header">
    <h1>
        <i class="fa fa-hospital-o"></i>
        Instalasi
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('instalasi') }}"><i class="active"></i> Instalasi</a></li>
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
                <button class="btn btn-flat btn-success" onClick="showFormCreate()" data-toggle="tooltip" data-placement="left" title="Instalasi Baru"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        @foreach(array_chunk($installations->getCollection()->all(), 3) as $row)
            <div class="row">
                @foreach($row as $installation)
                    <div class="col-lg-4">
                        <center>
                            <h1 class="text-primary">
                                <i class="fa fa-hospital-o"></i>
                            </h1>
                            
                            <a href="{{ URL::to('instalasi') }}/{{ $installation->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Detail">{{ $installation->name }}</a><br/>

                            <a href="#" onclick="showFormUpdate({{ $installation->id }})"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Koreksi"></i></a>&nbsp;

                            <a href="#" class="text-danger" onclick="destroy({{ $installation->id }})"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></i></a>&nbsp;

                            <input type="hidden" id="name-{{ $installation->id }}" value="{{ $installation->name }}">
                        </center>
                    </div>
                @endforeach
            </div>
        @endforeach

        <center>{{ $installations->links() }}</center>
    </div>
</section>

<!-- Form Add Installation [modal]
===================================== -->
<div id="formCreate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Instalasi Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">Nama Instalasi</label>
                        <div class="col-sm-7">
                            <input name="name" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="store()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Installation [modal] -->

<!-- Form Update Installation [modal]
===================================== -->
<div id="formUpdate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Detail Instalasi</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="updated_name">Nama Instalasi</label>
                        <div class="col-lg-7">
                            <input type="hidden" name="installation_id">
                            <input name="updated_name" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="update()" data-dismiss="modal" aria-hidden="true">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Update Installation [modal] -->

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
        $('[installation_id]').val(id);
        $('[name=updated_name]').val($('#name-'+id).val());
    }

    function store()
    {
        var name = $('[name=name]').val();

        if(name != '')
        {
            $.ajax({
                url:"{{ URL::to('instalasi') }}",
                type:'POST',
                data:{name : name},
                success:function(){
                    window.location = "{{ URL::to('instalasi') }}";
                }
            });
        }
        else
        {
            window.alert('Data tidak lengkap!!!');
        }
    }
    
    function update()
    {
        var id = $('[name=installation_id]').val();
        var name = $('[name=updated_name]').val();

        $.ajax({
            url:"{{ URL::to('instalasi') }}/"+id,
            type:'PUT',
            data:{name : name},
            success:function(data){
                window.location = "{{ URL::to('instalasi') }}";
            }
        });
    }
    
    function destroy(id)
    {
        if(confirm('Yakin, akan menghapus instalasi ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('instalasi') }}/"+id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('instalasi') }}";
                }
            });
        }
    }
</script>
@stop