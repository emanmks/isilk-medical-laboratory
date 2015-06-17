@extends('layout/base')

@section('content')

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
   	
    <div class="row invoice-info">
        <div class="col-lg-3">
           
        </div>
        <div class="col-lg-6">
           	<p class="text-center">
           		<strong><u>LAPORAN HASIL UJI</u></strong><br/>
           		<span>No : {{ $laboratory->code }}/LHU/BBLK-MKS/{{ date('m/Y', strtotime($laboratory->registrationtime)) }}</span>
           	</p>
        </div>
        <div class="col-lg-3">
            
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-lg-3 detail-col">
            <p>
            	Nama Costumer<br/>
            	Alamat<br/>
            	Sampel<br/>
            	Tanggal Pendaftaran<br/>
            	Pengirim<br/>
            </p>
        </div>
        <div class="col-lg-9 content-col">
           	<p>
           		:  <strong>{{ $laboratory->registrant->name }}</strong><br/>
           		:  <strong>{{ $laboratory->registrant->address }}</strong><br/>
           		:   
           		<strong>
           			@foreach($laboratory->samplings as $sampling)
           				{{ $sampling->code }}[{{ $sampling->speciment->name }}]&nbsp;&nbsp;&nbsp;
           			@endforeach
           		</strong><br/>
           		:  <strong>{{ date('d-m-Y', strtotime($laboratory->registrationtime)) }}</strong><br/>
           		:  <strong>{{ $laboratory->recommender }}</strong>
           	</p>
        </div>
        
    </div>

    <br/>

    <!-- Table row -->
    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="15%"><span class="text-center">Parameter</span></th>
                        <th width="5%">Satuan</th>
                        <th width="20%">Hasil Pemeriksaan</th>
                        <th width="20%">Nilai Normal</th>
                        <th width="20%">Regulasi</th>
                        <th width="20%">Metode</th>
                    </tr>                                    
                </thead>
                <tbody>
                    @foreach($laboratory->choices as $choice)
                    	@foreach($choice->examinations as $examination)
                    	<tr>
                    		<td><strong>{{ $examination->service->name }}</strong></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    	</tr>
                    	@foreach($examination->results as $result)
                			<tr>
                				<td>{{ $result->parameter->name }}</td>
	                			<td>{{ $result->parameter->unit }}</td>
	                			<td>{{ $result->result }}</td>
	                			<td>{{ $result->normal }}</td>
	                			<td>{{ $result->regulation }}</td>
	                			<td>{{ $result->method }}</td>
                			</tr>
                		@endforeach
                    	@endforeach
                    @endforeach
                </tbody>
            </table>                            
        </div>
    </div>

    <div class="row invoice-info">
    	<div class="col-lg-8 left-footer-col"></div>
        <div class="col-lg-4 right-footer-col ">
            <p>
            	Makassar, {{ date('d-m-Y') }}<br/>
            	Deputi Manajer Teknik
            </p>
            <br/><br/><br/>
            <p id="employeeArea">
            	<strong><u>Nama Pegawai</u></strong><br/>
            	NIP: xxxxxxxxxxxxxxxxxxx<br/>
            </p>
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
    	<div class="col-lg-5">
    		<select class="form-control" id="selectEmployee" onchange="selectEmployee()">
    			<option value="">--Pilih Deputi Manajer Teknik</option>
    			@foreach($employees as $employee)
    				<option value="{{ $employee->code }}">{{ $employee->name }}</option>
    			@endforeach
    		</select>
    	</div>
        <div class="col-lg-2 col-lg-offset-5">
            <button class="btn btn-info pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
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