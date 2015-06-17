@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/plugins/dataTables/dataTables.bootstrap.css') }}
{{ HTML::style('assets/css/plugins/scrollpane/jquery.jscrollpane.css') }}
{{ HTML::style('assets/css/datepicker.css') }}
{{ HTML::style('assets/css/plugins/social-buttons/social-buttons.css') }}


<!-- Main Row 
=============================================== -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">Pendaftaran</h4>
        </div>
    </div>
        
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Pasien
                </div>

                <div class="panel-body" style="height:525px">
                    <div class="row">
                        <div class="col-md-6">Nomor Lab</div>
                        <div class="col-md-6" id="labNum">
                            <div class="text-right"><strong class="label label-success">Automatic</strong></div>
                        </div>
                    </div>

                    <br>

                    <input type="text" id="inputRecommender" class="form-control" placeholder="Direkomendasikan/Dikirim Oleh">

                    <br>
                    
                    <ul class="nav nav-pills">
                        <li id="personalTab" class="active"><a href="#personal" data-toggle="tab">Individu</a></li>
                        <li id="officeTab"><a href="#office" data-toggle="tab">Instansi/Perusahaan</a></li>
                    </ul>
                    <br> 
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="personal">
                            <div class="form-group input-group">
                                <input type="hidden" id="inputPatientID" value="0">
                                <input id="inputPatientCode" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <div class="mytooltip">
                                        <button class="btn btn-default" type="button" onclick="showFormFindPatient()" data-toggle="tooltip" data-placement="top" title="Cari">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-default" type="button" onclick="showFormNewPatient()" data-toggle="tooltip" data-placement="top" title="Baru">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </span>
                            </div>
                            
                            <div class="form-group input-group">
                                <input id="inputPatientName" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-user"></i>
                                    </button>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input id="inputPatientSex" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-group"></i>
                                    </button>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input id="inputPatientAddress" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-road"></i>
                                    </button>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input id="inputPatientBirthDate" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input id="inputPatientPhone" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-phone"></i>
                                    </button>
                                </span>
                            </div>
                            
                            <div class="form-group input-group">
                                <input id="inputPatientCity" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-map-marker"></i>
                                    </button>
                                </span>
                            </div>
                        </div>  

                        <div class="tab-pane fade" id="office">
                            <div class="form-group input-group">
                                <input type="hidden" id="inputOfficeID" value="0">
                                <input id="inputOfficeName" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <div class="mytooltip">
                                        <button class="btn btn-default" type="button" onclick="showFormFindOffice()" data-toggle="tooltip" data-placement="top" title="Cari">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-default" type="button" onclick="showFormNewOffice()" data-toggle="tooltip" data-placement="top" title="Baru">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </span>
                            </div>
                            
                            <div class="form-group input-group">
                                <input id="inputOfficeAddress" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-road"></i>
                                    </button>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input id="inputOfficePhone" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-phone"></i>
                                    </button>
                                </span>
                            </div>

                            <div class="form-group input-group">
                                <input id="inputOfficeFax" class="form-control" type="text" disabled>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-phone"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4" id="servPanel">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Layanan
                </div>

                <div class="panel-body" style="overflow: scroll; height:525px;">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <span class="panel-title">
                                    <a href="#collapsePacket" data-toggle="collapse" data-parent="#accordion">
                                        Paket Pemeriksaan
                                    </a>
                                </span>
                            </div>
                            <div id="collapsePacket" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    @foreach($packages as $package)
                                        <input type="hidden" id="packageID-{{ $package->id }}" value="{{ $package->id }}">
                                        <input type="hidden" id="packageName-{{ $package->id }}" value="{{ $package->name }}">
                                        <?php $specimentname = '' ?>
                                        @foreach($package->speciments as $speciment)
                                            <?php $specimentname .= ' '.$speciment->name ?>
                                        @endforeach
                                        <input type="hidden" id="specimentName-{{ $package->id }}" value="{{ $specimentname }}">
                                        <input type="hidden" id="packagePrice-{{ $package->id }}" value="{{ $package->price }}">

                                        <a href="#" class="btn btn-block btn-social btn-twitter btn-xs" onclick="takePackage({{ $package->id }})">
                                            <i class="fa fa-medkit"></i> {{ $package->name }} 
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @foreach($installations as $installation)
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <span class="panel-title">
                                    <a href="#collapse-{{ $installation->id }}" data-toggle="collapse" data-parent="#accordion">
                                        {{ ucfirst(strtolower($installation->name)) }}
                                    </a>
                                </span>
                            </div>
                            <div id="collapse-{{ $installation->id }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    @foreach($classifications as $classification)
                                        @if($classification->installation->name == $installation->name)
                                            <strong class="text-info">{{ ucfirst(strtolower($classification->name)) }}</strong><br>
                                            @foreach($classification->services as $service)
                                                <input type="hidden" id="serviceID-{{ $service->id }}" value="{{ $service->id }}">
                                                <input type="hidden" id="serviceName-{{ $service->id }}" value="{{ $service->name }}">
                                                <input type="hidden" id="serviceSpecimentName-{{ $service->id }}" value="{{ $service->speciment->name }}">
                                                <input type="hidden" id="servicePrice-{{ $service->id }}" value="{{ $service->price }}">

                                                <a class="btn btn-block btn-social btn-twitter btn-xs" onclick="takeService({{ $service->id }})" href="#">
                                                <i class="fa fa-medkit"></i> {{ $service->name }}
                                                </a>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4" id="labPanel">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Laboratorium
                </div>

                <div class="panel-body" style="overflow: scroll; height:525px;">
                    <div class="list-group" id="listService">
                        
                    </div>

                    <button onclick="checkArray()">Cekidot</button>

                    <label class="control-label" for="inputRepetition">Jumlah Pemeriksaan</label>
                    <div class="form-group input-group">
                        <input id="inputRepetition" class="form-control" type="text" value="1" disabled>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="createRepetition()"><i class="fa fa-plus"></i>
                            </button>
                        </span>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="inputCosts">Biaya</label>
                        <input type="text" id="inputCosts" value="0" class="form-control">
                    </div>

                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            
        </div>
    </div>
