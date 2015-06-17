@extends('layout/base')

@section('content')
<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}
{{ HTML::style('assets/css/datepicker/datepicker.css') }}

<section class="content-header">
    <h1>
        Data Penerimaan Biaya Pemeriksaan
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Keuangan</a></li>
        <li><a href="{{ URL::to('pembayaran') }}"><i class="active"></i> Penerimaan</a></li>
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
                                <th>Biaya Pemeriksaan</th>
                                <th>Biaya Konsultasi</th>
                                <th>Total</th>
                                <th>Kasir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>
                                    <div class="mytooltip">
                                        <a href="{{ URL::to('pembayaran')}}/{{ $payment->id }}" class="label label-success" data-toggle="tooltip" data-placement="top" title="Detail Biaya">{{ $payment->laboratory->code }}</a>
                                    </div>
                                </td>
                                <td>{{ $payment->laboratory->registrant->name }}</td>
                                <td>Rp{{ number_format($payment->cost,2,',','.') }}</td>
                                <td>Rp{{ number_format($payment->fee,2,',','.') }}</td>
                                <td>Rp{{ number_format($total = $payment->cost  + $payment->fee,2,',','.') }}</td>
                                <td>{{ $payment->laboratory->employee->name }}</td>
                                <td>
                                    <div class="mytooltip">
                                        <a type="button" class="btn btn-primary btn-circle" href="{{ URL::to('pembayaran') }}/{{ $payment->id }}" data-toggle="tooltip" data-placement="top" title="Cetak Kwitansi"><i class="fa fa-print"></i>
                                        </a>
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

{{ HTML::script('assets/js/plugins/dataTables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/dataTables/dataTables.bootstrap.js') }}
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