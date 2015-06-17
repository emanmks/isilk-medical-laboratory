@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        <i class="fa fa-gears"></i> Data
        <small>Master Data dan Pengaturan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ URL::to('datas') }}">Data</a></li>
    </ol>
</section>

<section class="content">

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('pegawai') }}">
                <h1><i class="fa fa-user"></i></h1>
                <p>Pegawai</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('instalasi') }}">
                <h1><i class="fa fa-hospital-o"></i></h1>
                <p>Instalasi</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('referensi') }}">
                <h1><i class="fa fa-gears"></i></h1>
                <p>Referensi</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('instansi') }}">
                <h1><i class="fa fa-building-o"></i></h1>
                <p>Instansi</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('pasien') }}">
                <h1><i class="fa fa-user-md"></i></h1>
                <p>Pasien</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('spesimen') }}">
                <h1><i class="fa fa-tint"></i></h1>
                <p>Spesimen</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('metode') }}">
                <h1><i class="fa fa-search"></i></h1>
                <p>Metode Uji</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('user') }}">
                <h1><i class="fa fa-user"></i></h1>
                <p>User</p>
            </a>
        </div>
    </div>

    <div class="col-md-2 col-xs-4">
        <div class="thumb-menu">
            <a href="{{ URL::to('pembiayaan') }}">
                <h1><i class="fa fa-credit-card"></i></h1>
                <p>Pembiayaan</p>
            </a>
        </div>
    </div>

</section>
@stop