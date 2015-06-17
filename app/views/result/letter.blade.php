@extends('layout/base')

@section('content')

<section class="content invoice">
    <div class="row">
        <div class="col-xs-2">
            <div class="husada">
                {{ HTML::image('assets/img/baktihusada.png') }}
            </div>                         
        </div>
        <div class="col-xs-10">
        	<div class="kop">
                <p>
                    <strong>KEMENTERIAN KESEHATAN  RI</strong><br/>
                    <strong>DIREKTORAT JENDERAL BINA UPAYA KESEHATAN</strong><br/>
                    <strong>BALAI BESAR LABORATORIUM KESEHATAN MAKASSAR</strong>
                </p>
                <i>Jl. Perintis Kemerdekaan KM. 11 Tamalanrea Makassar 90245</i>  
            </div>
        </div>
        <div class="col-xs-12"><div class="page-header"></div></div>
    </div>

    <div class="row invoice-info">
        <small>
            <div class="col-xs-12 detail-col">
                <p>
                    Nomor: {{ $laboratory->code }}/LHU/BBLK-MKS/{{ date('m/Y', strtotime($laboratory->registrationtime)) }}<br/>
                    Lamp: - <br/>
                    Hal : Laporan Hasil Pemeriksaan:<br/>
                    @foreach($laboratory->choices as $choice)
                        {{ '              '.$choice->examinable->name }}
                    @endforeach
                </p>
            </div>
        </small>

        <small>
            <div class="col-xs-12 detail-col">
                <p class="destination">
                    Kepada:<br/>
                    <strong>{{ $laboratory->registrant->name }}</strong><br/>
                    Di,-<br/>
                    <strong>{{ $laboratory->registrant->address }}</strong><br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $laboratory->registrant->city->name }}</strong><br/>
                </p>
            </div>
        </small>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
                Bersama ini, kami sampaikan hasil pemeriksaan terhadap sampel @foreach($laboratory->samplings as $sampling) {{ $sampling->name }} @endforeach yang diserahkan oleh {{ $laboratory->registrant->name }}, dengan hasil pemeriksaan sebagai berikut:
            </p>
        </div>
    </div>

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12">
            <small>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th><span class="text-center">Parameter</span></th>
                            <th>Satuan</th>
                            <th>Hasil Pemeriksaan</th>
                            <th>Nilai Rujukan</th>
                        </tr>                                    
                    </thead>
                    <tbody>
                        @foreach($laboratory->choices as $choice)
                            @foreach($choice->examinations as $examination)
                                @foreach($examination->results as $result)
                                    <tr>
                                        <td>{{ $result->parameter->name }}</td> 
                                        <td>{{ $result->parameter->unit }}</td>
                                        <td>{{ $result->result }}</td>
                                        <td><small><small>{{ $result->normal }}</small></small></td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </small>                            
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
                Demikian penyampaian kami, atas kerjasamanya diucapkan terima kasih.
            </p>
        </div>
    </div>

    <div class="row invoice-info">
    	<div class="col-lg-8 left-footer-col"></div>
        <div class="col-lg-4 right-footer-col ">
            <small> 
                <p>
                    Makassar, {{ date('d-m-Y') }}<br/>
                    Deputi Manajer Teknik
                </p>
                <br/><br/><br/>
                <p id="employeeArea">
                    <strong><u>Nama Pegawai</u></strong><br/>
                    NIP: xxxxxxxxxxxxxxxxxxx<br/>
                </p>
            </small>
        </div>
    </div>

   	<br/>
    <div class="row">
        <div class="col-xs-6">
           <small>
                <p>
                    Telp. 0411 586458 - 586457 - 586270 - Fax. 0411-586270<br/>
                    Surat Elektronik : bblk_makassar@yahoo.com
                </p>  
           </small>
        </div>
        <div class="col-xs-6">
           <div class="pull-right">
           		{{ HTML::image('assets/img/kan.jpg') }}
           </div>
        </div>
    </div>

    <div class="row no-print">
    	<div class="col-lg-5">
    		<select class="form-control" id="selectEmployee" onchange="selectEmployee()">
    			<option value="">--Pilih Deputi Manajer Teknik</option>
    			@foreach($employees as $employee)
    				<option value="{{ $employee->code }}">{{ $employee->name }}</option>
    			@endforeach
    		</select>
    	</div>
        <div class="col-lg-2 col-lg-offset-5">
            <button class="btn btn-default pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</section>

<script type="text/javascript">
	function selectEmployee()
	{
		var name = $('#selectEmployee > option:selected').text();
		var code = $('#selectEmployee').val();
		var html = "<strong><u>"+name+"</u></strong><br/>";
		html += "NIP : "+code;
		$('#employeeArea').html(html);
	}
</script>
@stop