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
										<div class="main-signup-header">
											<h2 class="text-primary">Get Started</h2>
											<h5 class="font-weight-normal mb-4">It's free to signup and only takes a minute.</h5>
											
											<div class="dropdown">
												<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Select your Singup
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
													<button class="dropdown-item login-selector" data-type="web" type="button">User</button>
													<button class="dropdown-item login-selector" data-type="admin" type="button">Admin</button>
												</div>
											</div>
											
											<!-- Dynamic heading for selected login type -->
											<div id="login-type-heading" style="display: none; margin-top: 20px;">
												<h3 class="text-primary">Signup as: <span id="selected-login-type" class="font-weight-bold"></span></h3>
											</div>
											
											<div class="form signup-form" id="form" style="display: none;">
											<form action="{{route('dashboad.signup')}}" method="POST">
												@csrf
												<input type="hidden" name="guard">
												<div class="form-group">
													<label>Firstname &amp; Lastname</label> 
													<input class="form-control" placeholder="Enter your firstname and lastname" type="text" name="name" value="{{old('name')}}">
													@error('name')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
												<div class="form-group">
													<label>Email</label> <input class="form-control" placeholder="Enter your email" type="email" name="email" value="{{old('email')}}">
													@error('email')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
												<div class="form-group">
													<label>Password</label> 
													<input class="form-control" placeholder="Enter your password" type="password" name="password">
													@error('password')
														<small class="text-danger">{{ $message }}</small>
													@enderror
													<div class="form-group">
													<label>Confirm Password</label> 
													<input class="form-control" placeholder="Confirm your password" type="password" name="password_confirmation">
													@error('password_confirmation')
														<small class="text-danger">{{ $message }}</small>
													@enderror
												</div>
												
												
											
											</div><button class="btn btn-main-primary btn-block" type="submit">Create Account</button>
												
											</form>
											
											
										</div>
										<div class="main-signup-footer mt-5">
											<p>Already have an account? <a href="{{route('login')}}">Sign In</a></p>
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