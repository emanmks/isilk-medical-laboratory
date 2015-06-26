@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        Penerimaan
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Laporan</a></li>
        <li><a href="{{ URL::to('tagihan') }}"><i class="active"></i> Penerimaan</a></li>
    </ol>
</section>

<section class="content invoice">    

    <div class="clear-fix"><br/></div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th>No. Kwitansi</th>
                        <th>No. Referensi</th>
                        <th>Tanggal</th>
                        <th>Biaya Pemeriksaan</th>
                        <th>Biaya Konsul</th>
                        <th>Tax</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($earnings as $earning)
                        <tr>
                            <td>{{ $earning->code }}</td>
                            <td>{{ $earning->earnable->code }}</td>
                            <td>{{ date('d-m-Y', strtotime($earning->earning_date)) }}</td>
                            <td>Rp{{ number_format($earning->costs,2,",",".") }}</td>
                            <td>Rp{{ number_format($earning->fee,2,",",".") }}</td>
                            <td>Rp{{ number_format($earning->tax,2,",",".") }}</td>
                            <td>Rp{{ number_format($earning->total,2,",",".") }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <center>{{ $earnings->links() }}</center>
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
</script>
@stop