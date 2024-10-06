  <!-- ======= Header ======= -->
  @include('layout.header')

  <!-- ======= Sidebar ======= -->
  @include('layout.side')

  <!-- ======= Konten Utama ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>@yield('page-title')</h1>
    </div><!-- Akhir Judul Halaman -->

    <section class="section dashboard">
      @yield('konten')
    </section>
  </main><!-- Akhir #main -->

  <!-- ======= Footer ======= -->
  @include('layout.footer')

