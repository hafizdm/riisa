<!DOCTYPE html>
<html lang="en">
<head>
	<title>Rapid Infrastruktur Indonesia - System Application | Log in</title>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{asset('login-form/images/icons/favicon.ico')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/fonts/iconic/css/material-design-iconic-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/vendor/animate/animate.css')}}">	
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/vendor/css-hamburgers/hamburgers.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/vendor/animsition/css/animsition.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/vendor/select2/select2.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/vendor/daterangepicker/daterangepicker.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('login-form/css/util.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('login-form/css/main.css')}}">
</head>
<body>
	
    <div class="container-login100" style="background-color:black !important;">
			<div class="wrap-login100">
        <form action="{{ url('login') }}" method="post">
          {{ csrf_field() }}
				<a href="/"><span class="login100-form-logo">
          <img src="{{asset('login-form/images/logo.png')}}" style="width: 100px;height:100px">
					</span>
					</a>

					<!--<span class="login100-form-title p-b-34 p-t-27">-->
					<!-- RIISA - LOGIN-->
					<!--</span>-->
					<br>
					<br>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input type="text" class="input100 form-control "  name="username" placeholder="NIK" required>
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input type="password" class="input100 form-control " id= "password" name="password" placeholder="Kata Sandi" required>
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
						<span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
							<i id="slash" class="fa fa-eye-slash" style="display: block"></i>
							<i id="eye" class="fa fa-eye" style="display: none"></i>
						</span>
					</div>

					<!--<div class="contact100-form-checkbox">-->
					<!--	<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">-->
					<!--	<label class="label-checkbox100" for="ckb1">-->
					<!--		Remember me-->
					<!--	</label>-->
					<!--</div>-->

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							MASUK
						</button>
					</div>
				</form>
      </div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<script src="{{asset('login-form/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('login-form/vendor/animsition/js/animsition.min.js')}}"></script>
	<script src="{{asset('login-form/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('login-form/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('login-form/vendor/select2/select2.min.js')}}"></script>
	<script src="{{asset('login-form/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('login-form/vendor/daterangepicker/daterangepicker.js')}}"></script>
	<script src="{{asset('login-form/vendor/countdowntime/countdowntime.js')}}"></script>
	<script src="{{asset('login-form/js/main.js')}}"></script>
    <script type="text/javascript">
		function hideshow(){
			var password = document.getElementById("password");
			var slash = document.getElementById("slash");
			var eye = document.getElementById("eye");

			if(password.type === 'password'){
				password.type = "text";
				slash.style.display = "block";
				eye.style.display = "none";
			}
			else{
				password.type = "password";
				slash.style.display = "none";
				eye.style.display = "block";
			}
    	}
	</script>
</body>
</html>