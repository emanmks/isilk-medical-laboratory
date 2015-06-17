@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}

<section class="content-header">
    <h1>
        Parameter Uji
        <small>
            {{{ $service->name }}}
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Pemeriksaan</a></li>
        <li><a href="{{ URL::to('layanan') }}/{{ $service->id }}"><i class="active"></i> Parameter</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @if(Session::has('message'))
            <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif
            <div class="box">
                <div class="box-body table-responsive">

                     @if(!empty($service))
                        <a class="btn btn-success" href="{{ URL::to('parameter')}}/{{ $service->id }}/create" data-toggle="tooltip" data-placement="top" title="Tambah Baru"><i class="fa fa-plus"></i> Tambah Parameter</a>
                        @endif

                    <br/><br/>

                    <table class="table table-striped table-bordered table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Satuan</th>
                                <th>Type Data</th>
                                <th>Ekspresi Data</th>
                                <th>Nilai Normal</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="myTable">
                        @foreach($service->parameters as $parameter)
                            <tr id="data-{{ $parameter->id }}">
                                <td>
                                    <div class="mytooltip">
                                        <a href="{{ URL::to('parameter') }}/{{ $parameter->id }}" data-toggle="tooltip" data-placement="top" title="Klik Disini untuk Set Nilai Normal">{{ $parameter->name }}</a>
                                    </div>
                                </td>
                                <td>{{ $parameter->unit }}</td>
                                <td>
                                    @if($parameter->datatype == 'INT')
                                        Bilangan Bulat
                                    @elseif($parameter->datatype == 'FLOAT')
                                        Bilangan Desimal
                                    @elseif($parameter->datatype == 'COMMENT')
                                        Komentar
                                    @elseif($parameter->datatype == 'CONDITION')
                                        Kondisional
                                    @else
                                        Tidak Diketahui
                                    @endif
                                </td>
                                <td>{{ $parameter->expression }}</td>
                                <td>
                                    <div class="mytooltip">
                                        <a class="btn btn-success btn-xs" href="{{ URL::to('parameter') }}/{{ $parameter->id }}" data-toggle="tooltip" title="Lihat Nilai Normal">Nilai Normal</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="mytooltip">
                                        <a class="btn btn-primary btn-circle" href="{{ URL::to('parameter') }}/{{ $parameter->id }}/edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-circle" onclick="destroy({{ $service->id }}, {{ $parameter->id }})" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/datatables/dataTables.bootstrap.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('#data-table').dataTable();
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });
    
    function showFormUpdate(id)
    {
        window.location = "{{ URL::to('parameter/"+id+"/edit') }}";
    }
    
    function destroy(packet,id)
    {
        if(confirm('Yakin menghapus parameter ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('parameter') }}/"+id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('layanan/"+packet+"')}}";
                }
            });
        }
    }
</script>
@stop