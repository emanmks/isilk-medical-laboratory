@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        <i class="fa fa-tint"></i>
        Jenis Sampel / Spesimen
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('spesimen') }}"><i class="active"></i> Spesimen</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">
                <button class="btn btn-flat btn-success" onClick="showFormCreate()" data-toggle="tooltip" data-placement="left" title="Tambah Jenis Spesimen"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>

    @foreach(array_chunk($speciments->getCollection()->all(), 3) as $row)
        <div class="row">
            @foreach($row as $speciment)
                <div class="col-lg-4">
                    <center>
                        <h1 class="text-primary">
                            <i class="fa fa-tint"></i>
                        </h1>
                        <span class="text-primary">{{ $speciment->code }}</span> | 
                        <a href="{{ URL::to('spesimen') }}/{{ $speciment->id }}" data-toggle="tooltip" data-placement="top" title="Lihat Detail">{{ $speciment->name }}</a><br/>
                        <a href="#" onclick="showFormUpdate({{ $speciment->id }})"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Koreksi"></i></a>&nbsp;
                        <a href="#" class="text-danger" onclick="destroy({{ $speciment->id }})"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></i></a>&nbsp;
                        <input type="hidden" id="name-{{ $speciment->id }}" value="{{ $speciment->name }}">
                    </center>
                </div>
            @endforeach
        </div>
    @endforeach

    <center>{{ $speciments->links() }}</center>
</section>

<!-- Form Add speciment [modal]
===================================== -->
<div id="formCreate" class="modal fade" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 name="myModalLabel">Data Baru</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="name">Nama Sampel</label>
                        <div class="col-lg-7">
                            <input name="name" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="create()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
       </div>
   </div>
</div>
<!-- End of Add speciment [modal] -->

<!-- Form Update speciment [modal]
===================================== -->
<div id="formUpdate" class="modal fade" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 name="myModalLabel">Edit Detail</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="updated_name">Nama Sampel</label>
                        <div class="col-lg-7">
                            <inpu type="hidden" name="updated_id">
                            <input name="updated_name" class="form-control" type="text">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="update()" data-dismiss="modal" aria-hidden="true">Simpan</button>
            </div>
       </div>
   </div>
</div>
<!-- End of Update speciment [modal] -->

<!-- Page-Level Plugin Scripts - Tables -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function showFormCreate()
    {
        $('#formCreate').modal('show');
        $('[name=name]').val('');
    }

    function showFormUpdate(id)
    {
        $('#formUpdate').modal('show');
        $('[updated_id]').val(id);
        $('[updated_name]').val($('#name-'+id).val());
    }

    function create()
    {
        var name = $('[name=name]').val();

        if(name != ''){
            $.ajax({
                url:"{{ URL::to('spesimen') }}",
                type:'POST',
                data:{name : name},
                success:function(){
                    window.location = "{{ URL::to('spesimen') }}";
                }
            });
        }else{
            window.alert('Nama harus jelas');
        }
    }

    function update()
    {
        var id = $('[name=updated_id]').val();
        var name = $('[name=updated_name]').val();

        if(name != ''){
            $.ajax({
                url:"{{ URL::to('spesimen') }}/"+id,
                type:'PUT',
                data:{name : name},
                success:function(){
                    window.location = "{{ URL::to('spesimen') }}";
                }
            });
        }else{
            window.alert('Nama harus jelas');
        }
    }
    
    function destroy(id)
    {
         if(confirm('Yakin akan menghapus data ini?!'))
        {
            $.ajax({
                url:"{{ URL::to('spesimen') }}/"+id,
                type:'DELETE',
                success:function(){
                    window.location = "{{ URL::to('spesimen') }}";
                }
            });
        }
    }
</script>
@stop