@extends('dashboard.layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')

	<div class="container-fluid">
		<div class="row no-gutter">
			<!-- The image half -->
			<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
				<div class="row wd-100p mx-auto text-center">
					<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
						<img src="{{URL::asset('dashboard/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
					</div>
				</div>
			</div>
			<!-- The content half -->
			<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
				<div class="login d-flex align-items-center py-2">
					<!-- Demo content-->
					<div class="container p-0">
						<div class="row">
							<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
								<div class="card-sigin">
									<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
									<div class="card-sigin">
										<div class="main-signup-header">
											<h2>{{__('dashboard/login.welcome_back')}}</h2>
											<h5 class="font-weight-semibold mb-4">{{__('dashboard/login.please_sign_in')}}</h5>
											
											
											@error('failed')
												<span style="color: red;">{{$message}}</span>	
											@enderror

											
											<div class="dropdown">
												<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													{{__('dashboard/login.select_login')}}
												</button>

												{{-- LOGIN AS DOCTOR , ADMIN , USER  --}}
												<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
													<button class="dropdown-item login-selector" data-type="web" type="button">{{__('dashboard/login.user')}}</button>
													<button class="dropdown-item login-selector" data-type="admin" type="button">{{__('dashboard/login.admin')}}</button>
													<button class="dropdown-item login-selector" data-type="doctor" type="button">{{__('dashboard/login.doctor')}}</button>
													<button class="dropdown-item login-selector" data-type="ray_employee" type="button">{{__('dashboard/login.xray_employee')}}</button>
													<button class="dropdown-item login-selector" data-type="patient" type="button">{{__('dashboard/login.patient')}}</button>

												</div>
											</div>

											<!-- Dynamic heading for selected login type -->
											<div id="login-type-heading" style="display: none; margin-top: 20px;">
												<h3 class="text-primary">{{__('dashboard/login.login_as')}} <span id="selected-login-type" class="font-weight-bold"></span></h3>
											</div>

											<div class="form login-form" id="form" style="display: none;">
												<form action="{{route('dashboard.login')}}" method="POST">
												@csrf
												
												<input type='hidden' name='guard' value=''>
												
												<div class="form-group">
													<label>{{__('dashboard/login.email')}}</label> <input class="form-control" placeholder="{{__('dashboard/login.enter_your_email')}}" type="email" name='email' value= "{{old('email')}}" autofocus>
												</div>
												<div class="form-group">
													<label>{{__('dashboard/login.password')}}</label> <input class="form-control" placeholder="{{__('dashboard/login.enter_your_password')}}" type="password" name='password' value = "{{old('password')}}" autofocus>
												</div>
												<button class="btn btn-main-primary btn-block" type="submit">{{__('dashboard/login.sign_in')}}</button>
												
												
												</form>
											</div>
											<div class="main-signin-footer mt-5">
												<p><a href="">{{__('dashboard/login.forgot_password')}}</a></p>
												<p>{{__('dashboard/login.no_account')}} <a href="{{ route('register') }}">{{__('dashboard/login.create_account')}}</a></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- End -->
				</div>
			</div><!-- End -->
		</div>
	</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
	const dropdownItems = document.querySelectorAll(".dropdown-item");
	const formDiv = document.getElementById("form");
	const loginTypeHeading = document.getElementById("login-type-heading");
	const selectedLoginTypeSpan = document.getElementById("selected-login-type");

	dropdownItems.forEach(function(item) {
		item.addEventListener("click", function() {
			const selectedGuard = item.getAttribute("data-type");
			const selectedText = item.textContent;
			console.log("Selected guard:", selectedGuard);

			// Query the hidden input more specifically
			const guardInput = document.querySelector("input[name='guard']");
			console.log(guardInput);
			if (guardInput) {
				guardInput.value = selectedGuard;
				console.log("Guard input value set to:", guardInput.value);
			} else {
				console.log("Guard input not found!");
			}

			// Update the heading with selected login type
			selectedLoginTypeSpan.textContent = selectedText;
			loginTypeHeading.style.display = "block";

			// Show the form
			formDiv.style.display = "block";
		});
	});
});
</script>

@endsection
@section('js')
@endsection