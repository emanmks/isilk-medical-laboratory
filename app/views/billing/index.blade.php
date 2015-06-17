@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1>
        Tagihan
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Keuangan</a></li>
        <li><a href="tagihan"><i class="active"></i> Tagihan</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @if(Session::has('message'))
            <div class="alert alert-info alert-dismissable">{{ Session::get('message') }}</div>
            @endif
            <div class="box">
                <div class="box-header">
                    
                </div>

                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-xs-2">
                            <input type="text" id="inputDateFilter" class="form-control" value="{{  date('Y-m-d') }}" data-provide="datepicker">
                        </div>
                    </div>

                    <br/>

                    <table class="table table-striped table-bordered table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>Nomor Lab</th>
                                <th>Pasien</th>
                                <th>Pemeriksaan</th>
                                <th>Konsul</th>
                                <th>Pajak</th>
                                <th>Dibebankan Pada</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($billings as $billing)
                            <tr>
                                <td>
                                    <div class="mytooltip">
                                        <a href="{{ URL::to('tagihan')}}/{{ $billing->id }}" class="label label-success" data-toggle="tooltip" data-placement="top" title="Detail Tagihan">{{ $billing->laboratory->code }}</a>
                                    </div>
                                </td>
                                <td>{{ $billing->laboratory->registrant->name }}</td>
                                <td>{{ $billing->cost }}</td>
                                <td>{{ $billing->fee }}</td>
                                <td>{{ $billing->tax }}</td>
                                <td>{{ $billing->financer->name }}</td>
                                <td>
                                    @if($billing->paid == 1)
                                        LUNAS
                                    @else
                                        Belum LUNAS
                                    @endif
                                </td>
                                <td>
                                    <div class="mytooltip">
                                        <a type="button" class="btn btn-primary btn-circle" href="{{ URL::to('tagihan') }}/{{ $billing->id }}" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-print"></i>
                                        </a>
                                        @if($billing->paid == 0)
                                        <a type="button" class="btn btn-primary btn-circle" href="{{ URL::to('tagihan') }}/{{ $billing->id }}/lunas" data-toggle="tooltip" data-placement="top" title="Lunas"><i class="fa fa-money"></i>
                                        </a>
                                        @elseif($billing->paid == 1)
                                        <a type="button" class="btn btn-primary btn-circle" href="{{ URL::to('tagihan') }}/{{ $billing->id }}/batal" data-toggle="tooltip" data-placement="top" title="Batalkan"><i class="fa fa-times"></i>
                                        </a>
                                        @endif
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

{{ HTML::script('assets/js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/datatables/dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}

<script type="text/javascript">
    $(function(){
        $('#inputDateFilter').datepicker({format:'yyyy-mm-dd',autoclose:true});

        $('#data-table').dataTable();
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });
</script>

@stop