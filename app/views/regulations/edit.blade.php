@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-gears"></i>
        {{ $regulation->name }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('referensi') }}"> Referensi</a></li>
        <li><a href="{{ URL::to('referensi') }}/{{ $regulation->id }}"><i class="active"></i> {{ $regulation->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-flat btn-primary" onclick="update({{ $regulation->id }})" data-toggle="tooltip" data-placement="left" title="Simpan"><i class="fa fa-floppy-o"></i></button>
            </div>
        </div>
    </div>

    <div class="row">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-lg-3 control-label" for="name">Nama/Judul</label>
                <div class="col-lg-7">
                    <input name="name" class="form-control" type="text" value="{{ $regulation->name }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label" for="description">Penjelasan</label>
                <div class="col-lg-8">
                    <textarea class="form-control gtext" name="description">{{ $regulation->description }}</textarea>
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


    function update(id)
    {
        var name = $('[name=name]').val();
        var description = $('[name=description]').val();

        if(id != '' && name != ''){
            $.ajax({
                url:"{{ URL::to('referensi') }}/"+id,
                type:'PUT',
                data:{name : name, description : description},
                success:function(){
                    window.location = "{{ URL::to('referensi') }}";
                }
            });
        }else{
            window.alert('Upps!! Tidak dapat memproses Update Referesi');
        }
    }
</script>
@stop