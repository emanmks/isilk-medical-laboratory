@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/chosen/chosen.css') }}

<section class="content-header">
    <h1>{{ $package->name }}</h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Paket</a></li>
        <li><a href="{{ URL::to('paket') }}/{{ $package->id }}"><i class="active"></i> {{ $package->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h3 class="text-muted"> 
                @foreach($package->speciments as $speciment) 
                    <i class="fa fa-tint"></i> {{ $speciment->name }} 
                    <small>
                        <a href="#" onclick="detachSpeciment({{ $package->id }},{{ $speciment->id }})" data-toggle="tooltip" data-placement="top" title="Tidak Dibutuhkan"><i class="fa fa-trash-o text-danger"></i></a> &nbsp;&nbsp;
                    </small>
                @endforeach
            </h3>
        </div>

        <div class="col-lg-6">
            <div class="pull-right"><h3 class="text-muted">Rp{{ number_format($package->price,2,",",".") }}</h3></div>
        </div>
    </div>

    <br/>

    <div class="row">
        <div class="col-lg-6">
            <form class="form-inline" id="form-attach">
                <div class="form-group">
                    <label class="sr-only" for="services">Komposisi Jenis Pemeriksaan</label>
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
            </form>

            <form class="form-inline" id="form-speciment">
                <div class="form-group">
                    <label class="sr-only" for="services">Komposisi Jenis Pemeriksaan</label>
                    <select class="form-control chzn-select" name="speciments" multiple>
                        <option value="0">--Pilih Jenis Spesimen</option>
                        @foreach($speciments as $speciment)
                            <option value="{{ $speciment->id }}">{{ $speciment->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="pull-right">
                <button class="btn btn-flat btn-primary" onClick="attachServices({{ $package->id }})" id="button-attach" data-toggle="tooltip" data-placement="left" title="Masukkan!"><i class="fa fa-floppy-o"></i></button>
                <button class="btn btn-flat btn-warning" onClick="hideForm()" id="button-hide" data-toggle="tooltip" data-placement="top" title="Batal!"><i class="fa fa-close"></i></button>

                <button class="btn btn-flat btn-primary" onClick="attachSpeciments({{ $package->id }})" id="button-attach-speciment" data-toggle="tooltip" data-placement="left" title="Masukkan!"><i class="fa fa-floppy-o"></i></button>
                <button class="btn btn-flat btn-warning" onClick="hideFormSpeciment()" id="button-hide-speciment" data-toggle="tooltip" data-placement="top" title="Batal!"><i class="fa fa-close"></i></button>

                <button class="btn btn-flat btn-success" onClick="showFormAttachServices()" id="button-show-form" data-toggle="tooltip" data-placement="left" title="Tambahkan Komposisi Paket Pemeriksaan"><i class="fa fa-medkit"></i></button>
                <button class="btn btn-flat btn-success" onClick="showFormAttachSpeciments()" id="button-show-form-speciment" data-toggle="tooltip" data-placement="left" title="Tambahkan Komposisi Spesimen"><i class="fa fa-tint"></i></button>
            </div>
        </div>
    </div>

    <br/>

    @foreach(array_chunk($package->services->all(), 4) as $rows)

        <div class="row">
            
            @foreach($rows as $service)

                <div class="col-lg-3">
                    <div class="thumb-menu">
                        <h1 class="text-navy"><i class="fa fa-medkit"></i></h1>
                        <a href="#" onclick="detachService({{ $package->id }},{{ $service->id }})" data-toggle="tooltip" data-placement="top" title="Keluarkan" class="text-danger"><i class="fa fa-trash-o"></i></a><br/>
                        <strong class="text-muted">{{ $service->name }}</strong>
                    </div>
                </div>

            @endforeach

        </div>

    @endforeach
</section>

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/chosen/chosen.jquery.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

        $('.chzn-select').chosen();

        $('#form-attach').hide();
        $('#form-speciment').hide();

        $('#button-attach').hide();
        $('#button-hide').hide();

        $('#button-attach-speciment').hide();
        $('#button-hide-speciment').hide();
    });

    function showFormAttachServices()
    {
        $('#form-attach').show(1000);
        $('#button-attach').show(1000);
        $('#button-hide').show(1000);
        $('#button-show-form').hide(1000);
        $('#button-show-form-speciment').hide(1000);
    }

    function showFormAttachSpeciments()
    {
        $('#form-speciment').show(1000);
        $('#button-attach-speciment').show(1000);
        $('#button-hide-speciment').show(1000);
        $('#button-show-form-speciment').hide(1000);
        $('#button-show-form').hide(1000);
    }

    function hideForm()
    {
        $('#form-attach').hide();
        $('#button-attach').hide();
        $('#button-hide').hide();

        $('#button-show-form').show(1000);
        $('#button-show-form-speciment').show(1000);
    }

    function hideFormSpeciment()
    {
        $('#form-speciment').hide();
        $('#button-attach-speciment').hide();
        $('#button-hide-speciment').hide();

        $('#button-show-form').show(1000);
        $('#button-show-form-speciment').show(1000);
    }

    function attachServices(package_id)
    {
        var services = $('[name=services]').val();

        if(services)
        {
            $.ajax({
                url:"{{ URL::to('paket') }}/"+package_id+"/attachpemeriksaan",
                type:'POST',
                data:{services:services},
                success:function(){
                    window.location = "{{ URL::to('paket') }}/"+package_id;
                }
            });
        }
        else
        {
            window.alert("Pilih Minimal 1 Jenis Pemeriksaan!");
        }
    }

    function attachSpeciments(package_id)
    {
        var speciments = $('[name=speciments]').val();

        if(speciments)
        {
            $.ajax({
                url:"{{ URL::to('paket') }}/"+package_id+"/attachspesimen",
                type:'POST',
                data:{speciments:speciments},
                success:function(){
                    window.location = "{{ URL::to('paket') }}/"+package_id;
                }
            });
        }
        else
        {
            window.alert("Pilih Minimal 1 Jenis Pemeriksaan!");
        }
    }

    function detachService(package_id,service_id)
    {
        if(confirm('Yakin akan mengeluarkan Pemeriksaan ini dari '+"{{ $package->name }}"))
        {
            if(service_id)
            {
                $.ajax({
                    url:"{{ URL::to('paket') }}/"+package_id+"/detachpemeriksaan/"+service_id,
                    type:'DELETE',
                    success:function(){
                        window.location = "{{ URL::to('paket') }}/"+package_id;
                    }
                });
            }
        }
    }

    function detachSpeciment(package_id,speciment_id)
    {
        if(confirm('Yakin akan mengeluarkan Speciment ini dari '+"{{ $package->name }}"))
        {
            if(speciment_id)
            {
                $.ajax({
                    url:"{{ URL::to('paket') }}/"+package_id+"/detachspesimen/"+speciment_id,
                    type:'DELETE',
                    success:function(){
                        window.location = "{{ URL::to('paket') }}/"+package_id;
                    }
                });
            }
        }
    }
</script>

@stop