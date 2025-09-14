<!DOCTYPE html>
<html lang="en">
<head>
  <x-meta />
</head>
<body>
  <div class="container-scroller">
    <!-- Navbar -->
    <x-navbar />

    <div class="container-fluid page-body-wrapper">
      <!-- Sidebar -->
      <x-sidebar />

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
              <div class="card card-tale h-100">
                <div class="card-body text-center">
                  <p class="mb-2 fw-bold">Jumlah Surat Hari Ini</p>
                  <h2 class="fs-30 mb-2">4006</h2>
                </div>
              </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
              <div class="card card-dark-blue h-100">
                <div class="card-body text-center">
                  <p class="mb-2 fw-bold">Jumlah Surat Minggu Ini</p>
                  <h2 class="fs-30 mb-2">61344</h2>
                </div>
              </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
              <div class="card card-light-blue h-100">
                <div class="card-body text-center">
                  <p class="mb-2 fw-bold">Jumlah Surat Bulan Ini</p>
                  <h2 class="fs-30 mb-2">34040</h2>
                </div>
              </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-3 mb-4">
              <div class="card card-light-danger h-100">
                <div class="card-body text-center">
                  <p class="mb-2 fw-bold">Jumlah Surat Tahun Ini</p>
                  <h2 class="fs-30 mb-2">47033</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
        <x-footer />
      </div>
    </div>
  </div>
  <x-script />
</body>
</html>
