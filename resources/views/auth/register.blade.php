<!DOCTYPE html>
<html lang="en">

<head>

    <title>Register</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    @include('includes.css-plugin')
</head>


<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <img src="assets/images/logo-dark.png" alt="" class="img-fluid mb-4">
                            <h4 class="mb-3 f-w-400">Register</h4>
                            <div class="form-group mb-4 text-left">
                                <label class="form-label required" for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group text-left mb-4">
                                <label class="form-label required" for="Email">Email address</label>
                                <input type="email" name="email" class="form-control" id="Email"
                                    value="{{ old('email')?old('email'):$invitation->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-4 text-left">
                                <label class="form-label required" for="Password">Password</label>
                                <input type="password" name="password" class="form-control" id="Password"
                                    placeholder="">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                         
                            <input type="hidden" name="token" value="{{ old('token')?old('token'):$invitation->token }}">

                            <button class="btn btn-block btn-primary mb-4" type="submit">Register</button>
                            <p class="mb-0 text-muted">You have an account? <a href="{{route('login') }}"
                                    class="f-w-400">Login In</a></p>
                        </div>
                    </form>
					
				</div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center text-center">
                        @if (session('error'))
                            <div class="alert alert-danger alert-msg" >
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- Required Js -->
@include('includes.js-plugin')

<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').change(function() {
            this.value = (Number(this.checked));
        });
        setTimeout(() => {
            $(".alert-msg").hide();
        }, 1000);
    })
</script>

</body>

</html>
