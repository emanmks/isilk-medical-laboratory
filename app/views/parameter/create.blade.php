@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - WYSIWYG -->
{{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}


<section class="content-header">
    <h1><i class="fa fa-search"></i> {{ $service->name }}</h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Parameter</a></li>
        <li><a href="{{ URL::to('pemeriksaan') }}/{{ $service->id }}"><i class="active"></i> {{ $service->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Tambahkan Parameter
                    </div>
                </div>

                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="name">Nama Parameter</label>
                            <div class="col-lg-5">
                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                <input name="name" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="unit">Satuan</label>
                            <div class="col-lg-2">
                                <input name="unit" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="datatype">Tipe Data</label>
                            <div class="col-lg-3">
                                <select name="datatype" class="form-control">
                                    <option value="0">--Pilih</option>
                                    <option value="INT">INT - Bilangan Bulat</option>
                                    <option value="FLOAT">FLOAT - Bilangan Desimal</option>
                                    <option value="COMMENT">KOMENTAR</option>
                                    <option value="CONDITION">KONDISIONAL</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="expression">Ekspresi Data</label>
                            <div class="col-lg-7">
                                <input name="expression" class="form-control" type="text" placeholder="Masukkan jika perlu">
                                <small>Untuk Type Data Kondisional, masukkan beberapa kondisi yang mungkin ada, misal: NEGATIF,POSITIF</small>
                            </div>
                        </div>


                        <div class="box-title">Nilai Rujukan Default</div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="regulation">Referensi</label>
                            <div class="col-lg-5">
                                <select name="regulation" class="form-control">
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
                            <label class="col-lg-3 control-label" for="normal">Nilai Rujukan</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="normal" rows="5"></textarea>
                            </div>
                        </div>
                    </form>

                    <div class="text-right">
                        <button class="btn btn-flat btn-success" onclick="create()"><i class="fa fa-floppy-o"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{ HTML::script('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}

<script type="text/javascript">
    $(function(){
        $('[name=normal]').wysihtml5();
    });

    function create()
    {
        var service_id = $('[name=service_id]').val();
        var name = $('[name=name]').val();
        var unit = $('[name=unit]').val();
        var datatype = $('[name=datatype]').val();
        var expression = $('[name=expression]').val();

        var regulation_id = $('[name=regulation]').val();
        var method_id = $('[name=method]').val();
        var normal = $('[name=normal]').val();

        if(name != '' && datatype != '0')
        {
            $.ajax({
                url:"{{ URL::to('parameter')}}",
                type:'POST',
                data:{service_id : service_id,
                    regulation_id : regulation_id,
                    method_id : method_id,
                    name : name,
                    unit : unit,
                    datatype : datatype,
                    expression : expression,
                    normal : normal},
                success:function(){
                    
                    window.location = "{{ URL::to('pemeriksaan') }}/"+service_id;
                    
                } 
            });
        }
        else
        {
            window.alert('Informasi yang dibutuhkan belum lengkap!!');
        }
    }
</script>
@stop