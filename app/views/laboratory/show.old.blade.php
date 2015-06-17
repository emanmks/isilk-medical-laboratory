@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/plugins/scrollpane/jquery.jscrollpane.css') }}
{{ HTML::style('assets/css/plugins/social-buttons/social-buttons.css') }}

<section class="content-header">
    <h1>{{ $laboratory->code }}</h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Pendaftaran</a></li>
        <li><a href="{{ URL::to('laboratorium') }}/{{ $laboratory->id }}"><i class="active"></i> {{ $laboratory->code }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">
                        Detail Pasien
                    </div>
                </div>

                <div class="box-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-barcode"></i> {{ $laboratory->registrant->code or '' }}
                            <span class="pull-right text-muted small"><em>Kode Pasien</em></span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-user"></i> {{ $laboratory->registrant->name or '' }}
                            <span class="pull-right text-muted small"><em>Nama Pasien / Instansi</em></span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-road"></i> {{ $laboratory->registrant->address or '' }}
                            <span class="pull-right text-muted small"><em>Alamat</em></span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-phone"></i> {{ $laboratory->registrant->phone or $laboratory->registrant->contact }}
                            <span class="pull-right text-muted small"><em>Kontak</em></span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-phone"></i> {{ $laboratory->registrant->fax or 'Not Available' }}
                            <span class="pull-right text-muted small"><em>Fax</em></span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-map-marker"></i> {{ $laboratory->registrant->city->name or 'Tidak Diketahui' }}
                            <span class="pull-right text-muted small"><em>Kota Asal</em></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Data Layanan Pemeriksaan
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">Nomor Lab</div>
                        <div class="col-md-6" id="labNum">
                            <div class="text-right"><strong class="label label-success">{{ $laboratory->code }}</strong></div>
                        </div>
                    </div>

                    <br>

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

@if($laboratory->finance_id == 1)
<section class="content invoice">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                <i class="fa fa-medkit"></i> {{ $laboratory->code }}
                <small class="pull-right">Tgl: {{ date('d-m-Y', strtotime($laboratory->registrationtime)) }}</small>
            </h2>                            
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>Balai Besar Laboratorium Kesehatan Makassar</strong><br>
                Jl. Perintis Kemerdekaan<br>
                Makassar, Sulawesi Selatan<br>
                Telepon: (0411) 123-5432<br/>
                Fax: (0411) 123-5432
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Terima Dari
            <address>
                <strong>{{ $laboratory->registrant->name }}</strong><br>
                {{ $laboratory->registrant->address }}<br>
                {{ $laboratory->registrant->phone }}
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Kwitansi #{{ $laboratory->payment->id }}</b><br/>
            <b>Nomor Lab:</b> {{ $laboratory->code }}<br/>
            <b>Tgl Pendaftaran:</b> {{ $laboratory->registrationtime }}<br/>
            <b>Kasir:</b> {{ $laboratory->employee->name }}
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kode Layanan</th>
                        <th>Nama Layanan</th>
                        <th>Subtotal</th>
                    </tr>                                    
                </thead>
                <tbody>
                    @foreach($laboratory->choices as $choice)
                    <tr>
                        <td>{{ $choice->examinable->code }}</td>
                        <td>{{ $choice->examinable->name }}</td>
                        <td>Rp{{ number_format($choice->examinable->price,2,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>                            
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-xs-6 col-xs-offset-6">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rp{{ number_format($laboratory->payment->cost,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <th>Biaya Konsul:</th>
                        <td>Rp{{ number_format($laboratory->payment->fee,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <th>Total Biaya:</th>
                        <td>Rp{{ number_format($total = $laboratory->payment->cost + $laboratory->payment->fee,2,',','.') }}</td>
                    </tr>
                </table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-info pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</section>
@else
<section class="content invoice">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                <i class="fa fa-medkit"></i> {{ $laboratory->code }}
                <small class="pull-right">Tgl: {{ date('d-m-Y', strtotime($laboratory->registrationtime)) }}</small>
            </h2>                            
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>Balai Besar Laboratorium Kesehatan Makassar</strong><br>
                Jl. Perintis Kemerdekaan<br>
                Makassar, Sulawesi Selatan<br>
                Telepon: (0411) 123-5432<br/>
                Fax: (0411) 123-5432
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Kepada:
            <address>
                <strong>{{ $laboratory->billing->financer->name }}</strong><br>
                {{ $laboratory->billing->financer->address }}<br>
                {{ $laboratory->billing->financer->phone }}
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Tagihan #{{ $laboratory->billing->id }}</b><br/>
            <b>Nomor Lab:</b> {{ $laboratory->code }}<br/>
            <b>Tgl Pendaftaran:</b> {{ $laboratory->registrationtime }}<br/>
            <b>Loket:</b> {{ $laboratory->employee->name }}
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kode Layanan</th>
                        <th>Nama Layanan</th>
                        <th>Subtotal</th>
                    </tr>                                    
                </thead>
                <tbody>
                    @foreach($laboratory->choices as $choice)
                    <tr>
                        <td>{{ $choice->examinable->code }}</td>
                        <td>{{ $choice->examinable->name }}</td>
                        <td>Rp{{ number_format($choice->examinable->price,2,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>                            
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-xs-6 col-xs-offset-6">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rp{{ number_format($laboratory->billing->cost,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <th>Biaya Konsul:</th>
                        <td>Rp{{ number_format($laboratory->billing->fee,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <th>Total Biaya:</th>
                        <td>Rp{{ number_format($total = $laboratory->billing->cost + $laboratory->billing->fee,2,',','.') }}</td>
                    </tr>
                </table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-info pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</section>
@endif

{{ HTML::script('assets/js/plugins/scrollpane/jquery.jscrollpane.min.js') }}
{{ HTML::script('assets/js/plugins/scrollpane/jquery.mousewheel.js') }}
{{ HTML::script('assets/js/plugins/scrollpane/mwheelIntent.js') }}

<script type="text/javascript">
    $(function(){
        $('panel-body').jScrollPane();
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });
    })
</script>
@stop