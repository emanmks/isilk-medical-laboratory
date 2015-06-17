@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-file"></i>
        Pendaftaran
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Laboratorium</a></li>
        <li><a href="{{ URL::to('laboratorium') }}"><i class="active"></i> Pendaftaran</a></li>
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
        <!--
        <div class="col-lg-2">
            <input type="text" id="inputDateFilter" class="form-control" value="{{  date('Y-m-d') }}" data-provide="datepicker">
        </div>
        -->

        <div class="col-lg-12">
            <div class="text-right">
                <a class="btn btn-flat btn-success" href="{{ URL::to('laboratorium/create') }}" data-toggle="tooltip" data-placement="left" title="Pendaftaran Pemeriksaan"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>

    @foreach(array_chunk($laboratories->all(), 4) as $item)
        <div class="row">
            @foreach($item as $laboratory)
                <div class="col-lg-3">
                    <div class="thumb-menu">
                        <h1><a href="{{ URL::to('laboratorium') }}/{{ $laboratory->id }}" data-toggle="tooltip" data-placement="top" title="Rangkuman Pendaftaran"><i class="fa fa-file text-info"></i></a></h1>

                        <a href="{{ URL::to('laboratorium') }}/{{ $laboratory->id }}" data-toggle="tooltip" data-placement="top" title="Rangkuman Pendaftaran">#{{ $laboratory->code }}</a>&nbsp;
                        <a href="#" onclick="destroy({{ $laboratory->id }})" data-toggle="tooltip" data-placement="top" title="Batalkan Pendaftaran"><i class="fa fa-trash-o text-danger"></i></a><br/>

                        {{ $laboratory->registrant->name }} <br/>
                        
                        <i class="fa fa-medkit"></i> |&nbsp;
                        @foreach($laboratory->choices as $choice)
                            {{ $choice->examinable->name }}, &nbsp;
                        @endforeach

                        <br/>

                        <i class="fa fa-flask"></i> |&nbsp;
                        @foreach($laboratory->samplings as $sampling)
                            @if($sampling->taken == 0)
                                <a href="{{ URL::to('sampling') }}/{{ $sampling->id }}" class="text-warning" data-toggle="tooltip" data-placement="top" title="Sampel Belum Diterima">{{ '@'.$sampling->code }}</a>
                                &nbsp;&nbsp;
                            @else
                                <a href="{{ URL::to('entry') }}/{{ $sampling->id }}" class="text-success" data-toggle="tooltip" data-placement="top" title="Sampel Sudah Diterima">{{ '@'.$sampling->code }}</a>
                            @endif
                        @endforeach
                            
                        <p>by: {{ $laboratory->employee->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    <div class="row">
        
    </div>

        </div>
    </div>
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

    function destroy(id)
    {
        if(confirm('Yakin menghapus / membatalkan Pemeriksaan ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('laboratorium') }}/"+id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('laboratorium') }}";
                }
            });
        }
    }
</script>

@stop