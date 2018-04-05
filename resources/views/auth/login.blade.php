@extends('auth.main')

@section('content')

	<div id="back-to-home">
		<a href="/" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
	</div>
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="index.html">
				<span><i class="fa fa-gg"></i></span>
				<span>UNEG</span>
			</a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
	<h4 class="form-title m-b-xl text-center">Iniciar Sesion</h4>
    <form method="POST" action="{{ route('login') }}">
            @csrf

		<div class="form-group">
			<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        </div>

		<div class="form-group">
			<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        </div>
		<input type="submit" class="btn btn-primary" value="ENTRAR">
	</form>
</div><!-- #login-form -->

<div class="simple-page-footer">
	<p>
		<a href="signup.html">Agregar Cuenta</a>
	</p>
</div><!-- .simple-page-footer -->


	</div><!-- .simple-page-wrap -->

@endsection

