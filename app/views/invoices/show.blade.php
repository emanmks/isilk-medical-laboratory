@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        Invoice
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Keuangan</a></li>
        <li><a href="{{ URL::to('penerimaan') }}"><i class="active"></i> Invoice</a></li>
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
                                <th><i class="fa fa-files-o"></i>  Invoice Nomor : #{{ $invoice->code }}</th>
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
                            <td>
                                Ditagihkan Kepada:
                                <address>
                                    <strong>{{ $invoice->laboratory->registrant->name }}</strong><br/>
                                    Alamat: {{ $invoice->laboratory->registrant->address }}, {{ $invoice->laboratory->registrant->city->name }}<br/>
                                    Kontak: {{ $invoice->laboratory->registrant->phone }} / Fax: {{ $invoice->laboratory->registrant->fax }}
                                </address>
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
                                <th colspan="2"><center>Rincian Tagihan</center></th>
                            </tr>
                            <tr class="warning">
                                <th>Keterangan</th>
                                <th><div class="pull-right">Jumlah</span></th>
                            </tr>   
                        </thead>

                        <tbody>
                            <tr>
                                <td>Beban Biaya Pemeriksaan</td>
                                <td><strong class="pull-right">Rp{{ number_format($invoice->costs,2,",",".") }}</strong></td>
                            </tr>
                            <tr>
                                <td>Biaya Konsul</td>
                                <td><strong class="pull-right">Rp{{ number_format($invoice->fee,2,",",".") }}</strong></td>
                            </tr>
                            <tr>
                                <td>Pajak</td>
                                <td><strong class="pull-right">{{ $invoice->tax }}%</strong></td>
                            </tr>
                            <tr>
                                <td>Total Biaya yang Dibebankan</td>
                                <td><strong class="pull-right">Rp{{ number_format($invoice->total,2,",",".") }}</strong></td>
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
                        <span>{{ $invoice->laboratory->employee->name }}</span>      
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