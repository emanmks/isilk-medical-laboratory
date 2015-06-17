@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - WYSIWYG -->
{{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}

<section class="content-header">
    <h1>
        Parameter Normal
        <small>
            {{{ $normal->parameter->name }}}
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Pemeriksaan</a></li>
        <li><a href="#"> Parameter</a></li>
        <li><a href="{{ URL::to('parameter') }}/{{ $normal->parameter->id }}"><i class="active"></i> {{ $normal->parameter->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Update Nilai Normal
                    </div>
                </div>

                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="regulation">Standarisasi</label>
                            <div class="col-lg-5">
                                <input type="hidden" name="parameter_id" value="{{ $normal->parameter->id }}">

                                <select name="regulation" class="form-control">
                                    <option value="0">--Pilih</option>
                                    @foreach($regulations as $regulation)
                                        <option value="{{ $regulation->id }}">{{ $regulation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="method">Metode</label>
                            <div class="col-lg-5">
                                <select name="method" class="form-control">
                                    @foreach($methods as $method)
                                        <option value="{{ $method->id }}">{{ $method->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-lg-3 control-label" for="normal">Nilai Batas / Normal</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="normal" rows="5">{{ $normal->normal }}</textarea>
                            </div>
                        </div>
                    </form>

                    <div class="text-right">
                        <button class="btn btn-flat btn-success" onClick="update({{ $normal->id }})">Simpan <i class="fa fa-check"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{ HTML::script('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}

<script type="text/javascript">
    $(function(){
            
        $('[name=regulation]').val("{{ $normal->regulation_id }}");
        $('[name=method]').val("{{ $normal->method_id }}");
        $('[name=normal]').wysihtml5();

    });
    function update(id)
    {
        var parameter_id = $('[parameter_id]').val();
        var regulation_id = $('[name=regulation]').val();
        var method_id = $('[name=method]').val();
        var normal = $('[name=normal]').val();

        $.ajax({
            url:"{{ URL::to('normal')}}/"+id,
            type:'PUT',
            data:{regulation_id : regulation_id,
                method_id : method_id,
                normal : normal},
            success:function(){
                
                window.location = "{{ URL::to('parameter') }}/"+parameter_id;
                
            } 
        });
    }
</script>
@stop