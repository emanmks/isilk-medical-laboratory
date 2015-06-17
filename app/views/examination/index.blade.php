@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-flask"></i>
        Entry Hasil Uji
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Laboratorium</a></li>
        <li><a href="{{ URL::to('entry') }}"><i class="active"></i> Entry Hasil Uji</a></li>
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

    @foreach(array_chunk($samplings->all(), 4) as $items)
        <div class="row">
            @foreach($items as $sampling)
                <div class="col-md-3">
                    <div class="thumb-menu">
                        <h1 class="text-info"><i class="fa fa-tint"></i></h1>
                        {{ $sampling->laboratory->registrant->name }}<br/>
                        <span class="text-primary">#{{ $sampling->laboratory->code }}</span><br/>
                        <strong>{{ '@'.$sampling->code }}</strong><br/>
                        Jenis : {{ $sampling->speciment->name }}<br/>
                        <i class="fa fa-medkit"></i> | 
                        @foreach($sampling->examinations as $examination)
                            {{ $examination->service->name }}
                        @endforeach
                        <br/>
                        <a href="{{ URL::to('entry') }}/{{ $sampling->id }}" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Klik untuk Periksa dan Entry Hasil Uji"><i class="fa fa-stethoscope"></i> Entry Hasil Uji</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</section>

{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}

<script type="text/javascript">
    $(function(){
        $('#inputDateFilter').datepicker({format:'yyyy-mm-dd',autoclose:true});

        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });
</script>

@stop