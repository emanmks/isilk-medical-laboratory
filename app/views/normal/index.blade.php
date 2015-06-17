@extends('layout/base')

@section('content')
<section class="content-header">
    <h1>
        {{{ $parameter->name }}}
        <small>Alternatif Nilai Rujukan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Parameter Uji</a></li>
        <li><a href="{{ URL::to('parameter') }}/{{ $parameter->id }}"><i class="active"></i> {{ $parameter->name }}</a></li>
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
            <a class="btn btn-success" href="{{ URL::to('normal')}}/{{ $parameter->id }}/create" data-toggle="tooltip" data-placement="top" title="Tambah Baru"><i class="fa fa-plus"></i> Tambah Alternatif Nilai Rujukan</a>
        </div>

        <div class="col-lg-12">
            <small>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Referensi</th>
                            <th>Metode Uji</th>
                            <th>Nilai Rujukan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                    @foreach($parameter->normals as $normal)
                        <tr id="data-{{ $parameter->id }}">
                            <td>{{ $normal->regulation->name or 'Undefined' }}</td>
                            <td>{{ $normal->method->name or 'Undefined' }}</td>
                            <td>{{ $normal->normal }}</td>
                            <td>
                                <div class="mytooltip">
                                    <a href="{{ URL::to('normal') }}/{{ $normal->id }}/edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" type="button" onclick="destroy({{ $parameter->id }}, {{ $normal->id }})" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash-o text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </small>
        </div>

                
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });
    
    function showFormUpdate(id)
    {
        window.location = "{{ URL::to('normal/"+id+"/edit') }}";
    }
    
    function destroy(parameter,id)
    {
        if(confirm('Yakin menghapus parameter ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('normal') }}/"+id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('parameter/"+parameter+"')}}";
                }
            });
        }
    }
</script>
@stop