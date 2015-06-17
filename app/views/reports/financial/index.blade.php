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
        <li><a href="pembiayaan"><i class="active"></i> Keuangan</a></li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Laporan Penerimaan Individu</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Laporan Penerimaan Instansi</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Laporan Penerimaan Gabungan</strong>
                </div>
            </div>

            <br/>

            <div class="row">
                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Laporan Tagihan</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Laporan Tagihan Per Instansi</strong>
                </div>

                <div class="col-lg-4 text-center">
                    <a href="{{ URL::to('laporan') }}" class="text-info"><i class="fa fa-file-text-o fa-5x"></i></a>
                    <div class="clear-fix"></div>
                    <strong>Laporan Rekap Tagihan</strong>
                </div>
            </div>

            <br/>
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