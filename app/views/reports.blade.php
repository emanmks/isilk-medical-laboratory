@extends('layout/base')

@section('content')

<section class="content-header">
    <h1><i class="fa fa-files-o"></i> Laporan</h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="active"></i> Laporan</a></li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <strong class="text-muted">Laporan-laporan Pemeriksaan</strong>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-file"></i></h1>
                <a href="{{ URL::to('') }}">List Pendaftaran</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-file"></i></h1>
                <a href="{{ URL::to('') }}">Pendaftaran Periodik</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-file"></i></h1>
                <a href="{{ URL::to('') }}">Statistik Jenis Pendaftar</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-file"></i></h1>
                <a href="{{ URL::to('') }}">Statistik Asal Pendaftar</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-tint"></i></h1>
                <a href="{{ URL::to('') }}">List Sampling</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-tint"></i></h1>
                <a href="{{ URL::to('') }}">Sampling Periodik</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-tint"></i></h1>
                <a href="{{ URL::to('') }}">Statistik Jenis Spesimen</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-tint"></i></h1>
                <a href="{{ URL::to('') }}">Statistik Asal Spesimen</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-flask"></i></h1>
                <a href="{{ URL::to('') }}">List Pemeriksaan</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-flask"></i></h1>
                <a href="{{ URL::to('') }}">Pemeriksaan Periodik</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-flask"></i></h1>
                <a href="{{ URL::to('') }}">Statistik Paket Pemeriksaan</a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-flask"></i></h1>
                <a href="{{ URL::to('') }}">Statistik Jenis Pemeriksaan</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <strong class="text-muted">Laporan-laporan Keuangan</strong>
        </div>

        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-tags"></i></h1>
                <a href="{{ URL::to('tagihan') }}">Invoice</a>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="thumb-menu">
                <h1><i class="fa fa-money"></i></h1>
                <a href="{{ URL::to('penerimaan') }}">Income</a>
            </div>
        </div>
    </div>

</section>
@stop