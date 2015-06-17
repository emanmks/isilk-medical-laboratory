@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        <i class="fa fa-building"></i>
        {{ $office->name }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('instansi') }}"> Kantor/Instansi</a></li>
        <li><a href="{{ URL::to('instansi') }}/{{ $office->id }}"><i class="active"></i> {{ $office->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-flat btn-success" onClick="update({{ $office->id }})" data-toggle="tooltip" data-placement="left" title="Pasien Baru"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>

        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-lg-3 control-label" for="name">Nama Kantor</label>
                <div class="col-lg-6">
                    <input name="name" class="form-control" type="text" value="{{ $office->name }}">
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
                    <textarea class="form-control" name="address">{{ $office->address }}</textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label" for="phone">Telepon</label>
                <div class="col-lg-3">
                    <input name="phone" class="form-control" type="text" value="{{ $office->phone }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="fax">Fax</label>
                <div class="col-lg-3">
                    <input name="fax" class="form-control" type="text" value="{{ $office->fax }}">
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

        $('[name=states]').val("{{ $office->city->state_id }}");

        firstLoadCities();
    })

    function update(id)
    {
        var name = $('[name=name]').val();
        var address = $('[name=address]').val();
        var phone = $('[name=phone]').val();
        var fax = $('[name=fax]').val();
        var city_id = $('[name=cities]').val();

        if(name != '' && city_id != '0')
        {
            $.ajax({
                url:"{{ URL::to('instansi') }}/"+id,
                type:'PUT',
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
            $('[name=cities]').val("{{ $office->city_id }}");
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