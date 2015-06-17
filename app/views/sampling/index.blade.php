@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-tint"></i>
        Data Penerimaan Sampel
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Laboratorium</a></li>
        <li><a href="{{ URL::to('sampling') }}"><i class="active"></i> Sampling</a></li>
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
                        @if($sampling->taken == 0)
                            <a href="#" onclick="doSampling({{ $sampling->id }})" data-toggle="tooltip" data-placement="top" title="Ambil Sampel"><h1 class="text-danger"><i class="fa fa-tint"></i></h1></a>
                        @else
                            <a href="#" onclick="unTake({{ $sampling->id }})" data-toggle="tooltip" data-placement="top" title="Batalkan Pengambilan"><h1 class="text-info"><i class="fa fa-tint"></i></h1></a>
                        @endif
                        {{ $sampling->laboratory->registrant->name }}<br/>
                        <span class="text-primary">#{{ $sampling->laboratory->code }}</span><br/>
                        @if($sampling->taken == 0)
                            <a href="#" onclick="doSampling({{ $sampling->id }})" data-toggle="tooltip" data-placement="top" title="Ambil Sampel"><span class="text-danger">{{ '@'.$sampling->code }}</span></a><br/>
                        @else
                            <a href="#" onclick="unTake({{ $sampling->id }})" data-toggle="tooltip" data-placement="top" title="Batalkan Pengambilan"><span class="text-success">{{ '@'.$sampling->code }}</span></a><br/>
                        @endif
                        Jenis : {{ $sampling->speciment->name }}<br/>
                        @if($sampling->taken == 0)
                            Status : <span class="text-danger">Belum Ambil</span>    
                        @else
                            Status : <span class="text-success">Sudah Ambil</span>
                        @endif

                        <input type="hidden" id="code-{{ $sampling->id }}" value="{{ $sampling->code }}">
                        <input type="hidden" id="name-{{ $sampling->id }}" value="{{ $sampling->name }}">
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</section>

<!-- Form Sampling [modal]
===================================== -->
<div id="formSampling" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 name="myModalLabel">Penerimaan Sampel</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="code">Nomor Sampel</label>
                        <div class="col-lg-5">
                            <input type="hidden" name="id" value="0">
                            <input name="code" class="form-control" type="text" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="name">Nama Sampel</label>
                        <div class="col-lg-7">
                            <input name="name" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="forms">Bentuk</label>
                        <div class="col-lg-6">
                            <input name="forms" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="container">Wadah</label>
                        <div class="col-lg-6">
                            <input name="container" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="volume">Volume</label>
                        <div class="col-lg-6">
                            <input name="volume" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="desc">Keterangan</label>
                        <div class="col-lg-9">
                            <input type="text" name="desc" class="form-control">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="take()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- End of Form Sampling [modal] -->
{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}

<script type="text/javascript">
    $(function(){
        //$('[name=filter]').datepicker({format:'yyyy-mm-dd',autoclose:true});

        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function doSampling(id)
    {
        $('#formSampling').modal('show');
        
        $('[name=id]').val(id);
        $('[name=code]').val($('#code-'+id).val());
        $('[name=name]').val($('#name-'+id).val());
        $('[name=forms]').val('');
        $('[name=container]').val('');
        $('[name=volume]').val('');
        $('[name=description]').val('');
    }

    function take()
    {
        var id = $('[name=id]').val();
        var name = $('[name=name]').val();
        var description = $('[name=desc]').val();
        var form = $('[name=forms]').val();
        var container = $('[name=container]').val();
        var volume = $('[name=volume]').val();

        if(id && name){
                $.ajax({
                url:"{{ URL::to('sampling') }}/"+id,
                type:"PUT",
                data:{taken:1,
                    description : description,
                    form : form,
                    container : container,
                    volume : volume
                    },
                success:function(){
                    window.location = "{{ URL::to('sampling') }}";
                }
            });
        }
    }

    function unTake(id)
    {
       if(confirm("Yakin akan membatalkan pengambilan spesimen?")){
            $.ajax({
                url:"{{ URL::to('sampling') }}/"+id,
                type:"PUT",
                data:{taken:0,
                    description : '',
                    form : '',
                    container : '',
                    volume : ''},
                success:function(){
                    window.location = "{{ URL::to('sampling') }}";
                }
            });
       }
    }
</script>

@stop