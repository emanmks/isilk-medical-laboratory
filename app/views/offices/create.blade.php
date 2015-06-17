@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        <i class="fa fa-building"></i>
        Instansi
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('instansi') }}"><i class="active"></i> Instansi</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-flat btn-success" onClick="create()" data-toggle="tooltip" data-placement="left" title="Pasien Baru"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>

        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-lg-3 control-label" for="name">Nama Kantor</label>
                <div class="col-lg-6">
                    <input name="name" class="form-control" type="text">
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

            <div class="form-group">
                <label class="col-lg-3 control-label" for="address">Alamat</label>
                <div class="col-lg-7">
                    <textarea class="form-control" name="address"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="phone">Telepon</label>
                <div class="col-lg-3">
                    <input name="phone" class="form-control" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="fax">Fax</label>
                <div class="col-lg-3">
                    <input name="fax" class="form-control" type="text">
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">
    $(function(){
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });
    })

    function create()
    {
        var name = $('[name=name]').val();
        var address = $('[name=address]').val();
        var phone = $('[name=phone]').val();
        var fax = $('[name=fax]').val();
        var city_id = $('[name=cities]').val();

        if(name != '' && city_id != '0')
        {
            $.ajax({
                url:"{{ URL::to('instansi') }}",
                type:'POST',
                data: {name : name, 
                        address : address, 
                        phone : phone,
                        fax : fax,
                        city_id : city_id},
                success:function(){
                    window.location = "{{ URL::to('instansi') }}";
                }
            });
        }else{
            window.alert('Informasi yang diinput belum lengkap');
        }
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
</script>
@stop