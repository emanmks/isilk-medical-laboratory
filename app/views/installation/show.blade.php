@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        <i class="fa fa-hospital-o"></i>
        {{ $installation->name }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Instalasi</a></li>
        <li><a href="{{ URL::to('instalasi') }}/{{ $installation->id }}"><i class="active"></i> {{ $installation->name }}</a></li>
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
            <div class="jumbotron">
                <center>
                    <h1><i class="fa fa-hospital-o text-info"></i></h1>
                    <h1><span class="text-info">{{ $installation->name }}</span></h1>
                    <small>
                        @foreach($installation->employees as $employee)
                            <i class="fa fa-user"></i>
                            {{ $employee->name }} <small class="text-warning">[{{ $employee->pivot->position }}]</small>
                            <small>
                                <a href="#" onclick="detachEmployee({{ $installation->id }}, {{ $employee->id }})" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-close text-danger"></i></a>
                            </small>
                            &nbsp;&nbsp;
                        @endforeach
                        <br/>
                        <button class="btn btn-xs btn-flat btn-success" onclick="showFormAddEmployee()" data-toggle="tooltip" data-placement="top" title="Tambahkan Pegawai"><i class="fa fa-plus"></i></button>
                    </small>
                </center>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-flat btn-xs btn-info" onclick="showFormAddClassification()" data-toggle="tooltip" data-placement="left" title="Tambahkan Klasifikasi"><i class="fa fa-plus"></i></button>  
            </div>
        </div>

        <div class="col-lg-12">
            @foreach($installation->classifications as $classification)
                
                @if($classification->services->count() > 0)
                    <strong class="page-header">{{ $classification->code }} - {{ $classification->name }}</strong>
                    <a href="#" onclick="detachClassification({{ $installation->id }}, {{ $classification->id }})" data-toggle="tooltip" data-placement="right" title="Keluarkan"><i class="fa fa-close text-danger"></i></a>
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Jenis Pemeriksaan</th>
                                <th>Tarif</th>
                                <th>Sampel</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classification->services as $service)
                                <tr>
                                    <td>{{ $service->code }}</td>
                                    <td>
                                        <i class="fa fa-medkit"></i> 
                                        <a href="{{ URL::to('pemeriksaan') }}/{{ $service->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Detail dan Parameter">{{ $service->name }}</a>
                                    </td>
                                    <td>Rp{{ number_format($service->price,2,",",".") }}</td>
                                    <td><i class="fa fa-tint"></i> {{ $service->speciment->name }}</td>
                                    <td>
                                        @if($service->clinical == 1)
                                            Klinis
                                        @else
                                            Non Klinis
                                        @endif
                                    </td>
                                    <td>
                                        <input type="hidden" id="service-name-{{ $service->id }}" value="{{ $service->name }}">
                                        <input type="hidden" id="price-{{ $service->id }}" value="{{ $service->price }}">
                                        <input type="hidden" id="speciment-{{ $service->id }}" value="{{ $service->speciment_id }}">
                                        <input type="hidden" id="clinical-{{ $service->id }}" value="{{ $service->clinical }}">
                                        <input type="hidden" id="classification-{{ $service->id }}" value="{{ $service->classification_id }}">

                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showFormUpdateService({{ $service->id }})"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="destroyService({{ $service->id }})"><i class="fa fa-trash-o text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                @if($classification->subclassifications->count() > 0)
                    <strong class="page-header">{{ $classification->code }} - {{ $classification->name }}</strong>
                    <a href="#" onclick="detachClassification({{ $installation->id }}, {{ $classification->id }})" data-toggle="tooltip" data-placement="right" title="Keluarkan"><i class="fa fa-close text-danger"></i></a>
                    <br/>
                    @foreach($classification->subclassifications as $item)
                        <strong>{{ $item->code }} - {{ $item->name }}</strong>
                        <table class="table table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Jenis Pemeriksaan</th>
                                    <th>Tarif</th>
                                    <th>Sampel</th>
                                    <th>Jenis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item->services as $service)
                                    <tr>
                                        <td>{{ $service->code }}</td>
                                        <td>
                                            <i class="fa fa-medkit"></i> 
                                            <a href="{{ URL::to('pemeriksaan') }}/{{ $service->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Detail dan Parameter">{{ $service->name }}</a>
                                        </td>
                                        <td>Rp{{ number_format($service->price,2,",",".") }}</td>
                                        <td><i class="fa fa-tint"></i> {{ $service->speciment->name }}</td>
                                        <td>
                                            @if($service->clinical == 1)
                                                Klinis
                                            @else
                                                Non Klinis
                                            @endif
                                        </td>
                                        <td>
                                            <input type="hidden" id="service-name-{{ $service->id }}" value="{{ $service->name }}">
                                            <input type="hidden" id="price-{{ $service->id }}" value="{{ $service->price }}">
                                            <input type="hidden" id="speciment-{{ $service->id }}" value="{{ $service->speciment_id }}">
                                            <input type="hidden" id="clinical-{{ $service->id }}" value="{{ $service->clinical }}">
                                            <input type="hidden" id="classification-{{ $service->id }}" value="{{ $service->classification_id }}">

                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showFormUpdateService({{ $service->id }})"><i class="fa fa-edit"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="destroyService({{ $service->id }})"><i class="fa fa-trash-o text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                @endif

            @endforeach
        </div>

    </div>
