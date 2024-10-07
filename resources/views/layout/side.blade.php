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
        <a class="nav-link " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>PELAJARAN</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('siswa.bhs_indo')}}">
              <i class="bi bi-circle"></i><span>BAHASA INDONESIA</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.bhs_inggris')}}" >
              <i class="bi bi-circle"></i><span>BAHASA INGGRIS</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.bhs_jawa')}}">
              <i class="bi bi-circle"></i><span>BAHASA JAWA</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.bk')}}">
              <i class="bi bi-circle"></i><span>BK</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.informatika')}}">
              <i class="bi bi-circle"></i><span>INFORMATIKA</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.ipa')}}">
              <i class="bi bi-circle"></i><span>IPA</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.ips')}}">
              <i class="bi bi-circle"></i><span>IPS</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.mtk')}}">
              <i class="bi bi-circle"></i><span>MATEMATIKA</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.pai')}}">
              <i class="bi bi-circle"></i><span>PAI</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.pjok')}}">
              <i class="bi bi-circle"></i><span>PJOK</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.ppkn')}}">
              <i class="bi bi-circle"></i><span>PPKN</span>
            </a>
          </li>
          <li>
            <a href="{{route('siswa.seni')}}">
              <i class="bi bi-circle"></i><span>SENI BUDAYA</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('siswa.jadwal')}}">
          <i class="bi bi-grid"></i>
          <span>JADWAL MAPEL</span>
        </a>
      </li><!-- End Jadwal Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('siswa.profil_siswa')}}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->