</div>

<!-- Form Find Patient [modal]
===================================== -->
<div id="formFindPatient" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Cari Pasien</h3>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="patient-table">
                        <thead>
                            <tr>
                                <th>ID Pasien</th>
                                <th>Nama Lengkap</th>
                                <th>Kota</th>
                                <th width="10%">Ambil</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($patients as $patient)
                            <tr>
                                <td>{{ $patient->code }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->city->name }}</td>
                                <td>
                                    <input type="hidden" id="patient_code-{{ $patient->id }}" value="{{ $patient->code }}">
                                    <input type="hidden" id="patient_name-{{ $patient->id }}" value="{{ $patient->name }}">
                                    <input type="hidden" id="patient_sex-{{ $patient->id }}" value="{{ $patient->sex }}">
                                    <input type="hidden" id="patient_birthdate-{{ $patient->id }}" value="{{ $patient->birthdate }}">
                                    <input type="hidden" id="patient_address-{{ $patient->id }}" value="{{ $patient->address }}">
                                    <input type="hidden" id="patient_phone-{{ $patient->id }}" value="{{ $patient->phone }}">
                                    <input type="hidden" id="patient_city-{{ $patient->id }}" value="{{ $patient->city->name }}">
                                    <button type="button" class="btn btn-primary btn-circle" onclick="takePatient({{ $patient->id }})" data-dismiss="modal" aria-hidden="true"><i class="fa fa-arrow-right"></i>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
<!-- End of Find Patient [modal] -->

