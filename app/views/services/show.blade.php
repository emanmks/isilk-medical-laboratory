@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1><i class="fa fa-search"></i> {{ $service->name }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Parameter</a></li>
        <li><a href="{{ URL::to('pemeriksaan') }}/{{ $service->name }}"><i class="active"></i> {{ $service->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif
        </div>

        <div class="col-lg-12">
            <div class="pull-right">
                <a href="{{ URL::to('parameter') }}/{{ $service->id }}/create" class="btn btn-flat btn-success" data-toggle="tooltip" data-placement="left" title="Tambahkan Parameter Uji"><i class="fa fa-plus"></i></a>
            </div>
        </div>

        <div class="col-lg-12">
            <small>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Tipe Data</th>
                            <th>Satuan</th>
                            <th>Ekspresi</th>
                            <th>Rujukan</th>
                            <th>Referensi</th>
                            <th>Metode/Spesifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($service->parameters as $parameter)
                            <tr>
                                <td>
                                    <a href="{{ URL::to('parameter') }}/{{ $parameter->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Variasi Nilai Rujukan"><i class="fa fa-search"></i> {{ $parameter->name }}</a>
                                </td>
                                <td>{{ $parameter->datatype }}</td>
                                <td>{{ $parameter->unit }}</td>
                                <td>{{ $parameter->expression }}</td>
                                <td>
                                    {{ $parameter->normal }} <br/> 
                                    <small class="text-primary">
                                        <a href="{{ URL::to('parameter') }}/{{ $parameter->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Variasi Nilai Rujukan">
                                            {{ $parameter->normals->count() }}
                                            Alternatif Nilai Rujukan Lainnya
                                        </a>
                                    </small>
                                </td>
                                <td>{{ $parameter->regulation->name or 'Undefined' }}</td>
                                <td>{{ $parameter->method->name or 'Undefined' }}</td>
                                <td>
                                    <a href="{{ URL::to('parameter') }}/{{ $parameter->id }}/edit" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" onclick="destroy({{ $service->id }},{{ $parameter->id }})" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </small>
        </div>
    </div>
</section>

<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function destroy(service,parameter)
    {
        if(confirm("Yakin akan menghilangkan parameter uji ini?!"))
        {
            $.ajax({
                url:"{{ URL::to('parameter') }}/"+parameter,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('pemeriksaan') }}/"+service;
                }
            });
        }
    }
</script>

@stop