</section>

<!-- Form Add Employee [modal]
===================================== -->
<div id="formAddEmployee" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Masukkan Pegawai</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="employee">Pilih Pegawai</label>
                        <div class="col-sm-8">
                            <select name="employee" class="form-control">
                                <option value="0">--Pilih Pegawai</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->code }} - {{ $employee->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="position">Jabatan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="position">
                        </div>
                    </div>  
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="attachEmployee({{ $installation->id }})" data-dismiss="modal" aria-hidden="true">Masukkan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Employee [modal] -->

<!-- Form Add Classification [modal]
===================================== -->
<div id="formAddClassification" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Tambah Kelompok Pemeriksaan</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="classification">Pilih Kelompok Pemeriksaan</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="classification">
                                @foreach($classifications as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="attachClassification({{ $installation->id }})" data-dismiss="modal" aria-hidden="true">Masukkan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Classification [modal] -->

<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function showFormAddEmployee()
    {
        $('#formAddEmployee').modal('show');
    }

    function showFormAddClassification()
    {
        $('#formAddClassification').modal('show');
    }

    function attachEmployee(installation_id)
    {
       var employee_id = $('[name=employee]').val();
       var position = $('[name=position]').val();

       if(employee_id != 0)
        {
            $.ajax({
                url:"{{ URL::to('instalasi') }}/"+installation_id+"/attach",
                type:'POST',
                data:{employee_id : employee_id, position : position},
                success:function(){
                    window.location = "{{ URL::to('instalasi') }}/"+installation_id;
                }
            });
        }
    }

    function attachClassification(installation_id)
    {
        var classification_id = $('[name=classification]').val();

        if(classification_id != '')
        {
            $.ajax({
                url:"{{ URL::to('instalasi') }}/"+installation_id+"/tambah/klasifikasi",
                type:'POST',
                data:{classification_id:classification_id},
                success:function(){
                    window.location = "{{ URL::to('instalasi') }}/"+installation_id;
                }
            });
        }
    }

    function detachEmployee(installation_id, employee_id)
    {
        if(confirm('Yakin, akan mengeluarkan pegawai ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('instalasi') }}/"+installation_id+"/detach/"+employee_id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('instalasi') }}/"+installation_id;
                }
            });
        }
    }

    function detachClassification(installation_id, classification_id)
    {
        if(confirm('Yakin, akan mengeluarkan Kelompok pemeriksaan ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('instalasi') }}/"+installation_id+"/hapus/klasifikasi/"+classification_id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('instalasi') }}/"+installation_id;
                }
            });
        }
    }
</script>
@stop