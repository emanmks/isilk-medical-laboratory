@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-credit-card"></i>
        Pembiayaan <small>Tambah Baru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ URL::to('data') }}"> Data & Pengaturan</a></li>
        <li><a href="{{ URL::to('pembiayaan') }}"><i class="active"></i> Pembiayaan</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-10">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="name">Nama Pembiayaan</label>
                            <div class="col-lg-5">
                                <input name="name" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="address">Alamat</label>
                            <div class="col-lg-7">
                                <input name="address" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="phone">Telepon</label>
                            <div class="col-lg-3">
                                <input name="phone" class="form-control" type="text">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="email">Email</label>
                            <div class="col-lg-4">
                                <input name="email" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="description">Keterangan</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2">
                    <div class="text-right">
                        <button class="btn btn-flat btn-primary" onclick="create()" data-toggle="tooltip" data-placement="left" title="Simpan Pembiayaan Baru"><i class="fa fa-floppy-o"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('[name=description]').wysihtml5();

        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function create()
    {
        var name = $('[name=name]').val();
        var address = $('[name=address]').val();
        var phone = $('[name=phone]').val();
        var email = $('[name=email]').val();
        var description = $('[name=description]').val();

        if(name != ''){
            $.ajax({
                url:"{{ URL::to('pembiayaan') }}",
                type:'POST',
                data:{name : name, address:address, phone:phone, email:email, description : description},
                success:function(){
                    window.location = "{{ URL::to('pembiayaan') }}";
                }
            });
        }else{
            window.alert('Lengkapi Input Data Anda!!');
        }
    }
</script>
@stop