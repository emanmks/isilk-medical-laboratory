@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - WYSIWYG -->
{{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}

<section class="content-header">
    <h1><i class="fa fa-stethoscope"></i> Pemeriksaan</h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Laboratorium</a></li>
        <li><a href="{{ URL::to('entry') }}/{{ $sampling->id }}"><i class="active"></i> Pemeriksaan</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="list-group">
                <a href="#" class="list-group-item">
                    <i class="fa fa-medkit"></i> {{ $sampling->laboratory->code }}
                    <span class="pull-right text-muted small"><em>Nomor Lab</em></span>
                </a>

                <a href="#" class="list-group-item">
                    <i class="fa fa-flask"></i> {{ $sampling->code }} | {{ $sampling->speciment->name }}
                    <span class="pull-right text-muted small"><em>Nomor Spesimen</em></span>
                </a>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="list-group">
                <a href="#" class="list-group-item">
                    <i class="fa fa-medkit"></i> {{ $sampling->laboratory->registrant->name }}
                    <span class="pull-right text-muted small"><em>Pasien</em></span>
                </a>

                <a href="#" class="list-group-item">
                    <i class="fa fa-user"></i> {{ date('d-m-Y', strtotime($sampling->laboratory->registrant->birthdate)) }} | {{ floor((time() - strtotime($sampling->laboratory->registrant->birthdate)) / 31556926 ) }}
                    <span class="pull-right text-muted small"><em>Tgl Lahir / Usia</em></span>
                </a>
            </div>
        </div>

        <small>
            <div class="col-xs-3">
                <label for="form">Nama</label>
                <input type="text" class="form-control input-sm" name="name" value="{{ $sampling->name }}">
            </div>
            <div class="col-xs-3">
                <label for="form">Bentuk</label>
                <input type="text" class="form-control input-sm" name="form" value="{{ $sampling->form }}">
            </div>
            <div class="col-xs-3">
                <label for="form">Wadah</label>
                <input type="text" class="form-control input-sm" name="container" value="{{ $sampling->container }}">
            </div>
            <div class="col-xs-3">
                <label for="form">Volume</label>
                <input type="text" class="form-control input-sm" name="volume" value="{{ $sampling->volume }}">
            </div>
        </small>
        
    </div>

    <div class="row"><br/></div>

    <div class="row">
        <div class="col-xs-12">
            <div class="pull-right">
                <button class="btn btn-primary" onclick="store({{ $sampling->id }})" data-toggle="tooltip" data-placement="left" title="Entry Hasil Uji"><i class="fa fa-floppy-o"></i> Simpan</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            @foreach($sampling->examinations as $examination)
                <strong>Pemeriksaan {{ $examination->service->name }}</strong>
                <small>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Nilai</th>
                                <th>Satuan</th>
                                <!--<th>Type Data</th>-->
                                <th>Nilai Rujukan</th>
                                <th>Referensi</th>
                                <th>Metode Uji</th>
                                <th>Alternatif Nilai Rujukan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examination->results as $result)
                                <tr>
                                    <td><strong>{{ $result->parameter->name or 'Unknown' }}</strong></td>
                                    <td><input type="text" name="values" class="form-control input-sm" value="{{ $result->result or '' }}"></td>
                                    <td>{{ $result->parameter->unit or 'Unknown' }}</td>
                                    <!--<td>
                                         @if($result->parameter->datatype == 'INT')
                                            Bilangan Bulat
                                        @elseif($result->parameter->datatype == 'FLOAT')
                                            Bilangan Desimal
                                        @elseif($result->parameter->datatype == 'COMMENT')
                                            Komentar
                                        @elseif($result->parameter->datatype == 'CONDITION')
                                            Kondisional
                                        @else
                                            Tidak Diketahui
                                        @endif
                                    </td>-->
                                    <td>
                                        <textarea class="form-control input-sm" id="normal-{{ $result->id }}" name="normals" rows="5">{{ $result->normal }}</textarea>
                                        <input type="hidden" id="default-normal-{{ $result->id }}" value="{{ $result->normal }}">
                                    </td>
                                    <td>
                                        <input type="text" name="regulations" id="regulation-{{ $result->id }}" class="form-control input-sm" value="{{ $result->regulation }}">
                                        <input type="hidden" id="default-regulation-{{ $result->id }}" value="{{ $result->regulation }}">
                                    </td>
                                    <td>
                                        <input type="text" name="methods" id="method-{{ $result->id }}" class="form-control input-sm" value="{{ $result->method }}">
                                        <input type="hidden" id="default-method-{{ $result->id }}" value="{{ $result->method }}">
                                    </td>
                                    <td>
                                        <select class="form-control input-sm" name="alternatives" onchange="changeNormal({{ $result->id }})">
                                            <option value="0">--Nilai Rujukan Default</option>
                                            @foreach($result->parameter->normals as $normal)
                                                <option value="{{ $normal->id.'#'.$normal->normal }}">{{ $normal->regulation->name }}-{{ $normal->method->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </small>
            @endforeach  
        </div>
    </div>
</section>

{{ HTML::script('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}

<script type="text/javascript">
    $(function(){
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

        $("[id^='normal-']").wysihtml5({
            "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": false, //Italics, bold, etc. Default true
            "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": false, //Button which allows you to edit the generated HTML. Default false
            "link": false, //Button to insert a link. Default true
            "image": false, //Button to insert an image. Default true,
            "color": false, //Button to change color of font  
            "blockquote": false, //Blockquote  
        });
    });

    function changeNormal(id)
    {
        var alternatives = $('[name=alternatives]').val();

        if(alternatives == '0'){

            var default_normal = $('#default-normal-'+id).val();
            var default_regulation = $('#default-regulation-'+id).val();
            var default_method = $('#default-method-'+id).val();

            $('#normal-'+id).data("wysihtml5").editor.setValue(default_normal);
            $('#regulation-'+id).val(default_regulation);
            $('#method-'+id).val(default_method);

        }else{

            var alternatives_text = $('[name=alternatives] option:selected').text();

            var alt_splitted = alternatives.split("#");
            var alt_text_splitted = alternatives_text.split("-");

            var normal = alt_splitted[1];
            var regulation = alt_text_splitted[0];
            var method = alt_text_splitted[1];

            $('#normal-'+id).data("wysihtml5").editor.setValue(normal);
            $('#regulation-'+id).val(regulation);
            $('#method-'+id).val(method);

        }
    }

    function store(id){

        var name = $('[name=name]').val();
        var form = $('[name=form]').val();
        var container = $('[name=container]').val();
        var volume = $('[name=volume]').val();

        var values = [];
        var normals = [];
        var regulations = [];
        var methods = [];

        $('[name=values]').each(function(){
            values.push(this.value);
        });

        $('[name=normals]').each(function(){
            normals.push(this.value);
        });

        $('[name=regulations]').each(function(){
            regulations.push(this.value);
        });

        $('[name=methods]').each(function(){
            methods.push(this.value);
        });

        if(normals && regulations && methods){

            $.ajax({
                url:"{{ URL::to('entry') }}",
                type:"POST",
                data:{sampling_id : id, name:name, form:form, container:container, volume:volume,
                    normals:normals, regulations:regulations, methods:methods, values:values},
                success:function(){
                    window.location = "{{ URL::to('entry') }}/"+id;
                }
            });

        }

    }
</script>

@stop