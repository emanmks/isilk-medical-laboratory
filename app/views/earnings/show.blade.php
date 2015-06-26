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

    <div class="row">
        <div class="col-lg-12">
            <p>
                <strong>Balai Besar Laboratorium Kesehatan Makassar</strong><br/>
                Kementerian Kesehatan Republik Indonesia<br/>
                <small>
                    Jl. Perintis Kemerdekaan<br>
                    Makassar, Sulawesi Selatan<br>
                    Telepon: (0411) 123-5432<br/>
                    Fax: (0411) 123-5432
                </small>
            </p>
        </div>    
    </div>

    <div class="row invoice-info">
        <div class="col-lg-12">
            <small>
                <table class="table table-condensed">
                    <tr>
                        <td width="70%">
                            Customer:

                            @if($earning->earnable->registrant_type == "Patient")
                                <address>
                                    <strong>
                                        {{ ucfirst(strtolower($earning->earnable->registrant->name)) }}<br/>
                                        #{{ $earning->earnable->registrant->code }}<br/>
                                    </strong>
                                    @if($earning->earnable->registrant->sex == 'L')
                                        Laki-laki
                                    @else
                                        Perempuan
                                    @endif
                                    <br/>
                                    {{ date('d-m-Y', strtotime($earning->earnable->registrant->birthdate)) }} , Usia: {{ floor((time() - strtotime($earning->earnable->registrant->birthdate)) / 31556926 ) }}<br/>
                                    {{ $earning->earnable->registrant->address }}<br/>
                                    {{ $earning->earnable->registrant->contact }}<br/>
                                    {{ $earning->earnable->registrant->city->name or '' }}<br/>
                                </address>
                            @elseif($earning->earnable->registrant_type == "Office")
                                <address>
                                    <strong>
                                        {{ $earning->earnable->registrant->name }}<br/>
                                    </strong>
                                    {{ $earning->earnable->registrant->address }}<br/>
                                    {{ $earning->earnable->registrant->phone }}<br/>
                                    {{ $earning->earnable->registrant->fax }}<br/>
                                </address>
                            @endif   
                        </td>
                        <td width="30%">
                            <br/>
                            <address>
                                Nomor Kwitansi : <strong>#{{ $earning->code }}</strong><br/>
                                Nomor Lab : <strong>#{{ $earning->earnable->code }}</strong><br/>
                                Pendaftaran : <strong>{{ date("d/m/Y H:i:s", strtotime($earning->earnable->registrationtime)) }}</strong><br/>
                                Cetak : <strong>{{ date("d/m/Y H:i:s", strtotime($earning->earnable->registrationtime)) }}</strong><br/>
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
                <table class="table table-bordered">
                    <thead>
                        <tr class="success" style="height: 10px; overflow:auto;">
                            <th colspan="3"><center>RINCIAN BIAYA</center></th>
                        </tr>
                        <tr class="warning" style="height: 10px; overflow:auto;">
                            <th width="20%"><center>Kode</center></th>
                            <th width="47%"><center>Nama Pemeriksaan</center></th>
                            <th width="33%"><span class="pull-right">Tarif</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($earning->earnable->choices as $choice)
                            <tr style="height: 8px; overflow:auto;">
                                <th><center>{{ $choice->examinable->code }}</center></th>
                                <th>{{ $choice->examinable->name }}</th>
                                <th><span class="pull-right">Rp{{ number_format($choice->examinable->price,2,",",".") }}</span></th>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="height: 7px; overflow:auto;">
                            <td colspan="2" class="text-right" style="border-top:0">Beban Biaya Pemeriksaan</td>
                            <td style="border-top:0"><strong class="pull-right">Rp{{ number_format($earning->costs,2,",",".") }}</strong></td>
                        </tr>
                        <tr style="height: 7px; overflow:auto;">
                            <td colspan="2" class="text-right" style="border-top:0">Biaya Konsul</td>
                            <td style="border-top:0"><strong class="pull-right">Rp{{ number_format($earning->fee,2,",",".") }}</strong></td>
                        </tr>
                        <tr style="height: 7px; overflow:auto;">
                            <td colspan="2" class="text-right" style="border-top:0">Total Biaya yang Dibebankan</td>
                            <td style="border-top:0; border-bottom: 1 double"><strong class="pull-right">Rp{{ number_format($earning->total,2,",",".") }}</strong></td>
                        </tr>
                    </tfoot>
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


    <div class="row no-print">
        <div class="col-lg-12">
            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
@stop