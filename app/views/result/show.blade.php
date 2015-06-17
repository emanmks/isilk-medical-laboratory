@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        <i class="fa fa-file"></i>
        Laporan Hasil Uji
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Laboratorium</a></li>
        <li><a href="{{ URL::to('hasil') }}/{{ $laboratory->id }}"><i class="active"></i> Hasil</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Pilih Layout Laporan</h3>
                </div>

                <div class="box-body">
                    <div class="row mytooltip">
                        <div class="col-md-3">
                            <a href="{{ URL::to('hasil') }}/{{ $laboratory->id }}/konvensional" class="btn btn-app" data-toggle="tooltip" data-placement="right" title="LAYOUT KONVENSIONAL : Layout Laporan Standar Top Down"><i class="fa fa-file fa-5x"></i> Konvensional</a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ URL::to('hasil') }}/{{ $laboratory->id }}/horizontal" class="btn btn-app" data-toggle="tooltip" data-placement="top" title="LAYOUT HORIZONTAL : Layout Laporan Standar Standar Melebar"><i class="fa fa-columns fa-5x"></i> Horizontal</a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ URL::to('hasil') }}/{{ $laboratory->id }}/naratif" class="btn btn-app" data-toggle="tooltip" data-placement="top" title="LAYOUT NARATIF : Untuk Laporan dengan hasil berupa komentar/penjelasan"><i class="fa fa-align-left fa-5x"></i> Naratif</a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ URL::to('hasil') }}/{{ $laboratory->id }}/matriks" class="btn btn-app" data-toggle="tooltip" data-placement="left" title="LAYOUT MATRIKS : Untuk Laporan dengan banyak sampel yang akan dibandingkan"><i class="fa fa-th fa-5x"></i> Matriks</a>
                        </div>     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    @if($laboratory->registrant_type == 'Patient')
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <i class="fa fa-user"></i> {{ $laboratory->registrant->code }}
                                <span class="pull-right text-muted small"><em>Nomor Pasien</em></span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-user"></i> {{ $laboratory->registrant->name }}
                                <span class="pull-right text-muted small"><em>Nama Pasien</em></span>
                            </a>
                        </div>
                    @else
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <i class="fa fa-home"></i> {{ $laboratory->registrant->name }}
                                <span class="pull-right text-muted small"><em>Nama Instansi/Perusahaan</em></span>
                            </a>
                        </div>
                    @endif

                    <div class="list-group">
                        @foreach($laboratory->choices as $choice)
                        <a href="#" class="list-group-item">
                            <i class="fa fa-medkit"></i> {{ $choice->examinable->name }}
                            <span class="pull-right text-muted small"><em></em></span>
                        </a>
                        @endforeach
                    </div>
                    
                    <div class="list-group">
                        @foreach($laboratory->samplings as $sampling)
                        <a href="#" class="list-group-item">
                            <i class="fa fa-flask"></i> {{ $sampling->speciment->name }}
                            <span class="pull-right text-muted small"><em>{{ $sampling->code }}</em></span>
                        </a>
                        @endforeach
                    </div>

                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-user"></i> {{ $laboratory->recommendation }}
                            <span class="pull-right text-muted small"><em>Jenis Rekomendasi</em></span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-user"></i> {{ $laboratory->recommender }}
                            <span class="pull-right text-muted small"><em>Direkomendasikan Oleh</em></span>
                        </a>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(function(){
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });
</script>

@stop