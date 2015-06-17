@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        <i class="fa fa-list"></i> Manual
        <small>Petuntuk Menggunakan iSILK</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ URL::to('manual') }}">Manual</a></li>
    </ol>
</section>

<section class="content">

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('manual/dashboard') }}">
                <h1><i class="fa fa-dashboard"></i></h1>
                <p>Dashboard</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('manual/pendaftaran') }}">
                <h1><i class="fa fa-file"></i></h1>
                <p>Pendaftaran</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('manual/sampling') }}">
                <h1><i class="fa fa-flask"></i></h1>
                <p>Penerimaan Sampel</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('manual/pemeriksaan') }}">
                <h1><i class="fa fa-stethoscope"></i></h1>
                <p>Pemeriksaan</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('manual/lhu') }}">
                <h1><i class="fa fa-files-o"></i></h1>
                <p>Laporan Hasil Uji</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('manual/layanan') }}">
                <h1><i class="fa fa-medkit"></i></h1>
                <p>Jenis Layanan</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('manual/paket') }}">
                <h1><i class="fa fa-medkit"></i></h1>
                <p>Paket Pemeriksaan</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('manual/data') }}">
                <h1><i class="fa fa-gears"></i></h1>
                <p>Data dan Pengaturan</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('manual/laporan') }}">
                <h1><i class="fa fa-files-o"></i></h1>
                <p>Laporan</p>
            </a>
        </div>
    </div>

</section>
@stop