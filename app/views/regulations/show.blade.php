@extends('layout/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}

<section class="content-header">
    <h1>
        <i class="fa fa-gears"></i>
        {{ $regulation->name }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"> Data</a></li>
        <li><a href="{{ URL::to('regulasi') }}"> Regulasi</a></li>
        <li><a href="{{ URL::to('regulasi') }}/{{ $regulation->id }}"><i class="active"></i> {{ $regulation->name }}</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">{{ $regulation->name }}</h2>
            <p>
                {{ $regulation->description }}
            </p>
        </div>
    </div>
</section>

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('#inputDescription').wysihtml5();

        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })
    });


    function create()
    {
        var name = $('#inputName').val();
        var description = $('#inputDescription').val();

        if(name != ''){
            $.ajax({
                url:"{{ URL::to('regulasi') }}",
                type:'POST',
                data:{name : name, description : description},
                success:function(){
                    window.location = "{{ URL::to('regulasi') }}";
                }
            });
        }else{
            window.alert('Nama harus diisi');
        }
    }
</script>
@stop