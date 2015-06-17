@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-user"></i>
        Data User
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('user') }}"><i class="active"></i> User</a></li>
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
            
        @foreach(array_chunk($users->getCollection()->all(), 4) as $row)
            <div class="row">
                @foreach($row as $user)
                    <div class="col-lg-3">
                        <center>
                            <h1 class="text-primary">
                                <i class="fa fa-user"></i>
                            </h1>
                            <strong class="text-primary">{{ $user->username }}</strong><br/>
                            <strong class="text-success">{{ $user->employee->name }}</strong><br/>
                            <small>{{ $user->role }}</small>
                            <br/>
                            <a href="#" class="text-danger" onclick="destroy({{ $user->id }})"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></i></a>&nbsp;
                        </center>
                    </div>
                @endforeach
            </div>
        @endforeach

        <center>{{ $users->links() }}</center>
    </div>
</section>

<!-- Form Add user [modal]
===================================== -->
<div id="formCreate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" role="dialog" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">User Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputUsername">Username</label>
                        <div class="col-sm-6">
                            <input id="inputUsername" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputPassword">Password</label>
                        <div class="col-sm-7">
                            <input id="inputPassword" class="form-control" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputRole">Level User</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="inputRole">
                                <option value="">--Pilih Level</option>
                                <option value="admin">Administrator</option>
                                <option value="operator">User Biasa</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputEmployee">Pegawai</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="inputEmployee">
                                <option value="0">--Pilih Pegawai</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
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
<!-- End of Add user [modal] -->

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
        $('#inputUsername').val('');
        $('#inputPassword').val('');
        $('#inputRole').val('');
        $('#inputEmployee').val('0');
    }

    function create()
    {
        var username = $('#inputUsername').val();
        var password = $('#inputPassword').val();
        var role = $('#inputRole').val();
        var employee = $('#inputEmployee').val();

        if(username != '' && password != '' && role != '' && employee != '0'){
            $.ajax({
                url:'user',
                type:'POST',
                data:{username : username, password : password, role : role, employee_id : employee},
                success:function(){
                    window.location = "user";
                }
            });
        }else{
            window.alert('Anda belum melengkapi data');
        }
    }
    
    function destroy(id)
    {
        if(confirm('Yakin menghapus data ini?!'))
        {
            $.ajax({
                url:'user/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "user";
                }
            });
        }
    }
</script>
@stop