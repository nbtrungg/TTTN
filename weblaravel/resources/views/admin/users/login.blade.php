
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng Nhập</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="\dist\css\login.css">
</head>
<body class="hold-transition login-page">
{{-- <div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h3 class="login-box-msg">ĐĂNG NHẬP</h3>
      @include('admin.users.alert')
      <form action="/admin/users/login/home" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pass" class="form-control" placeholder="Mật khẩu">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <strong>Google Recaptcha</strong>
          {!! NoCaptcha::renderJs() !!}
          {!! NoCaptcha::display() !!}
        </div>
        <div>
          <!-- /.col -->
          <div class="col-5" style="float: right">
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
          <!-- /.col -->
        </div>
        @csrf
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script> --}}


<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" action="/admin/users/login/home" method="post">
        @if(Session::has('error'))
        <span style="color: red">* {{Session::get('error')}}</span>
                @endif
				<div class="login__field">
          {{-- @include('admin.users.alert') --}}
					<i class="login__icon fas fa-user"></i>
					<input  style="display: block" type="text" class="login__input" name="email" placeholder="Email">
          @error('email')
                    <span style="color: red">* {{$message}}</span>
                  @enderror
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input style="display: block" type="password" class="login__input" name="pass" placeholder="Mật khẩu"><br>
          @error('pass')
          <span style="color: red">* {{$message}}</span>
                  @enderror
				</div>
        <div class="input-group mb-3">
          <strong>Google Recaptcha</strong>
          {!! NoCaptcha::renderJs() !!}
          {!! NoCaptcha::display() !!}
          @error('g-recaptcha-response')
                    <span style="color: red">* {{$message}}</span>
                  @enderror
        </div>
				<button type="submit" class="button login__submit">
					<br><span class="button__text">Đăng Nhập</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
        @csrf
			</form>
			<div class="social-login">
				<h3>ADMIN</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</body>
</html>
