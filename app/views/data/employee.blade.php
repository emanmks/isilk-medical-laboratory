@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - DataTables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-user"></i>
        Pegawai
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('pegawai') }}"><i class="active"></i> Pegawai</a></li>
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
                <button class="btn btn-flat btn-success" onClick="showFormCreate()" data-toggle="tooltip" data-placement="left" title="Pegawai Baru"><i class="fa fa-plus"></i></button>
            </div>
        </div>
            
        @foreach(array_chunk($employees->getCollection()->all(), 3) as $row)
            <div class="row">
                @foreach($row as $employee)
                    <div class="col-lg-4">
                        <center>
                            <h1 class="text-primary">
                                <i class="fa fa-user"></i>
                                <small>
                                    @if($employee->doctor == 1)
                                        <i class="fa fa-stethoscope"></i>
                                    @endif
                                </small>
                            </h1>
                            <strong class="text-primary">{{ $employee->name }}</strong><br/>
                            <small class="text-success">{{ $employee->code }}</small><br/>
                            <small>
                                @if($employee->education == '')
                                    Tidak Jelas
                                @else
                                    {{ $employee->education }}
                                @endif
                            </small>
                            <br/>
                            <a href="#" onclick="showFormUpdate({{ $employee->id }})"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Koreksi"></i></a>&nbsp;
                            <a href="#" class="text-danger" onclick="destroy({{ $employee->id }})"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></i></a>&nbsp;
                            @if($employee->doctor == 0)
                                <a href="#" class="text-success" onclick="isDocter({{ $employee->id }})"><i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="right" title="Dokter"></i></a>
                            @else
                                <a href="#" class="text-danger" onclick="notDocter({{ $employee->id }})"><i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="right" title="Bukan Dokter"></i></a>
                            @endif
                            <input type="hidden" id="name-{{ $employee->id }}" value="{{ $employee->name }}">
                            <input type="hidden" id="code-{{ $employee->id }}" value="{{ $employee->code }}">
                            <input type="hidden" id="education-{{ $employee->id }}" value="{{ $employee->education }}">
                        </center>
                    </div>
                @endforeach
            </div>
        @endforeach

        <center>{{ $employees->links() }}</center>
    </div>
</section>

<!-- Form Add Employee [modal]
===================================== -->
<div id="formCreate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" role="dialog" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Pegawai Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputCode">ID / NIP</label>
                        <div class="col-sm-6">
                            <input id="inputCode" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputName">Nama Lengkap</label>
                        <div class="col-sm-7">
                            <input id="inputName" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputEducation">Pendidikan</label>
                        <div class="col-sm-7">
                            <input id="inputEducation" class="form-control" type="text">
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
<!-- End of Add EMployee [modal] -->

<!-- Form Update Employee [modal]
===================================== -->
<div id="formUpdate" class="modal fade" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Update Pegawai</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputUCode">ID / NIP</label>
                        <div class="col-sm-6">
                            <input type="hidden" id="inputID">
                            <input id="inputUCode" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputUName">Nama Lengkap</label>
                        <div class="col-sm-7">
                            <input id="inputUName" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputUEducation">Pendidikan</label>
                        <div class="col-sm-7">
                            <input id="inputUEducation" class="form-control" type="text">
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
<!-- End of Update Employee [modal] -->

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/datatables/dataTables.bootstrap.js') }}

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
        $('#inputCode').val('');
        $('#inputName').val('');
        $('#inputEducation').val('');
    }

    function showFormUpdate(id)
    {
        $('#formUpdate').modal('show');
        $('#inputID').val(id);
        $('#inputUCode').val($('#code-'+id).val());
        $('#inputUName').val($('#name-'+id).val());
        $('#inputUEducation').val($('#education-'+id).val());
    }

    function create()
    {
        var code = $('#inputCode').val();
        var name = $('#inputName').val();
        var education = $('#inputEducation').val();

        if(code != '' && name != ''){
            $.ajax({
                url:'pegawai',
                type:'POST',
                data:{code : code, name : name, education : education},
                success:function(){
                    window.location = "pegawai";
                }
            });
        }else{
            window.alert('Anda belum melengkapi data');
        }
    }

    function update()
    {
        var id = $('#inputID').val();
        var code = $('#inputUCode').val();
        var name = $('#inputUName').val();
        var education = $('#inputUEducation').val();

        if(id != 0 && code != '' && name != ''){
            $.ajax({
                url:'pegawai/'+id,
                type:'PUT',
                data:{code : code, name : name, education : education},
                success:function(){
                    window.location = "pegawai";
                }
            });
        }else{
            window.alert('Anda belum melengkapi data');
        }
    }

    function isDocter(id)
    {
        if(confirm('Betul Pegawai ini adalah seorang Dokter?!'))
        {
            $.ajax({
                url:'pegawai/'+id+'/isdoctor',
                type:'PUT',
                success:function(){
                    window.location = "pegawai";
                }
            });
        }
    }

    function notDocter(id)
    {
        if(confirm('Betul Pegawai ini bukan seorang Dokter?!'))
        {
            $.ajax({
                url:'pegawai/'+id+'/notdoctor',
                type:'PUT',
                success:function(){
                    window.location = "pegawai";
                }
            });
        }
    }
    
    function destroy(id)
    {
        if(confirm('Yakin menghapus data ini?!'))
        {
            $.ajax({
                url:'pegawai/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "pegawai";
                }
            });
        }
    }
</script>
@stop