@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/iCheck/flat/blue.css') }}
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1 id="code">
        <i class="fa fa-file"></i>
        Form Pendaftaran
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Laboratorium</a></li>
        <li><a href="{{ URL::to('laboratorium/create') }}"><i class="active"></i> Pendaftaran</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-6">
            <input type="radio" name="patient" value="patient" onclick="changePatient()" checked>&nbsp;&nbsp;&nbsp;<strong class="text-info">Pasien Biasa</strong>
        </div>
        <div class="col-lg-6">
            <div class="pull-right">
                <input type="radio" name="patient" value="office" onclick="changePatient()">&nbsp;&nbsp;&nbsp;<strong class="text-info">Kantor/Instansi</strong>
            </div>
        </div>
    </div>

    <div class="row"><br/></div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="recommender">Dikirim Oleh</label><br/>
                            <input type="radio" name="recommender" value="1">&nbsp;&nbsp;Dokter&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="recommender" value="2">&nbsp;&nbsp;Institusi&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="recommender" value="3" checked>&nbsp;&nbsp;Pasien/Kantor 
                        </div>
                        <div class="col-md-6">
                            <label for="recommender">Masukkan Nama Pengirim</label><br/>
                            <input type="text" id="recommender_name" name="recommender_name" class="form-control input-sm" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="box_of_patient">
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissable" id="notification"></div>
        </div>

        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="pull-right box-tools"><button id="btn-save-patient" onclick="createPatient()" class="btn btn-flat btn-primary" data-toggle="tooltip" data-placement="left" title="Simpan Pasien Baru"><i class="fa fa-floppy-o"></i></button></div>
                    <div class="box-title">Pasien</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="patient_code">Nomor Pasien</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                <input type="hidden" name="patient_id">
                                <input type="text" class="form-control input-sm" name="patient_code" disabled>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="patient_name">Nama Pasien</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-sm" name="patient_name" placeholder="Cari Data Pasien">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="patient_sex">Jenis Kelamin</label><br/>
                            <input type="radio" id="patient_sex_l" name="patient_sex" value="L" checked>&nbsp;&nbsp;L&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="patient_sex_p" name="patient_sex" value="P">&nbsp;&nbsp;P
                        </div>
                        <div class="col-md-2">
                            <label for="patient_birthdate">Tgl Lahir</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-sm" name="patient_birthdate" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row"><br/></div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="patient_city">Kota Asal</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="hidden" name="patient_city_id">
                                <input type="text" class="form-control input-sm" name="patient_city">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="patient_address">Alamat</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-road"></i></span>
                                <input type="text" class="form-control input-sm" name="patient_address">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="patient_contact">Kontak</label> <small>Nomor yg bisa dihubungi</small>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-sm" name="patient_contact">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12"><p><small>Dahulukan mencari data pasien, jika tidak ditemukan lakukan entry pasien baru</small></small></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="box_of_office">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="pull-right box-tools"><button id="btn-save-office" onclick="createOffice()" class="btn btn-flat btn-primary" data-toggle="tooltip" data-placement="left" title="Simpan Kantor/Instansi Baru"><i class="fa fa-floppy-o"></i></button></div>
                    <div class="box-title">Kantor / Instansi</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="patient_name">Nama Kantor / Instansi</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                <input type="hidden" name="office_id">
                                <input type="text" class="form-control input-sm" name="office_name" placeholder="Cari Data Kantor / Instansi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="patient_birthdate">Kota Asal Lokasi Kantor</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-sm" name="office_city">
                                <input type="hidden" name="office_city_id">
                            </div>
                        </div>
                    </div>
                    <div class="row"><br/></div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="patient_city">Alamat</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-road"></i></span>
                                <input type="text" class="form-control input-sm" name="office_address">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="patient_address">Kontak <small>Nomor yg bisa dihubungi</small></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-sm" name="office_phone">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="patient_contact">Fax</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fax"></i></span>
                                <input type="text" class="form-control input-sm" name="office_fax">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12"><p><small>Dahulukan mencari data kantor, jika tidak ditemukan lakukan entry kantor baru</small></small></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="box_of_payments">
        <div class="col-lg-12">
            <div class="box box-warning">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button class="btn btn-success btn-sm" onclick="register()" id="btn-register"><i class="fa fa-floppy-o"></i> &nbsp;Daftar!</button>
                                <button class="btn btn-default btn-sm" id="btn-summary" onclick="summary()"><i class="fa fa-file"></i> &nbsp;Summary!</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="costs">Jumlah Kelipatan Pemeriksaan</label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="multiplier" value="1">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-primary" onclick="incMultiplier()"><i class="fa fa-plus"></i></button>
                                    <button class="btn btn-sm btn-success" onclick="decMultiplier()"><i class="fa fa-minus"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="costs">Kapan Dibutuhkan?</label>
                            <div class="input-group">
                                <p>Jika pasien meminta pemeriksaan dilakukan dengan membandingkan lebih dari satu sampel</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row"><br/></div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="costs">Biaya Pemeriksaan</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control input-sm" name="costs" value="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="fee">Biaya Konsultasi</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control input-sm" name="fee" value="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="tax">Pajak</label>
                            <div class="input-group">
                                <span class="input-group-addon">%</span>
                                <input type="text" class="form-control input-sm" name="tax" value="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="total">Total Beban</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control input-sm" name="total" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row"><br/></div>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="payments">Cara Pembayaran</label><br/>
                            <input type="radio" name="payments" value="1" checked>&nbsp;&nbsp;Bayar Sekarang&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="payments" value="2">&nbsp;&nbsp;Bayar Nanti&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="payments" value="3">&nbsp;&nbsp;Asuransi                        
                        </div>
                        <div class="col-md-4">
                            <label for="financers">Asuransi</label>
                            <select class="form-control input-sm" name="financers" onchange="financerConditioning()" disabled>
                                <option value="0">--Pilih</option>
                                @foreach($financers as $financer)
                                    <option value="{{ $financer->id }}">{{ $financer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="total">ID Asuransi</label>
                            <div class="input-group">
                                <input type="text" name="insurance_id" class="form-control" disabled="">
                                <input type="hidden" name="laboratory_id">
                            </div>
                        </div>
                    </div>
                    <div class="row"><br/></div>
                    <div class="row" id="downpayment">
                        <div class="col-lg-3">
                            <label>Penanggung Jawab</label>
                            <input type="text" name="guarantor_name" value="" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>KTP/Identitas</label>
                            <input type="text" name="guarantor_id_card" value="" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Alamat Identitas</label>
                            <textarea name="guarantor_id_address" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-lg-3">
                            <label>Alamat Tinggal</label>
                            <textarea name="guarantor_address" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-lg-3">
                            <label>Telepon</label>
                            <input type="text" name="guarantor_contact" value="" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Down Payment</label>
                            <input type="text" name="downpayment" value="0" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="box_of_choices">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="regulations">Pilihan Referensi Nilai Rujukan</label>
                            <select class="form-control" name="regulations">
                                @foreach($regulations as $regulation)
                                    <option value="{{ $regulation->id }}">{{ $regulation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <strong class="text-primary">Paket Pemeriksaan</strong>
                    @foreach(array_chunk($packages->all(), 4) as $items)
                        <div class="row">
                            @foreach($items as $package)
                                <div class="col-md-3">
                                    <input type="checkbox" name="packages" value="{{ $package->id }}"> <small>{{ $package->name }}</small>
                                    <input type="hidden" name="package_{{ $package->id }}" value="{{ $package->price }}">
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    
                    @foreach($classifications as $classification)
                        @if($classification->services->count() > 0)
                            <strong class="text-primary">{{ $classification->name }}</strong><br/>
                            @foreach(array_chunk($classification->services->all(), 4) as $items)
                                <div class="row">
                                    @foreach($items as $service)
                                        <div class="col-md-3">
                                            <input type="checkbox" name="services" value="{{ $service->id }}"> <small>{{ $service->name }}</small>
                                            <input type="hidden" name="service_{{ $service->id }}" value="{{ $service->price }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach 
                        @endif

                        @foreach($classification->subclassifications as $item)
                            <strong class="text-primary">{{ $classification->name }}</strong><br/>
                            <strong class="text-primary">{{ $item->code }} - {{ $item->name }}</strong>
                            @foreach(array_chunk($item->services->all(), 4) as $items)
                                <div class="row">
                                    @foreach($items as $service)
                                        <div class="col-md-3">
                                            <input type="checkbox" name="services" value="{{ $service->id }}"> <small>{{ $service->name }}</small>
                                            <input type="hidden" name="service_{{ $service->id }}" value="{{ $service->price }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>

{{ HTML::script('assets/js/plugins/typeahead/bootstrap-typeahead.js') }}
{{ HTML::script('assets/js/plugins/iCheck/icheck.min.js') }}
{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}

<script type="text/javascript">
    var multiplier = 1;
    var costs = 0.00;

    $(function(){

        $('#downpayment').hide();

        $('#notification').hide();

        $('[name=patient_birthdate]').datepicker({format:"yyyy-mm-dd", autoclose:true});

        $('[name=multiplier]').val(multiplier);

        $('input').iCheck({
            checkboxClass:'icheckbox_flat-blue',
            radioClass:'iradio_flat-blue'
        });

        $('#box_of_patient').show();
        $('#box_of_office').hide();

        $('#box_of_choices').hide();
        $('#box_of_payments').hide();

        $('#btn-summary').hide();

        $('[name=patient]').on("ifClicked", function(){
            if(this.value == 'patient'){
                $('#box_of_patient').show();
                $('#box_of_office').hide();
            }else{
                $('#box_of_patient').hide();
                $('#box_of_office').show();
            }
        });

        $('[name=recommender]').on("ifClicked", function(){
            if(this.value == '1' || this.value == '2'){
                $('[name=recommender_name]').removeAttr('disabled');
            }else if(this.value == '3'){
                $('[name=recommender_name]').disabled = true;
            }
        });

        $('[name=payments]').on("ifClicked", function(){
            if(this.value == '3'){
                $('[name=financers]').removeAttr("disabled");
                $('[name=insurance_id]').removeAttr("disabled");
            }else if(this.value == '2'){
                $('#downpayment').show();
            }else{
                $('[name=financers]').disabled = false;
            }
        });

        $('[name=patient_name]').keypress(function(e){
            if(e.keyCode == 13 && this.value == ""){

                $('[name=patient_id]').val("0");
                $('[name=patient_code]').val("");
                $('[name=patient_name]').val("");
                $('[name=patient_birthdate]').val("");
                $('[name=patient_city]').val("");
                $('[name=patient_city_id]').val("0");
                $('[name=patient_contact]').val("");
                $('[name=patient_address]').val("");

                $('input[type="checkbox"]:checked').iCheck('uncheck');

                $('#box_of_choices').hide();

                $('#btn-save-patient').show();
            };
        });

        $('[name=office_name]').keypress(function(e){
            if(e.keyCode == 13 && this.value == ""){

                $('[name=office_id]').val("0");
                $('[name=office_name]').val("");
                $('[name=office_address]').val("");
                $('[name=office_phone]').val("");
                $('[name=office_fax]').val("");
                $('[name=office_city]').val("");
                $('[name=office_city_id]').val("0");

                $('input[type="checkbox"]:checked').iCheck('uncheck');

                $('#box_of_choices').hide();

                $('#btn-save-office').show();
            };
        });

        $('[name=patient_name]').typeahead({
            source : function(query, process){
                return $.get("{{ URL::to('caripasien') }}/"+query, function(response){
                    //response = $.parseJSON(response);
                    var sourceArr = []; 
                    for(var i = 0; i < response.length; i++)
                    {
                        sourceArr.push(
                            response[i].id +"#"+ response[i].code +"#"+ response[i].name +"#"+ response[i].sex +"#"+
                            response[i].birthdate +"#"+ response[i].address +"#"+ response[i].contact +"#"+
                            response[i].city_id +"#"+ response[i].city.name
                            );
                    }
                    return process(sourceArr);
                })
            },
            highlighter : function(item){
                var patient = item.split('#');
                var item = ''
                        + "<div class='typeahead_wrapper'>"
                        + "<span class='typeahead_photo fa fa-2x fa-user'></span>"
                        + "<div class='typeahead_labels'>"
                        + "<div class='typeahead_primary'>" + patient[2] + "</div>"
                        + "<div class='typeahead_secondary'>" + patient[1] + "</div>"
                        + "</div>"
                        + "</div>";
                return item;
            },
            updater : function(item){
                var patient = item.split('#');
                
                $('[name=patient_id]').val(patient[0]);
                $('[name=patient_code]').val(patient[1]);
                $('[name=patient_birthdate]').val(patient[4]);
                $('[name=patient_city]').val(patient[8]);
                $('[name=patient_city_id]').val(patient[7]);
                $('[name=patient_address]').val(patient[5]);
                $('[name=patient_contact]').val(patient[6]);
                
                if(patient[3] == 'P'){
                    $('#patient_sex_p').iCheck('check');
                }else if(patient[3] == 'L'){
                    $('#patient_sex_l').iCheck('check');
                }

                $('#btn-save-patient').hide();

                $('#box_of_choices').show();

                lockRegistrant();

                loadInsurances(patient[0]);
                
                return patient[2];
            }
        });

        $('[name=office_name]').typeahead({
            source : function(query, process){
                return $.get("{{ URL::to('carikantor') }}/"+query, function(response){
                    //response = $.parseJSON(response);
                    var sourceArr = []; 
                    for(var i = 0; i < response.length; i++)
                    {
                        sourceArr.push(
                            response[i].id +"#"+ response[i].name +"#"+ response[i].address +"#"+ response[i].phone +"#"+
                            response[i].fax +"#"+ response[i].city_id +"#"+ response[i].city.name
                            );
                    }
                    return process(sourceArr);
                })
            },
            highlighter : function(item){
                var office = item.split('#');
                var item = ''
                        + "<div class='typeahead_wrapper'>"
                        + "<span class='typeahead_photo fa fa-2x fa-building'></span>"
                        + "<div class='typeahead_labels'>"
                        + "<div class='typeahead_primary'>" + office[1] + "</div>"
                        + "<div class='typeahead_secondary'>" + office[2] + "</div>"
                        + "<div class='typeahead_secondary'>" + office[6] + "</div>"
                        + "</div>"
                        + "</div>";
                return item;
            },
            updater : function(item){
                var office = item.split('#');
                
                $('[name=office_id]').val(office[0]);
                $('[name=office_city]').val(office[6]);
                $('[name=office_city_id]').val(office[5]);
                $('[name=office_address]').val(office[2]);
                $('[name=office_phone]').val(office[3]);
                $('[name=office_fax]').val(office[4]);

                $('#btn-save-office').hide();

                $('#box_of_choices').show();

                lockRegistrant();
                
                return office[1];
            }
        });

        $('[name=patient_city]').typeahead({
            source : function(query, process){
                return $.get("{{ URL::to('carikota') }}/"+query, function(response){
                    //response = $.parseJSON(response);
                    var sourceArr = []; 
                    for(var i = 0; i < response.length; i++)
                    {
                        sourceArr.push(
                            response[i].id +"#"+ response[i].name +"#"+ response[i].state_id +"#"+ response[i].state.name
                            );
                    }
                    return process(sourceArr);
                })
            },
            highlighter : function(item){
                var city = item.split('#');
                var item = ''
                        + "<div class='typeahead_wrapper'>"
                        + "<span class='typeahead_photo fa fa-2x fa-user'></span>"
                        + "<div class='typeahead_labels'>"
                        + "<div class='typeahead_primary'>" + city[1] + "</div>"
                        + "<div class='typeahead_secondary'>" + city[3] + "</div>"
                        + "</div>"
                        + "</div>";
                return item;
            },
            updater : function(item){
                var city = item.split('#');
                $('[name=patient_city_id]').val(city[0]); 
                return city[1];
            }
         });

        $('[name=office_city]').typeahead({
            source : function(query, process){
                return $.get("{{ URL::to('carikota') }}/"+query, function(response){
                    //response = $.parseJSON(response);
                    var sourceArr = []; 
                    for(var i = 0; i < response.length; i++)
                    {
                        sourceArr.push(
                            response[i].id +"#"+ response[i].name +"#"+ response[i].state_id +"#"+ response[i].state.name
                            );
                    }
                    return process(sourceArr);
                })
            },
            highlighter : function(item){
                var city = item.split('#');
                var item = ''
                        + "<div class='typeahead_wrapper'>"
                        + "<span class='typeahead_photo fa fa-2x fa-user'></span>"
                        + "<div class='typeahead_labels'>"
                        + "<div class='typeahead_primary'>" + city[1] + "</div>"
                        + "<div class='typeahead_secondary'>" + city[3] + "</div>"
                        + "</div>"
                        + "</div>";
                return item;
            },
            updater : function(item){
                var city = item.split('#');
                $('[name=office_city_id]').val(city[0]); 
                return city[1];
            }
         });
        
        $('input[type="checkbox"]').each(function(){
            if(this.checked){
                selected += 1;
                console.log(selected);
            }
        });

        $('[name=packages]').on("ifClicked", function(){
            $('#box_of_payments').show();
            if(!this.checked){
                updateCost('Package','Dec',this.value);
            }else{
                updateCost('Package','Inc',this.value);
            }
        });

        $('[name=services]').on("ifClicked", function(){
            $('#box_of_payments').show();
            if(!this.checked){
                updateCost('Service','Dec',this.value);
            }else{
                updateCost('Service', 'Inc', this.value);
            }
        });

        $('[name=fee]').keypress(function(e){
            if(e.keyCode == 13){
                var fee = parseFloat($('[name=fee]').val());
                var tax = parseFloat($('[name=tax]').val());
                var tax_amount = (costs + fee) * (tax/100);
                var total = costs + fee+  tax_amount;
                $('[name=total]').val(total);
            }
        }); 

        $('[name=tax]').keypress(function(e){
            if(e.keyCode == 13){
                var fee = parseFloat($('[name=fee]').val());
                var tax = parseFloat($('[name=tax]').val());
                var tax_amount = (tax/100) * (costs + fee);
                var total = costs + fee + tax_amount;
                $('[name=total]').val(total);
            }
        });
        
    });

    function loadInsurances(patient_id)
    {
        $.get("{{ URL::to('loadasuransi') }}/"+patient_id, function(response){
            $('[name=financers]').html('');
            $('[name=financers]').append("<option value='0'>--Pilih</option>");
            for(var i=0; i < response.length; i++)
            {
                $('[name=financers]').append("<option value="+response[i].financer.id+">"+response[i].financer.name+"-"+response[i].code+"</option>");
            }
        },"json");
    }

    function financerConditioning()
    {
        var strings = $('[name=financers] option:selected').text();
        var splitter = strings.split("-");

        console.log(splitter);

        $('[name=insurance_id]').val(splitter[1]);
    }

    function updateCost(object, status, id)
    {
        switch(object)
        {
            case 'Package':
                if(status == 'Dec'){
                    costs += parseFloat($('[name=package_'+id+']').val());
                }else{
                    costs -= parseFloat($('[name=package_'+id+']').val());
                }
                break;
            case 'Service':
                if(status == 'Dec'){
                    costs += parseFloat($('[name=service_'+id+']').val());
                }else{
                    costs -= parseFloat($('[name=service_'+id+']').val());
                }
                break;
        }

        var fee = parseFloat($('[name=fee]').val());
        var tax = parseFloat($('[name=tax]').val());
        var tax_amount = (costs + fee) * (tax/100);
        var total = costs + fee + tax_amount;
        $('[name=costs]').val(costs);
        $('[name=total]').val(total);
    }

    function incMultiplier()
    {
        multiplier +=1 ;
        $('[name=multiplier]').val(multiplier);
    }

    function decMultiplier()
    {
        multiplier -= 1;

        if(multiplier < 1){
            multiplier = 1;
        }
        $('[name=multiplier]').val(multiplier);
    }

    function createPatient()
    {    
        var name = $('[name=patient_name]').val();
        var sex = $('[name=patient_sex]:checked').val();
        var birthdate = $('[name=patient_birthdate]').val();
        var city_id = $('[name=patient_city_id]').val();
        var address = $('[name=patient_address]').val();
        var contact = $('[name=patient_contact]').val();

        if(name && city_id){
            $.ajax({
                url:"{{ URL::to('pasien/store') }}",
                type:"POST",
                data:{
                    name:name,sex:sex,birthdate:birthdate,city_id:city_id,address:address,contact:contact
                },
                success:function(response){
                    $('[name=patient_code]').val(response.code);
                    $('[name=patient_id]').val(response.id);
                    $('#btn-save-patient').hide();

                    $('#box_of_choices').show();

                    lockRegistrant();
                }
            });
        }
    }

    function createOffice()
    {
        var name = $('[name=office_name]').val();
        var city_id = $('[name=office_city_id]').val();
        var address = $('[name=office_address]').val();
        var phone = $('[name=office_phone]').val();
        var fax = $('[name=office_fax]').val();

        if(name && city_id){
            $.ajax({
                url:"{{ URL::to('instansi/store') }}",
                type:"POST",
                data:{
                    name:name,city_id:city_id,address:address,phone:phone,fax:fax
                },
                success:function(response){
                    $('[name=office_id]').val(response.id);
                    $('#btn-save-office').hide();

                    $('#box_of_choices').show();

                    lockRegistrant();
                }
            });
        }
    }

    function lockRegistrant()
    {
        $('[name=patient]').iCheck("disable");

        $('[name=patient_name]').disabled = true;
        $('[name=patient_sex]').iCheck("disable");
        $('[name=patient_birthdate]').disabled = true;
        $('[name=patient_city]').disabled = true;
        $('[name=patient_address]').disabled = true;
        $('[name=patient_contact]').disabled = true;

        $('[name=office_name]').disabled = true;
        $('[name=office_address]').disabled = true;
        $('[name=office_phone]').disabled = true;
        $('[name=office_fax]').disabled = true;
        $('[name=office_city]').disabled = true;
    }

    /**
     * [register description]
     * @return {[type]} [description]
     */
    function register(){
        var patient_id = $('[name=patient_id]').val();
        var office_id = $('[name=office_id]').val();
        var packages = [];
        var services = [];
        var regulation_id = $('[name=regulations]').val();
        var recommender = $('[name=recommender]').val();
        var recommender_name = $('[name=recommender_name]').val();
        var multiplier = $('[name=multiplier]').val();
        var payments = $('[name=payments]:checked').val();
        var financer_id = $('[name=financers]').val();
        var insurance_id = $('[name=insurance_id]').val();
        var costs = $('[name=costs]').val();
        var fee = $('[name=fee]').val();
        var tax = $('[name=tax]').val();
        var total = $('[name=total]').val();
        var guarantor_name = $('[name=guarantor_name]').val();
        var guarantor_id_card = $('[name=guarantor_id_card]').val();
        var guarantor_id_address = $('[name=guarantor_id_address]').val();
        var guarantor_address = $('[name=guarantor_address]').val();
        var guarantor_contact = $('[name=guarantor_contact]').val();
        var downpayment = $('[name=downpayment]').val();

        $('[name=packages]:checked').each(function(){
            packages.push($(this).val());
        });

        $('[name=services]:checked').each(function(){
            services.push($(this).val());
        });


        if((patient_id || office_id) && (packages || services)){

            if(payments == '3' && financer_id == '0'){

                window.alert("Opsi Pembayaran Mengharuskan Anda:"+"\\n"
                            +"1. Memilih Salah Satu Asuransi"+"\\n"+"2. Masukkan Nomor/ID Asuran!");

            }else{

                $.ajax({
                    url:"{{ URL::to('laboratorium') }}",
                    type:"POST",
                    data:{patient_id:patient_id, office_id:office_id, 
                        packages:packages, services:services,regulation_id:regulation_id,
                        recommender:recommender, recommender_name:recommender_name,
                        multiplier:multiplier, payments:payments, financer_id:financer_id,insurance_id:insurance_id,
                        costs:costs, fee:fee, tax:tax, total:total,
                        guarantor_name:guarantor_name, guarantor_id_card:guarantor_id_card,
                        guarantor_id_address:guarantor_id_address, guarantor_address:guarantor_address,
                        guarantor_contact:guarantor_contact,downpayment:downpayment},
                    success:function(response){
                        if(response.status == 'Aborted'){

                            $('#notification').show();
                            $('#notification').html("Terjadi Kesalahan, Gagal melakukan Pendaftaran");

                        }else if(response.status == 'Succeed'){

                            $('[name=laboratory_id]').val(response.id);

                            $('#code').html("<i class='fa fa-file'></i> Nomor Lab : <small>"+response.code+"</small>");

                            $('#btn-register').hide();
                            $('#btn-summary').show();

                            window.alert("Pendaftaran Sukses!!");

                        }

                    }
                });

            }

        }else{
            window.alert("lengkapi Inputan anda!");
        }
    }

    function summary(){

        var id = $('[name=laboratory_id]').val();

        window.location = "{{ URL::to('laboratorium') }}/"+id;

    }

</script>
@stop