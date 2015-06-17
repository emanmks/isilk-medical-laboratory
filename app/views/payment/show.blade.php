@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/plugins/dataTables/dataTables.bootstrap.css') }}

<section class="content-header">
    <h1>
        Data Penerimaan Biaya Pemeriksaan
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Keuangan</a></li>
        <li><a href="{{ URL::to('pembayaran') }}"><i class="active"></i> Penerimaan</a></li>
    </ol>
</section>

<section class="content invoice">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                <i class="fa fa-medkit"></i> {{ $payment->laboratory->code }}
                <small class="pull-right">Tgl: {{ date('d-m-Y', strtotime($payment->laboratory->registrationtime)) }}</small>
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
                <strong>{{ $payment->laboratory->registrant->name }}</strong><br>
                {{ $payment->laboratory->registrant->address }}<br>
                {{ $payment->laboratory->registrant->phone }}
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Kwitansi #{{ $payment->laboratory->payment->id }}</b><br/>
            <b>Nomor Lab:</b> {{ $payment->laboratory->code }}<br/>
            <b>Tgl Pendaftaran:</b> {{ $payment->laboratory->registrationtime }}<br/>
            <b>Kasir:</b> {{ $payment->laboratory->employee->name }}
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
                    @foreach($payment->laboratory->choices as $choice)
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
                        <td>Rp{{ number_format($payment->cost,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <th>Biaya Konsul:</th>
                        <td>Rp{{ number_format($payment->fee,2,',','.') }}</td>
                    </tr>
                    <tr>
                        <th>Total Biaya:</th>
                        <td>Rp{{ number_format($total = $payment->cost + $payment->fee,2,',','.') }}</td>
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
@stop