@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        Klasifikasi Jenis Pemeriksaan
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Pemeriksaan</a></li>
        <li><a href="klasifikasi"><i class="active"></i> Klasifikasi</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif

            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">
                        <button class="btn btn-flat btn-success" onClick="showFormCreate()">Klasifikasi Baru <i class="fa fa-plus"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @foreach($installations as $installation)
                                <li id="tab-{{ $installation->code }}"><a href="#content-{{ $installation->code }}" data-toggle="tab">{{ $installation->code }} | {{ $installation->name }}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($installations as $installation)
                                @if($installation->id == 1)
                                    <div class="tab-pane fade in active" id="content-{{ $installation->code }}">
                                @else
                                    <div class="tab-pane fade" id="content-{{ $installation->code }}">
                                @endif
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode Klasifikasi</th>
                                                <th>Nama Klasifikasi</th>
                                                <th>Layanan-Layanan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($installation->classifications as $classification)
                                                @if($classification->installation_id == $installation->id)
                                                <tr>
                                                    <td><span class="label label-info">{{ $classification->code }}</span></td>
                                                    <td>{{ $classification->name }}</td>
                                                    <td><a class="btn btn-xs btn-primary" href="{{ URL::to('klasifikasi') }}/{{ $classification->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Layanan">Lihat Layanan</a></td>
                                                    <td>
                                                        <input type="hidden" id="code-{{ $classification->id }}" value="{{ $classification->code }}">
                                                        <input type="hidden" id="name-{{ $classification->id }}" value="{{ $classification->name }}">
                                                        <div class="mytooltip">
                                                            <button class="btn btn-circle btn-flat btn-primary" onclick="showFormUpdate({{ $classification->id }})" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                            <button class="btn btn-circle btn-flat btn-danger" onclick="destroy({{ $classification->id }})" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form Add Classification [modal]
===================================== -->
<div id="formCreate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Klasifikasi Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputInstallation">Pilih Instalasi</label>
                        <div class="col-lg-7">
                            <select id="inputInstallation" class="form-control">
                                <option value="">--Pilih</option>
                                @foreach($installations as $installation)
                                <option value="{{ $installation->id }}">{{ $installation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputName">Nama Klasifikasi</label>
                        <div class="col-lg-7">
                            <input id="inputName" class="form-control" type="text">
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
<!-- End of Add classification [modal] -->

<!-- Form Update classification [modal]
===================================== -->
<div id="formUpdate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Edit Klasifikasi</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUCode">Kode Klasifikasi</label>
                        <div class="col-lg-3">
                            <input id="inputUCode" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUName">Nama Klasifikasi</label>
                        <div class="col-lg-7">
                            <inpu type="hidden" id="inputID">
                            <input id="inputUName" class="form-control" type="text">
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
<!-- End of Add classification [modal] -->

<script type="text/javascript">

    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function showFormCreate(installation)
    {
        $('#formCreate').modal('show');
        $('#inputCode').val('');
        $('#inputName').val('');
        $('#inputInstallation').val(installation);
    }

    function showFormUpdate(id)
    {
        $('#formUpdate').modal('show');
        $('#inputID').val(id);
        $('#inputUCode').val($('#code-'+id).val());
        $('#inputUName').val($('#name-'+id).val());
    }

    function create()
    {
        var name = $('#inputName').val();
        var installation_id = $('#inputInstallation').val();

        if(name != '')
        {
            $.ajax({
                url:'klasifikasi',
                type:'POST',
                data:{name:name, installation_id:installation_id},
                success:function(){
                    window.location = "klasifikasi";
                }
            });
        }
        else
        {
            window.alert('Nama klasifikasi harus jelas!');
        }
    }

    function update()
    {
        var id = $('#inputID').val();
        var code = $('#inputUCode').val();
        var name = $('#inputUName').val();
        var installation_id = $('#inputUInstallation').val();

        if(id != 0 && name != '')
        {
            $.ajax({
                url:'klasifikasi/'+id,
                type:'PUT',
                data:{code:code,name:name,installation_id:installation_id},
                success:function(){
                    window.location = "klasifikasi";
                }
            });
        }
        else
        {
            window.alert('Nama klasifikasi harus jelas!');
        }
    }
    
    function destroy(id)
    {
        if(confirm('Yakin akan menghapus data ini?!'))
        {
            $.ajax({
                url:'klasifikasi/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "klasifikasi";
                }
            });
        }
    }
</script>
@stop