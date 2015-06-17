<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        @if($menu == 'dashboard')<li class="active">@else<li>@endif
            <a href="{{ URL::to('/') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
        </li>

        @if($menu == 'registration')<li class="active">@else<li>@endif
            <a href="{{ URL::to('laboratorium') }}"><i class="fa fa-file"></i> Pendaftaran</a>
        </li>

        @if($menu == 'sampling')<li class="active">@else<li>@endif
            <a href="{{ URL::to('sampling') }}"><i class="fa fa-flask"></i> Penerimaan Sampel</a>
        </li>

        @if($menu == 'examination')<li class="active">@else<li>@endif
            <a href="{{ URL::to('entry') }}"><i class="fa fa-stethoscope"></i> Entry Hasil Uji</a>
        </li>

        @if($menu == 'result')<li class="active">@else<li>@endif
            <a href="{{ URL::to('hasil') }}"><i class="fa fa-files-o"></i> Laporan Hasil Uji</a>
        </li>

        @if($menu == 'service')<li class="active">@else<li>@endif
            <a href="{{ URL::to('pemeriksaan') }}"><i class="fa fa-medkit"></i> Jenis Pemeriksaan</a>
        </li>

        @if($menu == 'package')<li class="active">@else<li>@endif
            <a href="{{ URL::to('paket') }}"><i class="fa fa-medkit"></i> Paket Pemeriksaan</a>
        </li>

        @if($menu == 'datas')<li class="active">@else<li>@endif
            <a href="{{ URL::to('data') }}"><i class="fa fa-gears"></i> Data & Pengaturan</a>
        </li>

        @if($menu == 'report')<li class="active">@else<li>@endif
            <a href="{{ URL::to('laporan') }}"><i class="fa fa-files-o"></i> Laporan</a>
        </li>

        @if($menu == 'manual')<li class="active">@else<li>@endif
            <a href="{{ URL::to('manual') }}"><i class="fa fa-files-o"></i> Manual Aplikasi</a>
        </li>
    </ul>
</section>
<!-- /.sidebar -->