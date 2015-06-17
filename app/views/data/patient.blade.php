@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1>
        Pasien
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="pasien"><i class="active"></i> Pasien</a></li>
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
                    <table class="table table-striped table-bordered table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>ID Pasien</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>TGL Lahir</th>
                                <th>Kontak</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($patients as $patient)
                            <tr>
                                <td>{{ $patient->code }}</td>
                                <td><i class="fa fa-user text-info"></i> {{ $patient->name }}</td>
                                <td>{{ $patient->sex == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ date('Y-m-d', strtotime($patient->birthdate)) }}</td>
                                <td>{{ $patient->phone }}</td>
                                <td>
                                    <input type="hidden" id="code-{{ $patient->id }}" value="{{ $patient->code }}">
                                    <input type="hidden" id="name-{{ $patient->id }}" value="{{ $patient->name }}">
                                    <input type="hidden" id="sex-{{ $patient->id }}" value="{{ $patient->sex }}">
                                    <input type="hidden" id="birthdate-{{ $patient->id }}" value="{{ $patient->birthdate }}">
                                    <input type="hidden" id="address-{{ $patient->id }}" value="{{ $patient->address }}">
                                    <input type="hidden" id="phone-{{ $patient->id }}" value="{{ $patient->phone }}">
                                    <input type="hidden" id="city-{{ $patient->id }}" value="{{ $patient->city_id }}">
                                    <input type="hidden" id="cityname-{{ $patient->id }}" value="{{ $patient->city->name }}">
                                    <div class="mytooltip">
                                        <button type="button" class="btn btn-md btn-primary btn-circle" onclick="showFormUpdate({{ $patient->id }})" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-md btn-danger btn-circle" onclick="destroy({{ $patient->id }})" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o"></i>
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

<!-- Form Add Patient [modal]
===================================== -->
<div id="formCreate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Pasien Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputName">Nama Lengkap</label>
                        <div class="col-lg-8">
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
                        <label class="col-lg-3 control-label" for="inputSex">Jenis Kelamin</label>
                        <div class="col-lg-6">
                            <select id="inputSex" class="form-control">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputBirthDate">TGL Lahir</label>
                        <div class="col-lg-3">
                            <input id="inputBirthDate" class="form-control" type="text" data-provide="datepicker" value="<? echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputPhone">Telepon</label>
                        <div class="col-lg-6">
                            <input id="inputPhone" class="form-control" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputSex">Propinsi Asal</label>
                        <div class="col-lg-7">
                            <select id="inputState" class="form-control" onchange="loadCities()">
                                <option value="0">--Pilih</option>
                                @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputCity">Kota Asal</label>
                        <div class="col-lg-7">
                            <select id="inputCity" class="form-control">
                                <option value="0">--Pilih</option>
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
<!-- End of Add Patient [modal] -->

<!-- Form Update Patient [modal]
===================================== -->
<div id="formUpdate" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Detail Pasien</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUCode">ID Pasien</label>
                        <div class="col-lg-4">
                            <input type="hidden" id="inputID" value="0">
                            <input id="inputUCode" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUName">Nama Lengkap</label>
                        <div class="col-lg-7">
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
                        <label class="col-lg-3 control-label" for="inputUSex">Jenis Kelamin</label>
                        <div class="col-lg-4">
                            <select id="inputUSex" class="form-control">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUBirthDate">TGL Lahir</label>
                        <div class="col-lg-3">
                            <input id="inputUBirthDate" class="form-control" type="text" data-provide="datepicker">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUPhone">Telepon</label>
                        <div class="col-lg-6">
                            <input id="inputUPhone" class="form-control" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUState">Propinsi Asal</label>
                        <div class="col-lg-7">
                            <select id="inputUState" class="form-control" onchange="uLoadCities()">
                                <option value="0">--Pilih</option>
                                @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputUCity">Kota Asal</label>
                        <div class="col-lg-7">
                            <select id="inputUCity" class="form-control">
                                <option value="0">--Pilih</option>
                            </select>
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
<!-- End of Update Patient [modal] -->

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/datatables/dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/AdminLTE/app.js') }}
{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}

