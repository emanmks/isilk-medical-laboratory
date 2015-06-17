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
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
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
                <button class="btn btn-flat btn-success" onClick="showFormCreate()" data-toggle="tooltip" data-placement="left" title="Instansi Baru"><i class="fa fa-plus"></i></button>
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
                            <strong class="text-primary">{{ $office->name }}</strong><br/>
                            <small><i class="fa fa-road"></i> {{ $office->address }}</small><br/>
                            <small><i class="fa fa-phone"></i> {{ $office->phone }}</small><br/>
                            <small><i class="fa fa-fax"></i> {{ $office->fax }}</small><br/>
                            <a href="#" onclick="showFormUpdate({{ $office->id }})"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Koreksi"></i></a>&nbsp;
                            <a href="#" class="text-danger" onclick="destroy({{ $office->id }})"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></i></a>&nbsp;
                            <input type="hidden" id="name-{{ $office->id }}" value="{{ $office->name }}">
                            <input type="hidden" id="address-{{ $office->id }}" value="{{ $office->address }}">
                            <input type="hidden" id="phone-{{ $office->id }}" value="{{ $office->phone }}">
                            <input type="hidden" id="fax-{{ $office->id }}" value="{{ $office->fax }}">
                        </center>
                    </div>
                @endforeach
            </div>
        @endforeach

        <center>{{ $offices->links() }}</center>
    </div>
</section>

<!-- Form Add Office [modal]
===================================== -->
<div id="formCreate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Instansi Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputName">Nama Instansi</label>
                        <div class="col-lg-7">
                            <input id="inputName" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputAddress">Alamat</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" id="inputAddress"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputPhone">Telepon</label>
                        <div class="col-lg-6">
                            <input id="inputPhone" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputFax">Fax</label>
                        <div class="col-lg-6">
                            <input id="inputFax" class="form-control" type="text">
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
<!-- End of Add Office [modal] -->

<!-- Form Update Office [modal]
===================================== -->
<div id="formUpdate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Update Instansi</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUName">Nama Instansi</label>
                        <div class="col-lg-7">
                            <input type="hidden" id="inputID">
                            <input id="inputUName" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUAddress">Alamat</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" id="inputUAddress"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUPhone">Telepon</label>
                        <div class="col-lg-6">
                            <input id="inputUPhone" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUFax">Fax</label>
                        <div class="col-lg-6">
                            <input id="inputUFax" class="form-control" type="text">
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
<!-- End of Update Office [modal] -->

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