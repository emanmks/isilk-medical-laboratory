@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-search"></i>
        Metode Uji
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('metode') }}"><i class="active"></i> Metode Uji</a></li>
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
                <label class="col-lg-3 control-label" for="name">Nama Metode Uji</label>
                <div class="col-lg-7">
                    <input name="name" class="form-control" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="clinical">Klinis / Non Klinis</label>
                <div class="col-lg-2">
                    <select class="form-control" name="clinical">
                        <option value="1">Klinis</option>
                        <option value="0">Non Klinis</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="description">Penjelasan</label>
                <div class="col-lg-8">
                    <textarea class="form-control gtext" id="description" rows="10"></textarea>
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
        var clinical = $('[name=clinical]').val();
        var description = $('name=description').val();

        if(name != ''){
            $.ajax({
                url:"{{ URL::to('metode') }}",
                type:'POST',
                data:{name:name, clinical:clinical, description:description},
                success:function(){
                    window.location = "{{ URL::to('metode') }}";
                }
            });
        }else{
            window.alert('Lengkapi Informasi yang harus diinput!!');
        }
    }
</script>
@stop