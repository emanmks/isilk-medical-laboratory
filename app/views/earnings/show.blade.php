@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        Kwitansi Pembayaran
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Keuangan</a></li>
        <li><a href="{{ URL::to('penerimaan') }}"><i class="active"></i> Penerimaan</a></li>
    </ol>
</section>

<section class="content invoice">

    <small>

        <div class="row">
            <div class="col-xs-12">
                <p>
                    <h4><strong>Balai Besar Laboratorium Kesehatan Makassar</strong></h4>
                    <small>
                        Kementerian Kesehatan Republik Indonesia<br/>
                        Jl. Perintis Kemerdekaan<br>
                        Makassar, Sulawesi Selatan<br>
                        Telepon: (0411) 123-5432<br/>
                        Fax: (0411) 123-5432
                    </small>
                </p>
            </div>    
        </div>

        <div class="row">
             <div class="col-xs-12">
                <small>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="success">
                                <th><i class="fa fa-files-o"></i>  Kwitansi Pembayaran Nomor : #{{ $earning->code }}</th>
                                <th><small class="pull-right">Tanggal Cetak : {{ date('d-m-Y H:i:s') }}</small></th>
                            </tr>
                        </thead>
                    </table>
                </small>
            </div>
        </div>

        <div class="row invoice-info">
            <div class="col-xs-12">
                <small>
                    <table class="table table-condensed">
                        <tr>
                            <td width="34%">
                                Terima Dari:
                                <address>
                                    <strong>{{ $earning->earnable->registrant->name }}</strong><br/>
                                    Nomor Pasien: {{ $earning->earnable->registrant->code }}<br/>
                                </address>
                            </td>
                            <td width="33%">
                                <center>
                                    Diterima Oleh:<br/>
                                    <strong>{{ $earning->earnable->employee->name }}</strong><br/>
                                </center>
                            </td>
                            <td width="33%">
                                <div class="pull-right">
                                    Pada:<br/>
                                    <strong>{{ date('d-m-Y', strtotime($earning->earnable->registrationtime)) }}</strong>
                                </div>
                            </td>
                        </tr>
                    </table> 
                </small>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <small>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="success">
                                <th colspan="2"><center>Biaya</center></th>
                            </tr>
                            <tr class="warning">
                                <th>Keterangan</th>
                                <th><div class="pull-right">Jumlah</span></th>
                            </tr>   
                        </thead>

                        <tbody>
                            <tr>
                                <td>Beban Biaya Pemeriksaan</td>
                                <td><strong class="pull-right">Rp{{ number_format($earning->costs,2,",",".") }}</strong></td>
                            </tr>
                            <tr>
                                <td>Biaya Konsul</td>
                                <td><strong class="pull-right">Rp{{ number_format($earning->fee,2,",",".") }}</strong></td>
                            </tr>
                            <tr>
                                <td>Pajak</td>
                                <td><strong class="pull-right">{{ $earning->tax }}%</strong></td>
                            </tr>
                            <tr>
                                <td>Total Biaya yang Dibebankan</td>
                                <td><strong class="pull-right">Rp{{ number_format($earning->total,2,",",".") }}</strong></td>
                            </tr>
                        </tbody>
                    </table>  
                </small>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-8"></div>
            <div class="col-xs-3">
                <small>
                    <center>
                        <span>Makassar, {{ date('d-m-Y') }}</span><br/><br/><br/>
                        <span>{{ $earning->earnable->employee->name }}</span>      
                    </center>      
                </small>
            </div>
            <div class="col-xs-1"></div>
        </div>

    </small>

    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
@stop