@extends('layout/base')

@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Profile User</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <center><i class="fa fa-user fa-5x"></i></center>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <center>Profile User</center>
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td width="40%">Nama User</td>
                                        <td>&nbsp; <strong> {{ Auth::user()->username }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td>&nbsp; <strong> {{ Auth::user()->employee->name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Level User</td>
                                        <td>&nbsp; <strong> {{ Auth::user()->role }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

@stop