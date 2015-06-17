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
        <div class="col-xs-3">
           
        </div>
        <div class="col-xs-6">
            <p class="text-center">
              <strong><u>LAPORAN HASIL UJI</u></strong><br/>
              <span>No : {{ $laboratory->code }}/LHU/BBLK-MKS/{{ date('m/Y', strtotime($laboratory->registrationtime)) }}</span>
            </p>
        </div>
        <div class="col-xs-3">
            
        </div>
    </div>

    <div class="row invoice-info">
        <small>
            <div class="col-xs-3 detail-col">
                <p>
                    Nama Costumer<br/>
                    Alamat<br/>
                    Sampel<br/>
                    Tanggal Pendaftaran<br/>
                    Pengirim<br/>
                </p>
            </div>
            <div class="col-xs-9 content-col">
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
                    :  <strong>{{ $laboratory->recommender_name }}</strong>
                </p>
            </div>
        </small>
    </div>

    <div class="row"></div>

    <!-- Table row -->
    <div class="row">
        <div class="col-lg-12 invoice-info">
            @foreach($laboratory->samplings as $sampling)
                Spesiment : <strong>{{ $sampling->speciment->name }}</strong><br/>
                @foreach($sampling->examinations as $examination)
                    <div class="col-lg-1"></div>
                    <div class="col-lg-11">
                        <strong>{{ $examination->service->name }}</strong><br/>
                        @foreach($examination->results as $result)
                        <ul>
                            <li><i>{{ $result->parameter->name }}</i> : {{ $result->result }} {{ $result->parameter->unit }}</li>
                        </ul>
                        @endforeach
                    </div>
                @endforeach
                <br/>
            @endforeach                 
        </div>
    </div>

    <div class="row invoice-info">
        <small>
            <div class="col-xs-1 detail-col">
                <p>Catatan</p>
            </div>
            <div class="col-xs-10 content-col">
                <p>
                    :  <i>Hasil ini berlaku untuk sampel yang diuji</i><br/>
                    :  <i>Laporan Hasil Uji ini terdiri dari 1 halaman</i><br/>
                    :  <i>Laporan hasil uji ini tidak boleh digandakan kecuali secara lengkap dan seizin tertulis Laboratorium Penguji</i><br/>
                </p>
            </div>
        </small>
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