<script type="text/javascript">
    $(function(){
        $('#inputBirthDate').datepicker({format: 'yyyy-mm-dd', autoclose : true});
        $('#inputUBirthDate').datepicker({format: 'yyyy-mm-dd', autoclose : true});

        $('#data-table').dataTable();
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });
    })
    
    function showFormCreate()
    {
        $('#formCreate').modal('show');
        $('#inputName').val('');
        $('#inputAddress').val('');
        $('#inputSex').val('');
        $('#inputPhone').val('');
        $('#inputState').val('0');
        $('#inputCity').val('0');
    }
    
    function showFormUpdate(id)
    {
        $('#formUpdate').modal('show');
        $('#inputID').val(id);
        $('#inputUCode').val($('#code-'+id).val());
        $('#inputUName').val($('#name-'+id).val());
        $('#inputUBirthDate').val($('#birthdate-'+id).val());
        $('#inputUAddress').val($('#address-'+id).val());
        $('#inputUSex').val($('#sex-'+id).val());
        $('#inputUPhone').val($('#phone-'+id).val());
        $('#inputUState').val('0');
        $('#inputUCity').append("<option value="+$('#city-'+id).val()+">"+$('#cityname-'+id).val()+"</option>");
        $('#inputUCity').val($('#city-'+id).val());
    }

    function create()
    {
        var name = $('#inputName').val();
        var sex = $('#inputSex').val();
        var birthdate = $('#inputBirthDate').val();
        var address = $('#inputAddress').val();
        var phone = $('#inputPhone').val();
        var city_id = $('#inputCity').val();

        if(name != '' && city_id != '0')
        {
            $.ajax({
                url:'pasien',
                type:'POST',
                data: {name : name, 
                        sex : sex, 
                        birthdate : birthdate, 
                        address : address, 
                        phone : phone,
                        city_id : city_id},
                success:function(){
                    window.location = "pasien";
                }
            });
        }else{
            window.alert('Nama pasien harus jelas');
        }
    }
    
    function update()
    {
        var id          = $('#inputID').val();
        var code        = $('#inputUCode').val();
        var name        = $('#inputUName').val();
        var sex         = $('#inputUSex').val();
        var birthdate   = $('#inputUBirthDate').val();
        var address     = $('#inputUAddress').val();
        var phone       = $('#inputUPhone').val();
        var city_id     = $('#inputUCity').val();

        if(name != '' && city_id != '0')
        {
            $.ajax({
                url:'pasien/'+id,
                type:'PUT',
                data: { code        : code,
                        name        : name, 
                        sex         : sex, 
                        birthdate   : birthdate, 
                        address     : address, 
                        phone       : phone,
                        city_id     : city_id},
                success:function(){
                    window.location = "pasien";
                }
            });
        }else{
            window.alert('Nama pasien harus jelas');
        }
    }
    
    function loadCities()
    {
        var state_id = $('#inputState').val();
        $.post('pasien/carikota/'+state_id, function(data){
            $('#inputCity').html('');
            $('#inputCity').append("<option value='0'>--Pilih</option>");
            for(var i=0; i < data.length; i++)
            {
                $('#inputCity').append("<option value="+data[i].id+">"+data[i].name+"</option>");
            }
        },'json');
    }
    
    function uLoadCities()
    {
        var state_id = $('#inputUState').val();
        $.post('pasien/carikota/'+state_id, function(data){
            $('#inputUCity').html('');
            $('#inputUCity').append("<option value='0'>--Pilih</option>");
            for(var i=0; i < data.length; i++)
            {
                $('#inputUCity').append("<option value="+data[i].id+">"+data[i].name+"</option>");
            }
        },'json');
    }

    function destroy(id)
    {
        if(confirm('Yakin akan menghapus data ini?!'))
        {
            $.ajax({
                url:'pasien/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "pasien";
                }
            });
        }
    }
</script>
@stop