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
                                <th><i class="fa fa-files-o"></i>  SPU Nomor : #{{ $invoice->code }}</th>
                                <th><small class="pull-right">Tanggal Cetak : {{ date('d-m-Y H:i:s') }}</small></th>
                            </tr>
                        </thead>
                    </table>
                </small>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <center><h3>SURAT PERNYATAAN UTANG</h3></center>
                <p>Saya yang bertanda tangan di bawah ini:</p>
            </div>
        </div>

        <div class="row invoice-info small">
            <div class="col-lg-4">
                <p>
                    Nama <br/>
                    No. KTP/Identitas Lainnya <br/>
                    Alamat Sesuai Identitas <br/>
                    Alamat Tempat Tinggal <br/>
                    No. Telp/Hp <br/>
                </p>
            </div>
            <div class="col-lg-8">
                <p>
                    : {{ $invoice->guarantor_name }} <br/>
                    : {{ $invoice->guarantor_id_card }} <br/>
                    : {{ $invoice->guarantor_id_address }} <br/>
                    : {{ $invoice->guarantor_address }} <br/>
                    : {{ $invoice->guarantor_contact }} <br/>
                </p>
            </div>
            <p>Sebagai penanggung jawab atas pasien / perusahaan / instansi:</p>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <p>
                    ID Pasien <br/>
                    Nama <br/>
                    Alamat <br/>
                    Nomor Lab <br/>
                    Tgl Kunjungan <br/>
                    Jenis Sampel <br/>
                    Parameter Uji
                </p>
            </div>
            <div class="col-lg-8">
                <p>
                    : {{ $invoice->laboratory->registrant->code or '' }} <br/>
                    : {{ $invoice->laboratory->registrant->name or '' }} <br/>
                    : {{ $invoice->laboratory->registrant->address or ''}} <br/>
                    : {{ date('d/m/Y', strtotime($invoice->laboratory->registration_time)) }} <br/>
                    : @foreach($invoice->laboratory->samplings as $sampling)
                        {{ $sampling->speciment->name }}
                    @endforeach <br/>
                    : @foreach($invoice->laboratory->choices as $choice)
                        {{ $choice->name }}
                    @endforeach
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <p>
                    Jumlah Biaya Pemeriksaan <br/>
                    Jumlah yang telah dibayar <br/>
                    Jumlah yang belum dibayar
                </p>
            </div>
            <div class="col-lg-8">
                <p>
                    : Rp {{ number_format($invoice->total,2,",",".") }} <br/>
                    : Rp {{ number_format($invoice->total - $invoice->balance,2,",",".") }} <br/>
                    : Rp {{ number_format($invoice->balance,2,",",".") }} 
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <p>
                    Menyatakan bahwa saya memiliki utang kepada Balai Besar Laboratorium Kesehatan Makassar sebesar
                    Rp {{ number_format($invoice->balance,2,",",".") }} 
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <p>Demikian surat pernyataan ini saya buat dengan sebenar-benarnya :</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-7">
                <small>
                    Mengetahui,<br/>
                    Petugas BBLK <br/><br/><br/><br/>
                    {{ $invoice->laboratory->employee->name }}
                </small>
            </div>
            <div class="col-lg-3">
                <small>
                    <center>
                        Makassar, {{ date('d-m-Y') }}<br/>
                        Pembuat Pernyataan <br/><br/><br/><br/>
                        {{ $invoice->guarantor_name }}      
                    </center>      
                </small>
            </div>
            <div class="col-lg-1"></div>
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