@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}

<section class="content-header">
    <h1>
        Metode Pengujian
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="metode"><i class="active"></i> Metode</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @if(Session::has('message'))
            <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <button class="btn btn-flat btn-success" onClick="showFormCreate()">Tambah Baru <i class="fa fa-plus"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($methods as $method)
                        <tr id="data-{{ $method->id }}">
                                <td><strong>{{ $method->name }}</strong></td>
                                <td>{{ $method->description }}</td>
                                <td>
                                    <input type="hidden" id="name-{{ $method->id }}" value="{{ $method->name }}">
                                    <input type="hidden" id="desc-{{ $method->id }}" value="{{ $method->description }}">
                                    <div class="mytooltip">
                                        <button type="button" class="btn btn-primary btn-circle" onclick="showFormUpdate({{ $method->id }})" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-circle" onclick="destroy({{ $method->id }})" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form Add method [modal]
===================================== -->
<div id="formCreate" class="modal fade" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Data Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputName">Nama/Judul</label>
                        <div class="col-lg-7">
                            <input id="inputName" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputDescription">Penjelasan</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" id="inputDescription"></textarea>
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
<!-- End of Add method [modal] -->

<!-- Form Update method [modal]
===================================== -->
<div id="formUpdate" class="modal fade" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Edit Detail</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUName">Nama/Judul</label>
                        <div class="col-lg-7">
                            <inpu type="hidden" id="inputID">
                            <input id="inputUName" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUDescription">Penjelasan</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" id="inputUDescription"></textarea>
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
<!-- End of Update method [modal] -->

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
    }

    function showFormUpdate(id)
    {
        $('#formUpdate').modal('show');
        $('#inputID').val(id);
        $('#inputUName').val($('#name-'+id).val());
        $('#inputUDescription').val($('#desc-'+id).val());
    }

    function create()
    {
        var name = $('#inputName').val();
        var description = $('#inputDescription').val();

        if(name != ''){
            $.ajax({
                url:'metode',
                type:'POST',
                data:{name : name, description : description},
                success:function(){
                    window.location = "metode";
                }
            });
        }else{
            window.alert('Nama harus jelas');
        }
    }

    function update()
    {
        var id = $('#inputID').val();
        var name = $('#inputUName').val();
        var description = $('#inputUDescription').val();

        if(name != ''){
            $.ajax({
                url:'metode/'+id,
                type:'PUT',
                data:{name : name, description : description},
                success:function(){
                    window.location = "metode";
                }
            });
        }else{
            window.alert('Nama harus jelas');
        }
    }
    
    function destroy(id)
    {
         if(confirm('Yakin akan menghapus data ini?!'))
        {
            $.ajax({
                url:'metode/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "metode";
                }
            });
        }
    }
</script>
@stop