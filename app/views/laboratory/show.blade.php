@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        Rangkuman Pendaftaran
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="{{ URL::to('pendaftaran') }}"><i class="active"></i> Pendaftaran</a></li>
    </ol>
</section>

<section class="content invoice">
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
                            <th width="30%"></th>
                            <th>
                                <center>
                                    <i class="fa fa-files-o"></i>  Bukti Pendaftaran Nomor : <strong>{{ $laboratory->code }}</strong>
                                </center>
                            </th>
                            <th width="30%"><small class="pull-right">Tanggal : {{ date('d-m-Y', strtotime($laboratory->registrationtime)) }}</small></th>
                        </tr>
                    </thead>
                </table>
            </small>
        </div>
    </div>

    <div class="row">
        @if($laboratory->registrant_type == 'Patient')
            <div class="col-xs-12">
                <small>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="success">
                                <th colspan="3"><center>Detail Pendaftar</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="33%">
                                    <small>Nomor Pasien</small><br/>
                                    {{ $laboratory->registrant->code }}<br/>
                                    <small>Nama Lengkap</small><br/>
                                    {{ $laboratory->registrant->name }}<br/>
                                </td>
                                <td width="33%">
                                    <center>
                                        <small>Jenis Kelamin</small><br/>
                                        {{ $laboratory->registrant->sex }}<br/>
                                        <small>Tgl Lahir</small><br/>
                                        {{ date('d-m-Y', strtotime($laboratory->registrant->birthdate)) }} / {{ floor((time() - strtotime($laboratory->registrant->birthdate)) / 31556926 ) }}<br/>
                                    </center>
                                </td>
                                <td width="34%">    
                                    <small class="pull-right">Kota Asal</small><br/>
                                    <span class="pull-right">{{ $laboratory->registrant->city->name }}</span><br/>
                                    <small class="pull-right">Alamat & Kontak</small><br/>
                                    <span class="pull-right">{{ $laboratory->registrant->address }}, {{ $laboratory->registrant->contact }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </small>
            </div>
        @elseif($laboratory->registrant_type == 'Office')
            <small>
                <div class="col-xs-6">
                    <small>Nama Kantor</small><br/>
                    {{ $laboratory->registrant->name }}<br/>
                    <small>Kontak</small><br/>
                    Telepon: {{ $laboratory->registrant->phone }}, Fax: {{ $laboratory->registrant->fax }}
                </div>
                <div class="col-xs-6">
                    <div class="pull-right">
                        <small>Kota Asal</small><br/>
                        {{ $laboratory->registrant->city->name }}<br/>
                        <small>Alamat Lengkap</small><br/>
                        {{ $laboratory->registrant->address }}
                    </div>
                </div>
            </small>
        @endif
    </div>

    <br/>

    <div class="row">
        <div class="col-xs-12">
            <small>
                <table class="table table-condensed">
                    <thead>
                        <tr class="success">
                            <th colspan="3"><center>Pilihan Paket Pemeriksaan</center></th>
                        </tr>
                        <tr class="warning">
                            <th width="30%">Kode</th>
                            <th width="30%"><center>Nama Pemeriksaan</center></th>
                            <th width="30%"><span class="pull-right">Tarif</span></th>
                        </tr>
                        @foreach($laboratory->choices as $choice)
                            <tr>
                                <th>{{ $choice->examinable->code }}</th>
                                <th><center>{{ $choice->examinable->name }}</center></th>
                                <th><span class="pull-right">Rp{{ number_format($choice->examinable->price,2,",",".") }}</span></th>
                            </tr>
                        @endforeach
                    </thead>
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
                            <th colspan="3"><center>Spesimen yang dibutuhkan</center></th>
                        </tr>
                        <tr class="warning">
                            <th width="30%">Nomor Spesimen</th>
                            <th width="30%"><center>Jenis Spesimen</center></th>
                            <th width="30%"><span class="pull-right">Ambil</span></th>
                        </tr>
                        @foreach($laboratory->samplings as $sampling)
                            <tr>
                                <th>{{ $sampling->code }}</th>
                                <th><center>{{ $sampling->speciment->name }}</center></th>
                                <th>
                                    @if($sampling->taken == 1)
                                        <span class="pull-right">Ya</span>
                                    @else
                                        <span class="pull-right">Belum</span>
                                    @endif
                                </th>
                            </tr>
                        @endforeach
                    </thead>
                </table>
            </small>
        </div>
    </div>

    <div class="row">
        <small>
            <div class="col-xs-12">
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
                        @foreach($laboratory->earning as $earning)
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
                        @endforeach
                    </tbody>
                </table>      
            </div>
        </small>
    </div>

    <br/><br/>

    <div class="row">
        <small>
            <div class="col-xs-11">
                <div class="pull-right">
                    Front Office<br/><br/><br/>
                    {{ $laboratory->employee->name }} 
                </div> 
            </div>
            <div class="col-xs-1"></div>
        </small>
    </div>

    <div class="row no-print">
        <div class="col-xs-12">
            @foreach($laboratory->earning as $earning)
                <a href="{{ URL::to('penerimaan') }}/{{ $earning->id }}" class="btn btn-default"><i class="fa fa-money"></i> Kwitansi</a>
            @endforeach
            @if($laboratory->invoice)
                <a href="{{ URL::to('tagihan') }}/{{ $laboratory->invoice->id }}" class="btn btn-default"><i class="fa fa-money"></i> Invoice</a>
            @endif
            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Cetak</button>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
@stop