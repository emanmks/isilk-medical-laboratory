@extends('layout/wide')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/scrollpane/jquery.jscrollpane.css') }}
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}
{{ HTML::style('assets/css/iCheck/all.css') }}

<section class="content-header">
    <h1>
        Form Pendaftaran
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Laboratorium</a></li>
        <li><a href="laboratorium/create"><i class="active"></i> Pendaftaran</a></li>
    </ol>
</section>

<section class="content">
    <div class="col-lg-12" id="message-container">
        <div class="alert alert-info alert-dismissable">
            <i class="fa fa-warning"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            <div id="message"></div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Pasien</h3>
            </div>

            <div class="box-body" style="height:525px">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li id="personalTab" class="active"><a href="#personalContent" data-toggle="tab">Individu</a></li>
                        <li id="officeTab"><a href="#officeContent" data-toggle="tab">Instansi</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="personalContent">
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

                        <div class="tab-pane fade" id="officeContent">
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

                <select id="selectRecommendation" class="form-control" onchange="checkSender()">
                    <option value="Sendiri">Pengirim</option>
                    <option value="Sendiri">Pasien Sendiri</option>
                    <option value="Dokter">Dokter</option>
                    <option value="Institusi">Institusi</option>
                </select>
                <input type="text" id="inputRecommender" class="form-control" placeholder="Nama Pengirim">
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Layanan</h3>
            </div>

            <div class="box-body" style="overflow: scroll; height:525px;">
                <div class="box-group" id="accordion">
                    <div class="box box-primary">
                        <div class="box-header">
                            <span class="box-title">
                                <small>
                                    <a href="#collapsePacket" data-toggle="collapse" data-parent="#accordion">
                                        Paket Pemeriksaan
                                    </a>
                                </small>
                            </span>
                        </div>
                        <div id="collapsePacket" class="box-collapse collapse in">
                            <div class="box-body" id="body-package">
                                @foreach($packages as $package)

                                    <input type="hidden" id="packageID-{{ $package->id }}" value="{{ $package->id }}">
                                    <input type="hidden" id="packageName-{{ $package->id }}" value="{{ $package->name }}">
                                    <input type="hidden" id="packagePrice-{{ $package->id }}" value="{{ $package->price }}">

                                    <label>
                                        <input type="checkbox" class="flat-red" value="{{ $package->id }}" id="package-{{ $package->id }}"> {{ $package->name }}
                                        
                                        <span id="package_samples_{{ $package->id }}" class="mytooltip">
                                        @foreach($package->speciments as $speciment)
                                            &nbsp;&nbsp;<small class="text-primary"><i class="fa fa-flask"></i> {{ ucfirst(strtolower($speciment->name)) }}</small>
                                        @endforeach
                                        </span>
                                    </label><br/>

                                @endforeach
                            </div>
                        </div>
                    </div>

                    @foreach($classifications as $classification)
                    <div class="box box-primary">
                        <div class="box-header">
                            <span class="box-title">
                                <small>
                                    <a href="#collapse-{{ $classification->id }}" data-toggle="collapse" data-parent="#accordion">
                                        {{ ucfirst(strtolower($classification->name)) }}
                                    </a>
                                </small>
                            </span>
                        </div>
                        <div id="collapse-{{ $classification->id }}" class="box-collapse collapse">
                            <div class="box-body" id="body-service">
                                @if($classification->services->count() > 0)
                                    @foreach($classification->services as $service)

                                        <input type="hidden" id="service_id_{{ $service->id }}" value="{{ $service->id }}">
                                        <input type="hidden" id="service_name_{{ $service->id }}" value="{{ $service->name }}">
                                        <input type="hidden" id="service_speciment_name_{{ $service->id }}" value="{{ $service->speciment->name }}">
                                        <input type="hidden" id="service_price_{{ $service->id }}" value="{{ $service->price }}">

                                        <label>
                                            <input type="checkbox" class="flat-red" value="{{ $service->id }}" id="service-{{ $service->id }}"> {{ $service->name }}
                                            
                                            <span id="service_speciment_{{ $service->id }}"><small class="text-primary"><i class="fa fa-flask"></i> {{ ucfirst(strtolower($service->speciment->name)) }}</small></span>
                                        </label><br/>

                                    @endforeach
                                @endif

                                @foreach($classification->subclassications as $item)
                                    <strong>{{ $item->name }}</strong>
                                    @foreach($item->services as $service)

                                        <input type="hidden" id="service_id_{{ $service->id }}" value="{{ $service->id }}">
                                        <input type="hidden" id="service_name_{{ $service->id }}" value="{{ $service->name }}">
                                        <input type="hidden" id="service_speciment_name_{{ $service->id }}" value="{{ $service->speciment->name }}">
                                        <input type="hidden" id="service_price_{{ $service->id }}" value="{{ $service->price }}">

                                        <label>
                                            <input type="checkbox" class="flat-red" value="{{ $service->id }}" id="service-{{ $service->id }}"> &nbsp;&nbsp;{{ $service->name }}
                                            
                                            <span id="service_speciment_{{ $service->id }}"><small class="text-primary"><i class="fa fa-flask"></i> {{ ucfirst(strtolower($service->speciment->name)) }}</small></span>
                                        </label><br/>

                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Biaya</h3>
            </div>

            <div class="box-body" style="overflow: scroll; height:525px;">
                <button class="btn btn-primary" onclick="register()"><i class="fa fa-check-circle"></i> Daftar</button>
                <div class="list-group" id="listService">
                    
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="inputCosts">Biaya Pemeriksaan</label>
                            <input type="text" id="inputCosts" value="0" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="inputFee">Biaya Konsul</label>
                            <input type="text" id="inputFee" value="0" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="inputFinancing">Jenis Pembayaran</label>
                            <select class="form-control" id="inputFinancing" onchange="setFinancerCondition()">
                                @foreach($financers as $financer)
                                    <option value="{{ $financer->id }}">{{ $financer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <label class="control-label" for="inputFinancer">Dibebankan Pada</label>
                <div class="form-group input-group">
                    <input id="inputFinancerName" class="form-control" type="text" value="Pendaftar/Pasien" disabled>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="showFormFindFinancer()" id="btnFindFinancer" disabled><i class="fa fa-search"></i>
                        </button>
                    </span>

                    <input id="inputFinancerID" class="form-control" type="hidden" value="0">
                </div>

                <label class="control-label" for="inputMessage">Info Tambahan</label>
                <div class="form-group">
                    <textarea class="form-control" id="inputMessage" placeholder="Misal : Request Regulasi/Spesifikasi Metode, dll"></textarea>                    
                </div>
            </div>
        </div>
    </div>
</section>

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
                        <table class="table table-striped table-bordered table-hover" id="office-table">
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

<!-- Form Find Office Sender [modal]
===================================== -->
<div id="formFindOfficeSender" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Cari Kantor</h3>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="office-table">
                            <thead>
                                <tr>
                                    <th>Nama Instansi</th>
                                    <th>Alamat</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($offices as $office)
                                <tr>
                                    <td><strong>{{ $office->name }}</strong></td>
                                    <td>{{ $office->address }}</td>
                                    <td>
                                        <input type="hidden" id="office_sender_name-{{ $office->id }}" value="{{ $office->name }}">
                                        <div class="mytooltip">
                                            <button type="button" class="btn btn-primary btn-circle" onclick="takeOfficeSender({{ $office->id }})" data-dismiss="modal" aria-hidden="true"><i class="fa fa-arrow-right"></i>
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
<!-- End of Find Office Sender [modal] -->

<!-- Form Find Office Financer [modal]
===================================== -->
<div id="formFindOfficeFinancer" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Cari Kantor</h3>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="office-table">
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
                                    <input type="hidden" id="office_financer_name-{{ $office->id }}" value="{{ $office->name }}">
                                    <div class="mytooltip">
                                        <button type="button" class="btn btn-primary btn-circle" onclick="takeFinancer({{ $office->id }})" data-dismiss="modal" aria-hidden="true"><i class="fa fa-arrow-right"></i>
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
<!-- End of Find Office Financer [modal] -->

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

<!-- Form Select Regulation [modal]
===================================== -->
<div id="formSelectRegulation" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Pilih Regulasi</h3>
            </div>

            <div class="modal-body">
               <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="selectRegulation">Pilih Regulasi</label>
                        <div class="col-lg-7">
                            <input type="hidden" id="examinableType" value="">
                            <input type="hidden" id="examinableID" value="0">
                            <select id="selectRegulation" class="form-control">
                                <option value="0">--Pilih</option>
                                @foreach($regulations as $regulation)
                                    <option value="{{ $regulation->id }}">{{ $regulation->name }}</option>
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
<!-- End of Form Select Regulation [modal] -->

<!-- Form Select Method Method [modal]
===================================== -->
<div id="formSelectMethod" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3 id="myModalLabel">Pilih Metode Uji</h3>
            </div>

            <div class="modal-body">
               <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="selectMethod">Pilih Metode Uji</label>
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
                <button class="btn btn-primary" onClick="selectMethod()" data-dismiss="modal" aria-hidden="true">Tentukan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Form Select Method [modal] -->

{{ HTML::script('assets/js/plugins/dataTables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/dataTables/dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/plugins/scrollpane/jquery.jscrollpane.min.js') }}
{{ HTML::script('assets/js/plugins/scrollpane/jquery.mousewheel.js') }}
{{ HTML::script('assets/js/plugins/scrollpane/mwheelIntent.js') }}
{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}

<script type="text/javascript">
    //Initialize Variable Global in This Page
    var totalCost = 0;
    var registrant_type = '';
    var registrant_id = 0;

    $(function(){
        $('#patient-table').dataTable({
            "ordering" : false
        });
        $('#office-table').dataTable({
            "ordering" : false
        });

        $('box-body').jScrollPane();
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

        $('#newPatientBirthDate').datepicker({format: 'yyyy-mm-dd', autoclose : true});

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });

        $('#body-package input[type="checkbox"]').on('ifClicked', function(){
            if(!this.checked){
                updateCost('Package','Dec',this.value);
                $('#package_samples_'+this.value).show();
            }else{
                updateCost('Package','Inc',this.value);
                 $('#package_samples_'+this.value).hide();
            }
        });

        $('#body-service input[type="checkbox"]').on('ifClicked', function(){
            if(!this.checked){
                updateCost('Service','Dec',this.value);
                $('#service_sample_'+this.value).show();
            }else{
                updateCost('Service','Inc',this.value);
                $('#service_sample_'+this.value).hide();
            }
        });


        $('span[id^=package_samples_]').hide();
        $('span[id^=service_sample_]').hide();

        $('#message-container').hide();
    })

    function updateCost(object, status, id)
    {
        switch(object)
        {
            case 'Package':
                if(status == 'Dec'){
                    totalCost += parseFloat($('#packagePrice-'+id).val());
                }else{
                    totalCost -= parseFloat($('#packagePrice-'+id).val());
                }
                break;
            case 'Service':
                if(status == 'Dec'){
                    totalCost += parseFloat($('#servicePrice-'+id).val());
                }else{
                    totalCost -= parseFloat($('#servicePrice-'+id).val());
                }
                break;
        }

        $('#inputCosts').val(totalCost);
    }

    function checkSender()
    {
        var recommendation = $('#selectRecommendation').val();

        if(recommendation == 'Institusi')
        {
            $('#formFindOfficeSender').modal('show');
        }else if(recommendation == 'Pasien')
        {
            $('#inputRecommender').val('');
            $('#inputRecommender').atrr('disabled');
        }
    }

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

    function showFormSelectRegulation()
    {
        $('#formSelectRegulation').modal('show');
    }

    function showFormSelectMethod()
    {
        $('#formSelectMethod').modal('show');
    }

    function setFinancerCondition()
    {
        var financing = $('#inputFinancing').val();

        if(financing == '1')
        {
            $('#btnFindFinancer').attr('disabled','disabled');
            $('#inputFinancerID').val(0);
            $('#inputFinancerName').val('Pendaftar/Pasien');
        }
        else if(financing == '2')
        {
            $('#btnFindPatient').attr('disabled','disabled');
            $('#inputFinancerID').val(2);
            $('#inputFinancerName').val('BPJS');
        }
        else
        {
            $('#btnFindFinancer').removeAttr('disabled');
            $('#inputFinancerID').val(0);
            $('#inputFinancerName').val('Cari Kantor');
        }
    }

    function showFormFindFinancer()
    {
        $('#formFindOfficeFinancer').modal('show');
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
                    registrant_id = patient.id;

                    $('#officeTab').remove();

                    $('#servbox').show();
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
                    registrant_id = office.id;

                    $('#personalTab').remove();

                    $('#servbox').show();
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
        registrant_id = id;

        $('#officeTab').remove();

        $('#servbox').show();
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

        registrant_type = 'Office';
        registrant_id = id;

        $('#personalTab').remove();

        $('#servbox').show();
    }

    function takeOfficeSender(id)
    {
        $('#inputRecommender').val($('#office_sender_name-'+id).val());
    }

    function takeFinancer(id)
    {
        $('#inputFinancerID').val(id);
        $('#inputFinancerName').val($('#office_financer_name-'+id).val());
    }

    function register()
    {
        var recommendation = $('#selectRecommendation').val();
        var recommender = $('#inputRecommender').val();
        var costs = $('#inputCosts').val();
        var fee = $('#inputFee').val();
        var packages = [];
        var services = [];
        var messages = $('#inputMessage').val();
        var financing = $('#inputFinancing').val();

        $('input:checkbox[id^="package-"]:checked').each(function(){
            packages.push($(this).val());
        });

        $('input:checkbox[id^="service-"]:checked').each(function(){
            services.push($(this).val());
        });

        if(!($('#checkCash').prop('checked'))){
            var financer = $('#inputFinancerID').val();
        }
        else{
            var financer = 0;
        }

        if(registrant_id != 0 && (packages.length > 0 ||  services.length > 0))
        {
            $.ajax({
                url:"{{ URL::to('laboratorium') }}",
                type:'POST',
                dataType:'json',
                data:{
                    registrant_type:registrant_type,
                    registrant_id:registrant_id,
                    packages:packages,
                    services:services,
                    costs:costs,
                    fee:fee,
                    recommendation:recommendation,
                    recommender:recommender,
                    financing:financing,
                    financer:financer,
                    messages:messages
                },
                success:function(laboratory){
                    if(laboratory.status == 'succed')
                    {
                        window.location = "{{ URL::to('laboratorium') }}/"+laboratory.id;
                    }
                    else
                    {
                        $('#message-container').show();
                        $('#message').html(laboratory.message);
                    }
                }
            });
        }
        else
        {
            window.alert('Mohon Lengkapi Data Anda!!');
        }
    }
</script>
@stop