<!-- Form Find Office [modal]
===================================== -->
<div id="formFindOffice" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Cari Pasien</h3>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>Nama Instansi</th>
                                    <th>Alamat</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($offices as $office)
                                <tr id="data-{{ $office->id }}">
                                    <td><strong>{{ $office->name }}</strong></td>
                                    <td>{{ $office->address }}</td>
                                    <td>
                                        <input type="hidden" id="office_name-{{ $office->id }}" value="{{ $office->name }}">
                                        <input type="hidden" id="office_address-{{ $office->id }}" value="{{ $office->address }}">
                                        <input type="hidden" id="office_phone-{{ $office->id }}" value="{{ $office->phone }}">
                                        <input type="hidden" id="office_fax-{{ $office->id }}" value="{{ $office->fax }}">
                                        <div class="mytooltip">
                                            <button type="button" class="btn btn-primary btn-circle" onclick="takeOffice({{ $office->id }})" data-dismiss="modal" aria-hidden="true"><i class="fa fa-arrow-right"></i>
                                        </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>

            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
<!-- End of Find Office [modal] -->

<!-- Form Add Office [modal]
===================================== -->
<div id="formCreateOffice" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Instansi Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="newOfficeName">Nama Instansi</label>
                        <div class="col-lg-7">
                            <input id="newOfficeName" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="newOfficeAddress">Alamat</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" id="newOfficeAddress"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="newOfficePhone">Telepon</label>
                        <div class="col-lg-6">
                            <input id="newOfficePhone" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="newOfficeFax">Fax</label>
                        <div class="col-lg-6">
                            <input id="newOfficeFax" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="createOffice()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Office [modal] -->

<!-- Form Add Patient [modal]
===================================== -->
<div id="formCreatePatient" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Pasien Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="newPatientName">Nama Lengkap</label>
                        <div class="col-lg-8">
                            <input id="newPatientName" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="newPatientAddress">Alamat</label>
                        <div class="col-lg-8">
                            <textarea class="form-control" id="newPatientAddress"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="newPatientSex">Jenis Kelamin</label>
                        <div class="col-lg-6">
                            <select id="newPatientSex" class="form-control">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="newPatientBirthDate">TGL Lahir</label>
                        <div class="col-lg-6">
                            <input id="newPatientBirthDate" class="form-control" type="text" data-provide="datepicker" value="<? echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="newPatientPhone">Telepon</label>
                        <div class="col-lg-6">
                            <input id="newPatientPhone" class="form-control" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="inputState">Propinsi Asal</label>
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
                        <label class="col-lg-3 control-label" for="newPatientCity">Kota Asal</label>
                        <div class="col-lg-7">
                            <select id="newPatientCity" class="form-control">
                                <option value="0">--Pilih</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="createPatient()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Patient [modal] -->

