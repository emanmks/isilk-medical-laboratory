@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/iCheck/flat/blue.css') }}
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-user"></i>
        {{ $patient->name }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('pasien') }}"> Pasien</a></li>
        <li><a href="{{ URL::to('pasien') }}/{{ $patient->id }}"><i class="active"></i> {{ $patient->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-flat btn-success" onClick="update({{ $patient->id }})" data-toggle="tooltip" data-placement="left" title="Pasien Baru"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>

        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-lg-3 control-label" for="name">Nama Lengkap</label>
                <div class="col-lg-6">
                    <input name="name" class="form-control" type="text" value="{{ $patient->name }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="address">Alamat</label>
                <div class="col-lg-7">
                    <textarea class="form-control" name="address">{{ $patient->address }}</textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="sex">Jenis Kelamin</label>
                <div class="col-lg-4">
                    @if($patient->sex == 'L')
                        &nbsp;&nbsp;<input type="radio" name="sex" value="L" checked>&nbsp;Laki-laki&nbsp;
                        &nbsp;&nbsp;<input type="radio" name="sex" value="P">&nbsp;Perempuan&nbsp;
                    @else
                        &nbsp;&nbsp;<input type="radio" name="sex" value="L">&nbsp;Laki-laki&nbsp;
                        &nbsp;&nbsp;<input type="radio" name="sex" value="P" checked>&nbsp;Perempuan&nbsp;
                    @endif
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="birthdate">TGL Lahir</label>
                <div class="col-lg-2">
                    <input name="birthdate" class="form-control" type="text" data-provide="datepicker" value="<? echo date('Y-m-d', strtotime($patient->birthdate)); ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="contact">Kontak</label>
                <div class="col-lg-3">
                    <input name="contact" class="form-control" type="text" value="{{ $patient->contact }}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="states">Propinsi Asal</label>
                <div class="col-lg-4">
                    <select name="states" class="form-control" onchange="loadCities()">
                        <option value="0">--Pilih</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="cities">Kota Asal</label>
                <div class="col-lg-4">
                    <select name="cities" class="form-control">
                        <option value="0">--Pilih</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}
{{ HTML::script('assets/js/plugins/iCheck/icheck.min.js') }}

<script type="text/javascript">
    $(function(){
        $('input').iCheck({
            checkboxClass:'icheckbox_flat-blue',
            radioClass:'iradio_flat-blue'
        });

        $('[name=birthdate]').datepicker({format: 'yyyy-mm-dd', autoclose : true});

        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

        $('[name=states]').val("{{ $patient->city->state_id }}");

        firstLoadCities();
    })

    function update(id)
    {
        var name = $('[name=name]').val();
        var sex = $('[name=sex]:checked').val();
        var birthdate = $('[name=birthdate]').val();
        var address = $('[name=address]').val();
        var contact = $('[name=contact]').val();
        var city_id = $('[name=cities]').val();

        if(name != '' && city_id != '0')
        {
            $.ajax({
                url:"{{ URL::to('pasien') }}/"+id,
                type:'PUT',
                data: {name : name, 
                        sex : sex, 
                        birthdate : birthdate, 
                        address : address, 
                        contact : contact,
                        city_id : city_id},
                success:function(){
                    window.location = "{{ URL::to('pasien') }}/"+id;
                }
            });
        }else{
            window.alert('Informasi yang diinput belum lengkap');
        }
    }

    function firstLoadCities()
    {
        var state_id = $('[name=states]').val();

        $.get("{{ URL::to('filterkota') }}/"+state_id, function(data){
            $('[name=cities]').html('');
            $('[name=cities]').append("<option value='0'>--Pilih</option>");
            for(var i=0; i < data.length; i++)
            {
                $('[name=cities]').append("<option value="+data[i].id+">"+data[i].name+"</option>");
            }
            $('[name=cities]').val("{{ $patient->city_id }}");
        },'json');
    }

    function loadCities()
    {
        var state_id = $('[name=states]').val();

        $.get("{{ URL::to('filterkota') }}/"+state_id, function(data){
            $('[name=cities]').html('');
            $('[name=cities]').append("<option value='0'>--Pilih</option>");
            for(var i=0; i < data.length; i++)
            {
                $('[name=cities]').append("<option value="+data[i].id+">"+data[i].name+"</option>");
            }
        },'json');
    }

    function destroy(id)
    {
        if(confirm('Yakin akan menghapus data ini?!'))
        {
            $.ajax({
                url:'pasien/'+id,
                type:'DELETE',
                success:function(){
                    window.location = "pasien";
                }
            });
        }
    }
</script>
@stop