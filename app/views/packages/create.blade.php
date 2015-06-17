@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/chosen/chosen.css') }}

<section class="content-header">
    <h1><i class="fa fa-medkit"></i> Paket Pemeriksaan</h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ URL::to('paket') }}"><i class="active"></i> Paket Pemeriksaan</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-flat btn-primary" data-toggle="tooltip" data-placement="left" title="Simpan" onclick="create()"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="name">Nama Paket</label>
                    <div class="col-lg-5">
                        <input name="name" class="form-control" type="text">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="price">Tarif</label>
                    <div class="col-lg-2">
                        <input name="price" class="form-control" type="text" value="0">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="services">Komposisi Paket Pemeriksaan</label>
                    <div class="col-lg-6">
                        <select class="form-control chzn-select" name="services" multiple>
                            <option value="0"></option>
                            @foreach($classifications as $classification)
                                @if($classification->parent_id == 0)
                                    <optgroup label="{{ $classification->name }}">
                                        @foreach($classification->services as $service)
                                            <option value="{{ $service->id }}">&nbsp;&nbsp;{{ $service->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                                @foreach($classification->subclassifications as $classification)
                                    <optgroup label="{{ $classification->name }}">
                                        @foreach($classification->services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="speciments">Spesimen yang Dibutuhkan</label>
                    <div class="col-lg-3">
                        <select class="form-control chzn-select" name="speciments" multiple>
                            <option value="0">--Pilih Jenis Spesimen</option>
                            @foreach($speciments as $speciment)
                                <option value="{{ $speciment->id }}">{{ $speciment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/chosen/chosen.jquery.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

        $('[name=price]').keyup(function(){
            $(this).val(formatCurrency($(this).val()));
        });

        $('.chzn-select').chosen();

    });

    function create()
    {
        var name = $('[name=name]').val();
        var price = $('[name=price]').val();
        var services = $('[name=services]').val();
        var speciments = $('[name=speciments]').val();

        if(name && price != '0' && services && speciments)
        {
            $.ajax({
                url:"{{ URL::to('paket') }}",
                type:"POST",
                data:{name:name, price:price, services:services, speciments:speciments},
                success:function(){
                    window.location = "{{ URL::to('paket') }}";
                }   
            });
        }
        else
        {
            window.alert("Mohon lengkapi informasi yang dibutuhkan!!");
        }
    }
</script>

@stop