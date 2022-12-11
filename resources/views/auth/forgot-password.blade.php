{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
		integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- JQuery Lib -->
	<script type="text/javascript" src="http://classrooom.test/lib/jquery/jquery3.4.1.min.js"></script>
	<!-- Bootstrap Lib -->
	<link href="https://fonts.googleapis.com/css?family=Exo 2" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css"
		integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
		integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
		integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script type="text/javascript"
		src="http://coderoj.com/style/lib/editarea_0_8_2/edit_area/edit_area_full.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Exo 2" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://classrooom.test/css/home.css">
	<script type="text/javascript" src="http://classrooom.test/js/home/home.js"></script>
	<style type="text/css">
		body {
			background: #ffffff;
		}
	</style>
	<style type="text/css">
		.loginArea {
			margin-top: 130px;
		}
	</style>
</head>

<body>
	<div class="container">

		<div class="row">
			<div class="col-md-8" style="text-align: center;">
				<div class="homeLeft text-center">
					<a class="homeTextArea" href="/">
							<span class="doubleTxtRed welcomeTxt">EduHome</span>
						{{-- </a> --}}
						<div class="homeTitleArea">
							<span class="doubleTxtBlue titleTxt">Virtual </span>
							<span class="doubleTxtBlue titleTxt">Class </span>
							<span class="doubleTxtBlue titleTxt">Room</span>
						</div>
					</a>
					<img style="width: 90%" src="http://classrooom.test/img/site/studying.svg">
				</div>
			</div>
			<div class="col-md-4">
                <form class="loginArea" method="POST"  action="{{ route('password.email') }}">
					@csrf
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
					<div class="inputArea" id="loginArea">
						@if ($errors->any())
							<ul style="padding: 0; margin: 0; list-style-type: none;">
								@foreach ($errors->all() as $error)
									<li style="padding: 0; margin: 0; font-size: 12px; color: red">{{ $error }}</li>
								@endforeach
							</ul>
						@endif
						<div class="loginInputLabel">Email</div>
						<input type="email" id="email" name="email" placeholder="Enter Email">

						<div class="pull-right" style="margin-bottom: 0px;">
							<a id="myLink" href="{{ route('login') }}">
								<i class="fa fa-home" aria-hidden="true"></i>
								<b>Login</b>
							</a>
						</div>
						<button class="loginBtn btnRed" id="loginBtn" type="submit">Email Password Reset Link</button>
					</div>
				</form>
			</div>
		</div>

	</div>
    @if (session('status'))
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire(
                'Success',
                'Reset password Link has been sent to your email',
                'success'
            )
        </script>
    @endif
</body>

</html>
