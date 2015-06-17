@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        {{ $classification->name }}
        <input type="hidden" name="classification_id" value="{{ $classification->id }}">
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Pemeriksaan</a></li>
        <li><a href="{{ URL::to('klasifikasi') }}"><i class="active"></i> Klasifikasi</a></li>
        <li><a href="{{ URL::to('klasifikasi') }}/{{ $classification->id }}"><i class="active"></i> {{ $classification->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">

            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif

        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-6">
            <button class="btn btn-flat btn-success" data-toggle="tooltip" data-placement="right" title="Tambahkan Kelompok/Klasifikasi Pemeriksaan Baru" onclick="showFormCreateClassification()"><i class="fa fa-list"></i></button>
        </div>
        <div class="col-xs-6">
            <div class="text-right">
                <button class="btn btn-flat btn-primary" data-toggle="tooltip" data-placement="left" title="Tambahkan Jenis Pemeriksaan Baru" onclick="showFormCreateService()"><i class="fa fa-medkit"></i></button>
            </div>
        </div>
    </div>

    <div class="clear-fix"><br/></div>

    @if($classification->services->count() > 0)
    <div class="row">
        <div class="col-lg-12">
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
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            @foreach($classifications as $item)
                <strong class="page-header">{{ $item->code }} - {{ $item->name }}</strong>
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
        </div>
    </div>

</section>

<!-- Form Add Classification [modal]
===================================== -->
<div id="formCreateClassification" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Tambah Klasifikasi Pemeriksaan</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="classification_name">Nama Klasifikasi</label>
                        <div class="col-lg-7">
                            <input name="classification_name" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="createClassification()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Classification [modal] -->

<!-- Form Add Service [modal]
===================================== -->
<div id="formCreateService" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Tambah Jenis Pemeriksaan</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="clalssification">Klasifikasi</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="classification">
                                <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                                @foreach($classifications as $item)
                                    <option value="{{ $item->id }}">{{ $classification->name }} - {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="service_name">Nama</label>
                        <div class="col-lg-6">
                            <input name="service_name" class="form-control" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="price">Tarif</label>
                        <div class="col-lg-4">
                            <input name="price" class="form-control" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="speciment">Jenis Sampel</label>
                        <div class="col-lg-4">
                            <select class="form-control" name="speciment">
                                <option value="0">--Pilih</option>
                                @foreach($speciments as $speciment)
                                    <option value="{{ $speciment->id }}">{{ $speciment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="clinical">Jenis</label>
                        <div class="col-lg-4">
                            <select class="form-control" name="clinical">
                                <option value="1">Klinis</option>
                                <option value="0">Non Klinis</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="createService()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Service [modal] -->

<!-- Form Update Classification [modal]
===================================== -->
<div id="formUpdateClassification" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Update Klasifikasi Pemeriksaan</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-4 control-label" for="updated_name">Nama Klasifikasi</label>
                        <div class="col-lg-7">
                            <input name="updated_classification_id" type="hidden" value="0">
                            <input name="updated_classification_name" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="updateClassification()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Update Classification [modal] -->

<!-- Form Update Service [modal]
===================================== -->
<div id="formUpdateService" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Update Jenis Pemeriksaan</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="updated_classification">Klasifikasi</label>
                        <div class="col-lg-8">
                            <input type="hidden" name="updated_service_id" value="0">
                            <select class="form-control" name="updated_classification">
                                <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                                @foreach($classifications as $item)
                                    <option value="{{ $item->id }}">{{ $classification->name }} - {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="updated_service_name">Nama</label>
                        <div class="col-lg-6">
                            <input name="updated_service_name" class="form-control" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="updated_price">Tarif</label>
                        <div class="col-lg-4">
                            <input name="updated_price" class="form-control" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="updated_speciment">Jenis Sampel</label>
                        <div class="col-lg-4">
                            <select class="form-control" name="updated_speciment">
                                <option value="0">--Pilih</option>
                                @foreach($speciments as $speciment)
                                    <option value="{{ $speciment->id }}">{{ $speciment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="updated_clinical">Jenis</label>
                        <div class="col-lg-4">
                            <select class="form-control" name="updated_clinical">
                                <option value="1">Klinis</option>
                                <option value="0">Non Klinis</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="updateService()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Service [modal] -->

<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">
    $(document).ready(function() {

        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })

    });

    function showFormCreateClassification()
    {
        $('#formCreateClassification').modal('show');
    }

    function showFormCreateService()
    {
        $('#formCreateService').modal('show');
    }

    function showFormUpdateClassification(id)
    {
        $('#formUpdateClassification').modal('show');
        $('[name=updated_classification_id]').val(id);
        $('[name=updated_classification_name]').val($('#classification-name-'+id).val());
    }

    function showFormUpdateService(id)
    {
        $('#formUpdateService').modal('show');
        $('[name=updated_service_id]').val(id);
        $('[name=updated_classification]').val($('#classification-'+id).val());
        $('[name=updated_service_name]').val($('#service-name-'+id).val());
        $('[name=updated_price]').val($('#price-'+id).val());
        $('[name=updated_clinical]').val($('#clinical-'+id).val());
        $('[name=updated_speciment]').val($('#speciment-'+id).val());
    }

    function createService()
    {
        var name = $('[name=service_name]').val();
        var price = $('[name=price]').val();
        var clinical = $('[name=clinical]').val();
        var speciment_id = $('[name=speciment]').val();
        var classification_id = $('[name=classification]').val();

        if(classification_id != 0 && speciment_id != 0 && name != '')
        {
            $.ajax({
                url:"{{ URL::to('pemeriksaan') }}",
                type:'POST',
                data:{
                    classification_id : classification_id,
                    name : name,
                    price : price,
                    clinical : clinical,
                    speciment_id : speciment_id
                },
                success:function(){
                    window.location = "{{ URL::to('klasifikasi') }}/"+"{{ $classification->id }}";
                }
            });
        }
        else
        {
            window.alert('Anda belum memilih jenis layanan');
        }
    }
    
    function updateService()
    {
        var id = $('[name=updated_service_id]').val();
        var name = $('[name=updated_service_name]').val();
        var price = $('[name=updated_price]').val();
        var clinical = $('[name=updated_clinical]').val();
        var speciment_id = $('[name=updated_speciment]').val();
        var classification_id = $('[name=updated_classification]').val();

        if(name != '')
        {
            $.ajax({
                url:"{{ URL::to('pemeriksaan') }}/"+id,
                type:'PUT',
                data:{
                    name : name,
                    price : price,
                    clinical : clinical,
                    speciment_id : speciment_id,
                    classification_id : classification_id
                },
                success:function(){
                    window.location = "{{ URL::to('klasifikasi') }}/"+"{{ $classification->id }}";
                }
            });
        }
        else
        {
            window.alert('Anda belum memilih jenis layanan');
        }
    }
    
    function destroyService(id)
    {
        if(confirm('Yakin, akan menghapus pemeriksaan ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('pemeriksaan') }}/"+id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('klasifikasi') }}/"+"{{ $classification->id }}";
                }
            });
        }
    }

    function createClassification()
    {
        var id = $('[name=classification_id]').val();
        var name = $('[name=classification_name]').val();

        if(name != '')
        {
            $.ajax({
                url:"{{ URL::to('klasifikasi') }}",
                type:'POST',
                data:{parent_id:id, name:name},
                success:function(){
                    window.location = "{{ URL::to('klasifikasi') }}/"+id;
                }
            });
        }
        else
        {
           window.alert('Nama Kelompok Pemeriksaan Harus Jelas');
        }
    }

    function updateClassification()
    {
        var id = $('[name=classification_id]').val();
        var updated_id = $('[name=updated_classification_id]').val();
        var name = $('[name=updated_classification_name]').val();

        if(id != '0' && name != '')
        {
            $.ajax({
                url:"{{ URL::to('klasifikasi') }}/"+updated_id,
                type:'PUT',
                data:{name:name},
                success:function(){
                    window.location = "{{ URL::to('klasifikasi') }}/"+id;
                }
            });
        }
        else
        {
            window.alert('Nama Kelompok Pemeriksaan Harus Jelas');
        }
    }
    
    function destroyClassification(destroy_id)
    {
        var id = $('[name=classification_id]').val();

        if(confirm('Yakin menghapus data ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('klasifikasi') }}/"+destroy_id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('klasifikasi') }}/"+id;
                }
            });
        }
    }
</script>
@stop