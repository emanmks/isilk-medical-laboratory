@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1><i class="fa fa-files-o"></i> Hasil Uji</h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Laboratorium</a></li>
        <li><a href="{{ URL::to('hasil') }}"><i class="active"></i> Hasil Uji</a></li>
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
            
    <!--
    <div class="row">
        <div class="col-lg-2">
            <input type="text" id="inputDateFilter" class="form-control" value="{{  date('Y-m-d') }}" data-provide="datepicker">
        </div>
    </div>
    -->

    @foreach(array_chunk($laboratories->all(), 4) as $item)
        <div class="row">
            @foreach($item as $laboratory)
                <div class="col-lg-3">
                    <div class="thumb-menu">
                        <a href="{{ URL::to('laboratorium') }}/{{ $laboratory->id }}" data-toggle="tooltip" data-placement="top" title="Rangkuman Pendaftaran"><h1><i class="fa fa-file text-info"></i></h1></a>

                        <a href="{{ URL::to('laboratorium') }}/{{ $laboratory->id }}" data-toggle="tooltip" data-placement="top" title="Rangkuman Pendaftaran">#{{ $laboratory->code }}</a><br/>

                        {{ $laboratory->registrant->name }} <br/>
                        
                        <!--
                        <i class="fa fa-medkit"></i> |&nbsp;
                        @foreach($laboratory->choices as $choice)
                            {{ $choice->examinable->name }}, &nbsp;
                        @endforeach

                        <br/>

                        <i class="fa fa-flask"></i> |&nbsp;
                        @foreach($laboratory->samplings as $sampling)
                            @if($sampling->taken == 0)
                                <a href="{{ URL::to('sampling') }}/{{ $sampling->id }}" class="text-warning" data-toggle="tooltip" data-placement="top" title="Ambil Sampel">{{ '@'.$sampling->code }}</a>&nbsp;
                            @else
                                <a href="{{ URL::to('entry') }}/{{ $sampling->id }}" class="text-success" data-toggle="tooltip" data-placement="top" title="Periksa Sampel">{{ '@'.$sampling->code }}</a>
                            @endif
                        @endforeach

                        <br/>
                        -->
                            
                        @if($laboratory->verified == 0)
                            Verified : <span class="text-danger">Belum</span>
                            <a href="#" onclick="verify({{ $laboratory->id }})" data-toggle="tooltip" data-placement="top" title="Set Status Verified"><i class="fa fa-edit"></i></a>
                        @else
                            Verified : <span class="text-primary">Sudah</span>
                            <a href="#" onclick="unverify({{ $laboratory->id }})" data-toggle="tooltip" data-placement="top" title="Batalkan Status Verified"><i class="fa fa-edit text-danger"></i></a>
                        @endif

                        <br/>

                        @if($laboratory->released == 0)
                            Released : <span class="text-danger">Belum</span>
                            <a href="#" onclick="release({{ $laboratory->id }})" data-toggle="tooltip" data-placement="top" title="Set Status Released"><i class="fa fa-check"></i></a>
                        @else
                            Released : <span class="text-success">Sudah</span>
                            <a href="#" onclick="unrelease({{ $laboratory->id }})" data-toggle="tooltip" data-placement="top" title="Batalkan Status Released"><i class="fa fa-check text-danger"></i></a>
                        @endif

                        <br/>

                        @if($laboratory->verified == 1 && $laboratory->released)
                            <a href="#" onclick="showFormSelectLayout({{ $laboratory->id }})" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Lihat Hasil Uji"><i class="fa fa-file"></i> Lihat LHU</a>
                        @else
                            <a href="#" class="btn btn-default btn-xs" disabled><i class="fa fa-file"></i> Lihat LHU</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</section>

<!-- Form Select Layout [modal]
===================================== -->
<div id="formSelectLayout" class="modal fade" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 name="myModalLabel">Layout Laporan</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="layouts">Pilih Jenis Layout</label>
                        <div class="col-lg-7">
                            <input type="hidden" name="laboratory_id" value="0">
                            <select class="form-control" name="layouts">
                                <option value="1">Standar</option>
                                <option value="2">Horizontal</option>
                                <option value="3">Naratif</option>
                                <option value="4">Surat</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="desc">Standar</label>
                        <div class="col-lg-7">
                           <p>
                               Deskripsi Laporan Standar
                           </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="desc">Horizontal</label>
                        <div class="col-lg-7">
                           <p>
                               Deskripsi Laporan Horizontal
                           </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="desc">Naratif</label>
                        <div class="col-lg-7">
                           <p>
                               Deskripsi Laporan Naratif
                           </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="desc">Surat</label>
                        <div class="col-lg-7">
                           <p>
                               Deskripsi Laporan Surat
                           </p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="show()" data-dismiss="modal" aria-hidden="true">Pilih</button>
            </div>
       </div>
   </div>
</div>
<!-- End of Select Layout [modal] -->

{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}

<script type="text/javascript">
    $(function(){
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });

    function showFormSelectLayout(id){

        $('#formSelectLayout').modal('show');
        $('[name=laboratory_id]').val(id);

    }

    function verify(id){

        if(confirm("Anda akan Memverifikasi Hasil Pemeriksaan dalam Nomor Lab ini?"+
                    "\\n"+"Yakin akan melakukan ini?!"))
        {
            $.ajax({
                url:"{{ URL::to('hasil') }}/"+id+"/verifikasi",
                type:"PUT",
                success:function(){
                    window.location = "{{ URL::to('hasil') }}";
                }
            });
        }

    }

    function unverify(id){

        if(confirm("Anda akan Membatalkan Verifikasi Hasil Pemeriksaan dalam Nomor Lab ini?"+
                    "\\n"+"Yakin akan melakukan ini?!"))
        {
            $.ajax({
                url:"{{ URL::to('hasil') }}/"+id+"/batalverifikasi",
                type:"PUT",
                success:function(){
                    window.location = "{{ URL::to('hasil') }}";
                }
            });
        }

    }

    function release(id){

        if(confirm("Anda akan Merilis Hasil Pemeriksaan dalam Nomor Lab ini?"+
                    "\\n"+"Yakin akan melakukan ini?!"))
        {
            $.ajax({
                url:"{{ URL::to('hasil') }}/"+id+"/rilis",
                type:"PUT",
                success:function(){
                    window.location = "{{ URL::to('hasil') }}";
                }
            });
        }

    }

    function unrelease(id){

        if(confirm("Anda akan Membatalkan Rilis Hasil Pemeriksaan dalam Nomor Lab ini?"+
                    "\\n"+"Yakin akan melakukan ini?!"))
        {
            $.ajax({
                url:"{{ URL::to('hasil') }}/"+id+"/batalrilis",
                type:"PUT",
                success:function(){
                    window.location = "{{ URL::to('hasil') }}";
                }
            });
        }

    }

    function show(){

        var id = $('[name=laboratory_id]').val();
        var layout_selected = $('[name=layouts]').val();
        var layout_to_show = "";

        if(id && layout_selected){

            switch(layout_selected){
                case "1":
                    layout_to_show = "/konvensional";
                    break;

                case "2":
                    layout_to_show = "/horizontal";
                    break;

                case "3":
                    layout_to_show = "/naratif";
                    break;

                case "4":
                    layout_to_show = "/surat";
                    break;

                default:
                    layout_to_show = "/konvensional";

            }

            window.location = "{{ URL::to('hasil') }}/"+id+layout_to_show;

        }

    }
</script>

@stop