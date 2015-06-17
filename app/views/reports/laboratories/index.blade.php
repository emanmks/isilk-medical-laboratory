@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}

<section class="content-header">
    <h1>
        Laporan Laboratorium
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Laporan</a></li>
        <li><a href="pembiayaan"><i class="active"></i> Laboratorium</a></li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/pemeriksaan') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Semua Pemeriksaan</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/pemeriksaan/individu') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Pemeriksaan Individu</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/pemeriksaan/instansi') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Pemeriksaan Instansi</strong>
                </div>
            </div>

            <br/><br/>

            <div class="row">
                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/pemeriksaan/rekap') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Rekap Semua Pemeriksaan</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/pemeriksaan/individu/rekap') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Rekap Pemeriksaan Individu</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/pemeriksaan/instansi/rekap') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Rekap Pemeriksaan Instansi</strong>
                </div>
            </div>

            <br/><br/>

            <div class="row">
                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/sampling') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Penerimaan Semua Sampel</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/sampling/individu') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Penerimaan Sampel Individu</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/sampling/instansi') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Penerimaan Sampel Instansi</strong>
                </div>
            </div>

            <br/><br/>

            <div class="row">
                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/sampling/rekap') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Rekap Semua Sampel</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/sampling/rekap/individu') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Rekap Sampel Individu</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan/sampling/rekap/instansi') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Rekap Sampel Instansi</strong>
                </div>
            </div>
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
</script>
@stop