@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Data Jenis Layanan</h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ URL::to('layanan') }}"><i class="active"></i> Layanan</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-flat btn-primary" data-toggle="tooltip" data-placement="left" title="Simpan"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-lg-4 control-label" for="inputInstallation">Klasifikasi Pemeriksaan</label>
                    <div class="col-lg-6">
                        <select class="form-control" id="inputInstallation">
                            <option value="0">--Pilih</option>
                            @foreach($installations as $installation)
                                @foreach($installation->classifications as $classification)
                                    <option value="{{ $classification->id }}">{{ $installation->name }} - {{ $classification->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label" for="inputCode">Kode Layanan</label>
                    <div class="col-lg-2">
                        <input id="inputCode" class="form-control" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label" for="inputName">Nama Layanan</label>
                    <div class="col-lg-5">
                        <input id="inputName" class="form-control" type="text">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-4 control-label" for="inputPrice">Tarif</label>
                    <div class="col-lg-3">
                        <input id="inputPrice" class="form-control" type="text" onkeyup="formatNumber(this)">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-4 control-label" for="inputSpeciment">Jenis Sampel</label>
                    <div class="col-lg-3">
                        <select class="form-control" id="inputSpeciment">
                            <option value="0">--Pilih</option>
                            @foreach($speciments as $speciment)
                                <option value="{{ $speciment->id }}">{{ $speciment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label" for="inputClinical">Klinis / Non Klinis</label>
                    <div class="col-lg-3">
                        <select class="form-control" id="inputClinical">
                            <option value="1">Pemeriksaan Klinis</option>
                            <option value="0">Pemeriksaan Non Klinis</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function create()
    {

    }
</script>

@stop