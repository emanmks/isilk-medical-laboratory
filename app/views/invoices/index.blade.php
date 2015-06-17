@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->

<section class="content-header">
    <h1>
        Invoice
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Laporan</a></li>
        <li><a href="{{ URL::to('tagihan') }}"><i class="active"></i> Invoice</a></li>
    </ol>
</section>

<section class="content">    

    <div class="clear-fix"><br/></div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th>No. Invoice</th>
                        <th>No. Lab</th>
                        <th>Dibebankan Pada</th>
                        <th>Biaya Pemeriksaan</th>
                        <th>Biaya Konsul</th>
                        <th>Tax</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->code }}</td>
                            <td>{{ $invoice->laboratory->code }}</td>
                            <td>{{ $invoice->financer->name }}</td>
                            <td>{{ format_number($invoice->costs,2,",",".") }}</td>
                            <td>{{ format_number($invoice->fee,2,",",".") }}</td>
                            <td>{{ format_number($invoice->tax,2,",",".") }}</td>
                            <td>{{ format_number($invoice->total,2,",",".") }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <center>{{ $invoices->links() }}</center>
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