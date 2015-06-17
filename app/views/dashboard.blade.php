@extends('layout/base')

@section('content')

<section class="content-header">
    <h1>
        <i class="fa fa-flask"></i> Dashboard
        <small>Rangkuman Data Terkini</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/">Dashboard</a></li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-6">
            <!-- Bar chart -->
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Statistik Kunjungan 10 hari terakhir</h3>
                </div>
                <div class="box-body">
                    <div id="visit-chart" style="height: 200px;"></div>
                </div><!-- /.box-body-->
            </div><!-- /.box -->
        </div> 

        <div class="col-md-6">
            <!-- Bar chart -->
            <div class="box box-warning">
                <div class="box-header">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Statistik Penerimaan 10 hari terakhir</h3>
                </div>
                <div class="box-body">
                    <div id="earning-chart" style="height: 200px;"></div>
                </div><!-- /.box-body-->
            </div><!-- /.box -->
        </div>
    </div> 

    <div class="row">
        <div class="col-md-6">
            <!-- Bar chart -->
            <div class="box box-success">
                <div class="box-header">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">List Pendaftar Hari Ini</h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>No. Lab</th>
                                <th>Nama</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><strong class="text-primary"><i class="fa fa-medkit"></i> 1402093</strong></td>
                                <td>Nama Pasien</td>
                            </tr>
                            <tr>
                                <td><strong class="text-primary"><i class="fa fa-medkit"></i> 1402093</strong></td>
                                <td>Nama Pasien</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body-->
            </div><!-- /.box -->
        </div> 

        <div class="col-md-6">
            <!-- Bar chart -->
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">List Sampling Hari ini</h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>No. Lab</th>
                                <th>No. Sampel</th>
                                <th>Sampel</th>
                                <th>Terima</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><strong class="text-primary"><i class="fa fa-medkit"></i> 1402093</strong></td>
                                <td><strong class="text-info"><i class="fa fa-flask"></i> 90830</strong></td>
                                <td>Darah</td>
                                <td><span class="badge bg-green">Yes</span></td>
                            </tr>
                            <tr>
                                <td><strong class="text-primary"><i class="fa fa-medkit"></i> 1402093</strong></td>
                                <td><strong class="text-info"><i class="fa fa-flask"></i> 90830</strong></td>
                                <td>Darah</td>
                                <td><span class="badge bg-red">No</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body-->
            </div><!-- /.box -->
        </div>
    </div>

</section>

{{ HTML::script('assets/js/plugins/flot/jquery.flot.min.js') }}
{{ HTML::script('assets/js/plugins/flot/jquery.flot.categories.min.js') }}

<script type="text/javascript">
    $(function(){

        var visit_data = {
            data: [
                    ["24-11-2014", 10], ["25-11-2014", 8], ["26-11-2014", 4], ["27-11-2014", 13], ["28-11-2014", 17], 
                    ["01-12-2014", 9], ["02-12-2014", 16], ["03-12-2014", 11], ["04-12-2014", 20], ["05-12-2014", 5]
                ],
            color: "#3c8dbc"
        };

        var earning_data = {
           data: [
                    ["24-11-2014", 10000000], ["25-11-2014", 8000000], ["26-11-2014", 4000000], ["27-11-2014", 13000000], ["28-11-2014", 17000000], 
                    ["01-12-2014", 9000000], ["02-12-2014", 16000000], ["03-12-2014", 11000000], ["04-12-2014", 20000000], ["05-12-2014", 5000000]
                ],
            color: "#D69B12"
        };

        $.plot("#visit-chart", [visit_data], {
            grid: {
                borderWidth: 1,
                borderColor: "#f3f3f3",
                tickColor: "#f3f3f3"
            },
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: "center"
                }
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            }
        });

        $.plot("#earning-chart", [earning_data], {
            grid: {
                borderWidth: 1,
                borderColor: "#f3f3f3",
                tickColor: "#f3f3f3"
            },
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: "center"
                }
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            }
        });

    });
</script>
@stop