  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
    @if(auth()->user()->isAdmin())
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>DASHBOARD</span>
        </a>
      </li><!-- End Dashboard Admin  -->

      <li class="nav-heading">Halaman Utama</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.siswa.index') }}">
          <i class="bi bi-grid"></i>
          <span>Daftar Siswa</span>
        </a>
      </li><!-- End Courses  -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.guru.index') }}">
          <i class="bi bi-grid"></i>
          <span>Daftar Guru</span>
        </a>
      </li><!-- End Courses  -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.mapel.index')}}">
          <i class="bi bi-grid"></i>
          <span>Master Mapel</span>
        </a>
      </li><!-- End Master Mapel  -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.kelas.index')}}">
          <i class="bi bi-grid"></i>
          <span>Master Kelas</span>
        </a>
      </li><!-- End Master Mapel  -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Menu Utama</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin.guru-mapel.index')}}">
              <i class="bi bi-circle"></i><span>Guru Mata Pelajaran</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li>
          <li>
            <a href="forms-editors.html">
              <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
          </li>
          <li>
            <a href="forms-validation.html">
              <i class="bi bi-circle"></i><span>Form Validation</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.profil_admin', ['id' => $admin->id]) }}">Lihat Profil</a>
">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->


      @endif



{{-- =============================================================================================================== --}}
{{-- =============================================================================================================== --}}



      @if(auth()->user()->isGuru())
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('guru.index')}}">
          <i class="bi bi-grid"></i>
          <span>DASHBOARD</span>
        </a>
      </li><!-- End Dashboard Guru  -->

      <li class="nav-heading">Halaman Utama</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('guru.manajemen-ujian.index')}}">
          <i class="bi bi-grid"></i>
          <span>Management Ujian</span>
        </a>
      </li><!-- End Management Materi  -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('guru.materi.index')}}">
          <i class="bi bi-grid"></i>
          <span>Management Materi</span>
        </a>
      </li><!-- End Management Materi  -->

      @endif


{{-- =============================================================================================================== --}}
{{-- =============================================================================================================== --}}


      @if(auth()->user()->isSiswa())
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('siswa.index')}}">
          <i class="bi bi-grid"></i>
          <span>DASHBOARD</span>
        </a>
      </li><!-- End Dashboard Siswa  -->

      <li class="nav-heading">Halaman Utama</li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('siswa.ujian.index')}}">
          <i class="bi bi-grid"></i>
          <span>Ujian</span>
        </a>
      </li><!-- End Ujian  -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('siswa.materi.index')}}">
          <i class="bi bi-grid"></i>
          <span>Materi</span>
        </a>
      </li><!-- End Dashboard Siswa  -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('siswa.profil_siswa', ['id' => $user->id ?? '']) }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      @endif

    </ul>

  </aside><!-- End Sidebar-->
