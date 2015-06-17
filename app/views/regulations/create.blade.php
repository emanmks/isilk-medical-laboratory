@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-gears"></i>
        Referensi
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('referensi') }}"><i class="active"></i> Referensi</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-flat btn-primary" onclick="create()" data-toggle="tooltip" data-placement="left" title="Simpan"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>
    </div>

    <div class="row">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-lg-3 control-label" for="name">Nama/Judul</label>
                <div class="col-lg-7">
                    <input name="name" class="form-control" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="description">Penjelasan</label>
                <div class="col-lg-8">
                    <textarea class="form-control" name="description" rows="5"></textarea>
                </div>
            </div>
        </form>
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
        var description = $('[name=description]').val();

        if(name != ''){
            $.ajax({
                url:"{{ URL::to('referensi') }}",
                type:'POST',
                data:{name : name, description : description},
                success:function(){
                    window.location = "{{ URL::to('referensi') }}";
                }
            });
        }else{
            window.alert('Lengkapi dulu informasi yang dibutuhkan!');
        }
    }
</script>
@stop