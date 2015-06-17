@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        <i class="fa fa-user"></i>
        Pasien
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('pasien') }}"> Pasien</a></li>
        <li><a href="{{ URL::to('pasien') }}/{{ $patient->id }}"><i class="active"></i> {{ $patient->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <center>
                    <h1><i class="fa fa-user text-info"></i></h1>
                    <h1 class="text-info">{{ $patient->name }}</h1>
                    <i class="fa fa-road"></i> {{ $patient->address }}<br/>
                    <i class="fa fa-phone"></i> {{ $patient->contact }} &nbsp;
                    <i class="fa fa-map-marker"></i> {{ $patient->city->name }}<br/>
                    <i class="fa fa-file"></i> Mendaftar sebanyak 0 kali
                </center>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary" onclick="showFormAttach()" data-toggle="tooltip" data-placement="right" title="Tambahkan Asuransi"><i class="fa fa-credit-card"></i></button>
        </div>
    </div>

    @foreach(array_chunk($patient->insurances->all(), 3) as $items)
        <div class="row">
            @foreach($items as $insurance)
                <div class="col-md-4">
                    <center>
                        <h1 class="text-warning"><i class="fa fa-credit-card"></i></h1>
                        <a href="#" onclick="detach({{ $patient->id }}, $insurance->id)" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o text-danger"></i></a><br/>
                        <strong>{{ $insurance->name }}</strong><br/>
                        <strong class="text-warning">ID: {{ $insurance->pivot->code }}</strong>
                    </center>
                </div>
            @endforeach
        </div>
    @endforeach

</section>

<!-- Form Attach Insurance [modal]
===================================== -->
<div id="formAttach" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Tambahkan Asuransi</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="financers">Pilih Asuransi</label>
                        <div class="col-lg-7">
                            <select name="financers" class="form-control">
                                <option value="">--Pilih</option>
                                    @foreach($financers as $financer)
                                        <option value="{{ $financer->id }}">{{ $financer->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="code">Nomor Peserta</label>
                        <div class="col-lg-6">
                            <input name="code" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="attach({{ $patient->id }})" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Attach Insurance [modal] -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function showFormAttach()
    {
        $('#formAttach').modal('show');
        $('[name=code]').val('');
    }

    function attach(id)
    {
        var financer_id = $('[name=financers]').val();
        var code = $('[name=code]').val();

        if(code && financer_id)
        {
            $.ajax({
                url:"{{ URL::to('pasien') }}/"+id+"/attach",
                type:'POST',
                data:{financer_id:financer_id, code:code},
                success:function(){
                    window.location = "{{ URL::to('pasien') }}/"+id;
                }
            });
        }
        else
        {
            window.alert('Input anda belum lengkap!');
        }
    }

    function detach(id, financer)
    {
        if(confirm("Yakin akan menghapus data ini?!")){
            $.ajax({
                url:"{{ URL::to('pasien') }}/"+id+"/detach",
                type:'POST',
                data:{financer_id:financer},
                success:function(){
                    window.location = "{{ URL::to('pasien') }}/"+id;
                }
            });
        }
    }
</script>
@stop