@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        <i class="fa fa-credit-card"></i>
        Pembiayaan <small>{{ $financer->name }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ URL::to('data') }}"> Data & Pengaturan</a></li>
        <li><a href="{{ URL::to('pembiayaan') }}"><i class="active"></i> Pembiayaan</a></li>
        <li><a href="{{ URL::to('pembiayaan') }}/{{ $financer->id }}"><i class="active"></i> {{ $financer->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <center>
                <h1><i class="fa fa-credit-card"></i> {{ $financer->name }}</h1>
                <p>
                    <i class="fa fa-road"></i> {{ $financer->address }}&nbsp;&nbsp;
                    <i class="fa fa-phone"></i> {{ $financer->phone }}<br/>
                    <i class="fa fa-mail"></i> {{ $financer->email }}
                </p>
                <p>
                    {{ $financer->description }}
                </p>
            </center>
        </div>
    </div>
</section>


<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });
</script>
@stop