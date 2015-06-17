@extends('layout/base')

@section('content')

{{ HTML::style('assets/css/daterangepicker/daterangepicker-bs3.css') }}

<section class="content invoice">
    <!--<div class="row">
        <div class="col-lg-2">
            {{ HTML::image('assets/img/baktihusada.png') }}                         
        </div>
        <div class="col-lg-10">
        	<h3>KEMENTERIAN KESEHATAN  RI</h3>
        	<h4>DIREKTORAT JENDERAL BINA UPAYA KESEHATAN</h4>
        	<h4>BALAI BESAR LABORATORIUM KESEHATAN MAKASSAR</h4>
        	<p>Jl. Perintis Kemerdekaan KM. 11 Tamalanrea Makassar 90245</p>
        </div>
    </div>-->

    <div class="row no-print">
        <div class="col-lg-8 col-lg-offset-4">
            <form class="form-inline" method="POST" action="{{ URL::to('laporan/pemeriksaan/individu') }}">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" class="form-control pull-right" id="filterPeriods" name="periods">
                        <span class="input-group-btn">
                            <button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-filter"></i> Filter Periode Laporan</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
   	
    <div class="row invoice-info">
        <div class="col-lg-3">
           
        </div>
        <div class="col-lg-6">
           	<p class="text-center">
           		<strong><u>LAPORAN PEMERIKSAAN PASIEN (Manusia)</u></strong><br/>
                Periode : {{ date('d-m-Y', strtotime($from)) }} s/d {{ date('d-m-Y', strtotime($to)) }}
           	</p>
        </div>
        <div class="col-lg-3">
            
        </div>
    </div>

    <br/>

    <!-- Table row -->
    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nomor Lab</th>
                        <th>Tanggal</th>
                        <th>Nomor Pasien</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                    </tr>                                    
                </thead>
                <tbody>
                    @foreach($laboratories->getCollection() as $laboratory)
                        <tr>
                            <td><strong>{{ $laboratory->code or '' }}</strong></td>
                            <td>{{ date('d-m-Y', strtotime($laboratory->created_at)) }}</td>
                            <td>{{ $laboratory->registrant->code or '' }}</td>
                            <td>{{ $laboratory->registrant->name or '' }}</td>
                            <td>{{ $laboratory->registrant->address or '' }}</td>
                            <td>{{ $laboratory->registrant->phone or '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>                            
        </div>
    </div>

   	<br/>
    <!--<div class="row">
        <div class="col-lg-6">
           <p>Telp. 0411 586458 - 586457 - 586270 - Fax. 0411-586270</p>
           <p>Surat Elektronik : bblk_makassar@yahoo.com</p>
        </div>
        <div class="col-lg-6">
           <div class="pull-right">
           		{{ HTML::image('assets/img/kan.jpg') }}
           </div>
        </div>
    </div>-->

    <div class="row no-print">
    	<div class="col-lg-10">
    		{{ $laboratories->links() }}
    	</div>
        <div class="col-lg-2">
            <button class="btn btn-info pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</section>

{{ HTML::script('assets/js/plugins/daterangepicker/daterangepicker.js') }}

<script type="text/javascript">
	$(function(){
        $('#filterPeriods').daterangepicker({
            format:'YYYY-MM-DD'
        });
    });
</script>
@stop