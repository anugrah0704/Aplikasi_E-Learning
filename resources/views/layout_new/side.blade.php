<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        @if(auth()->user()->isAdmin())
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="fas fa-tachometer-alt menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('auth.change-password') }}">
                <i class="fa-solid fa-key"></i>
            <span class="menu-title">&nbsp;&nbsp;&nbsp;&nbsp;Ganti Password</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.guru-mapel.index')}}">
                <i class="fas fa-users-cog menu-icon"></i>
            <span class="menu-title"> Guru Mata Pelajaran</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
            </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.siswa.index') }}">
                <i class="fas fa-users menu-icon"></i>
            <span class="menu-title">Daftar Siswa</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.guru.index') }}">
                <i class="fas fa-chalkboard-teacher menu-icon"></i>
            <span class="menu-title"> Daftar Guru</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.mapel.index')}}">
            <i class="mdi mdi-book-open-variant"></i>
            <span class="menu-title">&nbsp;&nbsp;&nbsp;&nbsp;Master Mapel</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.kelas.index')}}">
            <i class="mdi mdi-book-open-variant"></i>
            <span class="menu-title">&nbsp;&nbsp;&nbsp;&nbsp;Master Kelas</span>
            </a>
        </li>

        @endif

{{-- =============================================================================================================== --}}
{{-- =============================================================================================================== --}}

        @if(auth()->user()->isGuru())
      <li class="nav-item">
        <a class="nav-link " href="{{route('guru.index')}}">
            <i class="fas fa-chalkboard menu-icon"></i>
          <span class="menu-title">DASHBOARD</span>
        </a>
      </li><!-- End Dashboard Guru  -->

      <li class="nav-heading">Page</li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('auth.change-password') }}">
                <i class="fa-solid fa-key"></i>
                <span class="menu-title">&nbsp; Ganti Password</span>
            </a>
        </li><!-- End Ujian -->


        <li class="nav-item">
            <a class="nav-link" href="{{ route('guru.daftar_siswa') }}">
                <i class="fas fa-users"></i> <!-- Ikon untuk Daftar Siswa -->
                <span class="menu-title">Daftar Siswa</span>
            </a>
        </li><!-- End Daftar Siswa -->

        <li class="nav-item">
            <a class="nav-link" href="{{ route('guru.manajemen-ujian.index') }}">
                <i class="fas fa-file-alt"></i> <!-- Ikon untuk Management Ujian -->
                <span class="menu-title">Management Ujian</span>
            </a>
        </li><!-- End Management Ujian -->

        <li class="nav-item">
            <a class="nav-link" href="{{ route('guru.materi.index') }}">
                <i class="fas fa-book"></i> <!-- Ikon untuk Management Materi -->
                <span class="menu-title">Management Materi</span>
            </a>
        </li><!-- End Management Materi -->

        <li class="nav-item">
            <a class="nav-link" href="{{ route('guru.tugas-siswa.index') }}">
                <i class="fas fa-tasks"></i> <!-- Ikon untuk Tugas Siswa -->
                <span class="menu-title">Tugas Siswa</span>
            </a>
        </li><!-- End Tugas Siswa -->


      @endif

{{-- =============================================================================================================== --}}
{{-- =============================================================================================================== --}}


    @if(auth()->user()->isSiswa())
    <li class="nav-item">
        <a class="nav-link" href="{{route('siswa.index')}}">
            <i class="fas fa-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{ route('auth.change-password') }}">
            <i class="fa-solid fa-key"></i>
            <span class="menu-title">&nbsp; Ganti Password</span>
        </a>
    </li><!-- End Ujian -->

    <li class="nav-item">
        <a class="nav-link " href="{{ route('siswa.ujian.index') }}">
            <i class="fas fa-file-alt"></i>
            <span class="menu-title">&nbsp; Ujian</span>
        </a>
    </li><!-- End Ujian -->

    <li class="nav-item">
        <a class="nav-link " href="{{ route('siswa.materi.index') }}">
            <i class="fas fa-book"></i>
            <span class="menu-title">&nbsp; Materi</span>
        </a>
    </li><!-- End Materi -->

    <li class="nav-item">
        <a class="nav-link " href="{{ route('siswa.tugas.index') }}">
            <i class="fas fa-tasks"></i>
            <span class="menu-title">&nbsp; Tugas</span>
        </a>
    </li><!-- End Tugas -->


    <li class="nav-item">
    <a class="nav-link " href="{{ route('siswa.profil_siswa', ['id' => $user->id ?? '']) }}">
        <i class="mdi mdi-account-outline"></i>
        <span class="menu-title">Profile</span>
    </a>
    </li><!-- End Profile Page Nav -->

    @endif

    </ul>
  </nav>
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
