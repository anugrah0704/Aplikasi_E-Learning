  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>DASHBOARD</span>
        </a>
      </li><!-- End Dashboard Admin  -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('guru.index')}}">
          <i class="bi bi-grid"></i>
          <span>DASHBOARD</span>
        </a>
      </li><!-- End Dashboard Guru  -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('siswa.index')}}">
          <i class="bi bi-grid"></i>
          <span>DASHBOARD</span>
        </a>
      </li><!-- End Dashboard Siswa  -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('courses.index')}}">
          <i class="bi bi-grid"></i>
          <span>Manajemen Mata Pelajaran</span>
        </a>
      </li><!-- End Courses  -->


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
        <a class="nav-link collapsed" href="{{route('siswa.profil_siswa')}}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->