<!-- Form Select Method & Regulation [modal]
===================================== -->
<div id="formSelect" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Pilih Regulasi dan Metode</h3>
            </div>

            <div class="modal-body">
               <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="selectRegulation">Pilih Regulasi</label>
                        <div class="col-lg-7">
                            <select id="selectRegulation" class="form-control">
                                <option value="0">--Pilih</option>
                                @foreach($regulations as $regulation)
                                    <option value="{{ $regulation->id }}">{{ $regulation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="selectMethod">Pilih Metode</label>
                        <div class="col-lg-7">
                            <select id="selectMethod" class="form-control">
                                <option value="0">--Pilih</option>
                                @foreach($methods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <p class="label label-danger">Hanya diisi jika ada permintaan khusus dari Pasien/Costumer</p>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true" onclick="defaultRegulation()">Nanti</button>
                <button class="btn btn-primary" onClick="selectRegulation()" data-dismiss="modal" aria-hidden="true">Tentukan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Form Select Method & Regulation [modal] -->

{{ HTML::script('assets/js/plugins/dataTables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/dataTables/dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/plugins/scrollpane/jquery.jscrollpane.min.js') }}
{{ HTML::script('assets/js/plugins/scrollpane/jquery.mousewheel.js') }}
{{ HTML::script('assets/js/plugins/scrollpane/mwheelIntent.js') }}
{{ HTML::script('assets/js/bootstrap-datepicker.js') }}


<script type="text/javascript">
    var registrant_type = '';
    var examinable_type = [];
    var examinable_id = [];
    var regulation = [];
    var method = [];
    var costs = 0;

    $(function(){
        $('panel-body').jScrollPane();
        $('#patient-table').dataTable();
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

        $('#newPatientBirthDate').datepicker({format: 'yyyy-mm-dd', autoclose : true});

        $('#servPanel').hide();
        $('#labPanel').hide();
    })

    function showFormFindPatient()
    {
        $('#formFindPatient').modal('show');
    }

    function showFormFindOffice()
    {
        $('#formFindOffice').modal('show');    
    }

    function showFormNewPatient()
    {
        $('#formCreatePatient').modal('show');
    }

    function showFormSelect()
    {
        $('#formSelect').modal('show');
    }

    function loadCities()
    {
        var state_id = $('#inputState').val();
        $.post('pasien/carikota/'+state_id, function(data){
            $('#newPatientCity').html('');
            $('#newPatientCity').append("<option value='0'>--Pilih</option>");
            for(var i=0; i < data.length; i++)
            {
                $('#newPatientCity').append("<option value="+data[i].id+">"+data[i].name+"</option>");
            }
        },'json');
    }

    function createPatient()
    {
        var name = $('#newPatientName').val();
        var sex = $('#newPatientSex').val();
        var birthdate = $('#newPatientBirthDate').val();
        var address = $('#newPatientAddress').val();
        var phone = $('#newPatientPhone').val();
        var city_id = $('#newPatientCity').val();

        if(name != '' && city_id != '0')
        {
            $.ajax({
                dataType:'json',
                url:'laboratorium/pasien',
                type:'POST',
                data: {name : name, 
                        sex : sex, 
                        birthdate : birthdate, 
                        address : address, 
                        phone : phone,
                        city_id : city_id},
                success:function(patient){
                    $('#inputPatientID').val(patient.id);
                    $('#inputPatientCode').val(patient.code);
                    $('#inputPatientName').val(patient.name);
                    if(patient.sex == 'L')
                    {   
                        $('#inputPatientSex').val('Laki-laki');
                    }else if(patient.sex == 'P')
                    {
                        $('#inputPatientSex').val('Perempuan');
                    }
                    else{
                        $('#inputPatientSex').val('Tidak Diketahui');
                    }
                    $('#inputPatientBirthDate').val(patient.birthdate);
                    $('#inputPatientAddress').val(patient.address);
                    $('#inputPatientPhone').val(patient.phone);
                    $('#inputPatientCity').val(patient.city.name);

                    registrant_type = 'Patient';
                    $('#officeTab').remove();

                    $('#servPanel').show();
                }
            });
        }else{
            window.alert('Nama pasien harus jelas');
        }
    }

    function showFormNewOffice()
    {
        $('#formCreateOffice').modal('show');
    }

    function createOffice()
    {
        var name = $('#newOfficeName').val();
        var address = $('#newOfficeAddress').val();
        var phone = $('#newOfficePhone').val();
        var fax = $('#newOfficeFax').val();

        if(name != '')
        {
            $.ajax({
                dataType:'json',
                url:'laboratorium/kantor',
                type:'POST',
                data:{name : name, address : address, phone : phone, fax : fax},
                success:function(office){
                    $('#inputOfficeID').val(office.id);
                    $('#inputOfficeName').val(office.name);
                    $('#inputOfficeAddress').val(office.address);
                    $('#inputOfficePhone').val(office.phone);
                    $('#inputOfficeFax').val(office.fax);

                    registrant_type = 'Office';
                    $('#personalTab').remove();

                    $('#servPanel').show();
                }
            });
        }
        else
        {
            window.alert('Nama Instansi harus diisi');
        }
    }

    function takePatient(id)
    {
        $('#inputPatientID').val(id);
        $('#inputPatientCode').val($('#patient_code-'+id).val());
        $('#inputPatientName').val($('#patient_name-'+id).val());
        $('#inputPatientAddress').val($('#patient_address-'+id).val());

        if($('#patient_sex-'+id).val() == "L"){
            $('#inputPatientSex').val('Laki-laki');
        }else{
            $('#inputPatientSex').val('Perempuan');
        }

        $('#inputPatientPhone').val($('#patient_phone-'+id).val());
        $('#inputPatientBirthDate').val($('#patient_birthdate-'+id).val());
        $('#inputPatientCity').val($('#patient_city-'+id).val());
        $('#patientData').show();
        $('#btnFindPatient').remove();
        $('#btnFindOffice').remove();

        $('#btnToStep2').show();

        registrant_type = 'Patient';
        $('#officeTab').remove();

        $('#servPanel').show();
    }

    function takeOffice(id)
    {
        $('#inputOfficeID').val(id);
        $('#inputOfficeName').val($('#office_name-'+id).val());
        $('#inputOfficeAddress').val($('#office_address-'+id).val());
        $('#inputOfficePhone').val($('#office_phone-'+id).val());
        $('#inputOfficeFax').val($('#office_fax-'+id).val());
        $('#officeData').show();

        $('#btnFindPatient').remove();
        $('#btnFindOffice').remove();

        $('#btnToStep2').show();

        registrant_type = 'Office';
        $('#personalTab').remove();

        $('#servPanel').show();
    }

    function takePackage(id)
    {
        var package_id = $('#packageID-'+id).val();
        var package_name = $('#packageName-'+id).val();
        var speciment_name = $('#specimentName-'+id).val();
        var package_price = parseFloat($('#packagePrice-'+id).val());

        var html = '';

        html += "<a href='#' class='list-group-item'>";
        html += "<i class='fa fa-medkit fa-fw'></i> "+package_name;
        html += "<span class='pull-right text-muted small'><em>"+speciment_name+"</em></span>";
        html += "</a>";

        examinable_type.push('Package');
        examinable_id.push(package_id);
        costs += package_price;

        $('#listService').append(html);
        $('#inputCosts').val(costs);

        showFormSelect();

        $('#labPanel').show();
    }

    function takeService(id)
    {
        var service_id = $('#serviceID-'+id).val();
        var service_name = $('#serviceName-'+id).val();
        var speciment_name = $('#serviceSpecimentName-'+id).val();
        var service_price = parseFloat($('#servicePrice-'+id).val());

        var html = '';
        html += "<a href='#' class='list-group-item'>";
        html += "<i class='fa fa-medkit fa-fw'></i> "+service_name;
        html += "<span class='pull-right text-muted small'><em>"+speciment_name+"</em></span>";
        html += "</a>";

        examinable_type.push('Service');
        examinable_id.push(service_id);
        costs += service_price;

        $('#listService').append(html);
        $('#inputCosts').val(costs);

        showFormSelect();

        $('#labPanel').show();
    }

    function selectRegulation()
    {
        regulation.push($('#selectRegulation').val());
        method.push($('#selectMethod').val());
    }

    function defaultRegulation()
    {
        regulation.push(0);
        method.push(0);
    }

    function checkArray()
    {
        window.alert("Here they are: "+'\n'+
                    "examinable_type : "+examinable_type+'\n'+
                    "examinable_id : "+examinable_id+'\n'+
                    "regulation: "+regulation+'\n'+
                    "method : "+method+'\n'+
                    "costs : "+costs);
    }

    function createRepetition()
    {
        var repetition = parseInt($('#inputRepetition').val());
        var costs = parseFloat($('#inputCosts').val());

        repetition += 1;

        var new_costs = parseFloat(repetition * costs);

        $('#inputRepetition').val(repetition);
        $('#inputCosts').val(new_costs);
    }

    function register()
    {
        
    }

    function storeLabSpec()
    {

    }

    function storePayment()
    {

    }
</script>
@stop