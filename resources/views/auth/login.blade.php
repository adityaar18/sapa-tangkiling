<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LOGIN SAPA TANGKILING</title>
    <link rel="stylesheet" href="{{asset('template1')}}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{asset('template1')}}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('template1')}}/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{asset('template1')}}/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="{{asset('template1')}}/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo text-center mb-3">
              <img src="{{asset('template')}}/images/logo.svg" alt="logo">
            </div>
            <h4>Selamat Datang</h4>
            <h6 class="font-weight-light">Silahkan login untuk mengakses layanan.</h6>

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="pt-3">
              @csrf
              <div class="form-group">
                <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
              </div>
              <div class="form-group position-relative">
                <input type="password" class="form-control form-control-lg" name="password" id="passwordInput" required placeholder="Kata Sandi">
              </div>
              <div class="form-group d-flex align-items-center">
                <input type="checkbox" id="showPasswordCheck" style="width:auto; margin-right:8px;" onclick="togglePassword()">
                <label for="showPasswordCheck" class="mb-0">Tampilkan Kata Sandi</label>
              </div>
              <script>
                function togglePassword() {
                  const input = document.getElementById('passwordInput');
                  const check = document.getElementById('showPasswordCheck');
                  input.type = check.checked ? 'text' : 'password';
                }
              </script>
              <div class="mt-3">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">MASUK</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('template1')}}/vendors/js/vendor.bundle.base.js"></script>
<script src="{{asset('template1')}}/js/off-canvas.js"></script>
<script src="{{asset('template1')}}/js/hoverable-collapse.js"></script>
<script src="{{asset('template1')}}/js/template.js"></script>
<script src="{{asset('template1')}}/js/settings.js"></script>
<script src="{{asset('template1')}}/js/todolist.js"></script>
</body>
</html>
