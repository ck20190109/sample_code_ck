<!DOCTYPE html>
<html lang="en-CA">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin | Timeline-News | 2017 WWC</title>
	<!-- include summernote -->
	<link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
	<!-- include jquery -->
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<!-- include libraries BS3 -->
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<link id="team-css" href="{{ url('/') }}/css/team.css" rel="stylesheet" type="text/css" media="all">
	<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Cherry+Swash'>
	<link rel="stylesheet" href="{{ url('/') }}/css/menu/style.css">
	<script type="text/javascript">
        function goto_wwc() {
            window.open('{{ config('app.url') }}' + '{{ session('CURRENT') }}', "TEST - 2017 WWC");
        }
	</script>
</head>

<body>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">

				<!-- Collapsed Hamburger -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<!-- Branding Image -->
				<a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Admin | 2017 WWC') }}
				</a>
			</div>

			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<!-- Left Side Of Navbar -->
				<ul class="nav navbar-nav">
					&nbsp;
				</ul>

				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					@if (Auth::guest())
						<li><a href="{{ route('login') }}">Login</a></li>
						<li><a href="{{ route('register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="{{ route('logout') }}"
									   onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
										Logout
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	<nav>
		<a id="id-home" href="#" onclick="goto_wwc()">SHOW in 2017-WWC</a>
		<a id="id-news" href="{{ url('/') }}/post-all">NEWS</a>
		<a id="id-tops" href="{{ url('/') }}/menu-all">TOP MENUS</a>
		<a id="id-pages" href="{{ url('/') }}/page-all">PAGES</a>
		<a id="id-meta" href="{{ url('/') }}/postmeta-all">S.E.O.</a>
		<a id="id-social" href="{{ url('/') }}/option-all">TEAM</a>
		<a id="id-langs" href="{{ url('/') }}/lang-all">HOME PAGES</a>
		<a id="id-current" href="{{ url('/') }}/current">CURRENT LANGUAGE</a>
		<div class="animation start-A"></div>
	</nav>

    <div class="container">
		<h2 style="font-family: Raleway, sans-serif; font-weight: 600; text-transform: uppercase; color: #666; padding:10px">Current Language:</h2>

		<form id="fm_post" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Language Version:
                    <select name="current_lang" id="current_lang" style="padding: 6px 6px; border: 1px solid #c0c0c0; width: 100%; background: #fff; font-size: 14px;	color: #666; line-height: normal; outline: none;">
                        <option value="home" <?php echo (session('LANGUAGE')=='')? "selected" : ""?>>English</option>
						<option value="chinese" <?php echo (session('LANGUAGE')=='zh~~')? "selected" : ""?>>Chinese</option>
						<option value="french" <?php echo (session('LANGUAGE')=='fr~~')? "selected" : ""?>>French</option>
						<option value="german" <?php echo (session('LANGUAGE')=='de~~')? "selected" : ""?>>German</option>
						<option value="spanish" <?php echo (session('LANGUAGE')=='es~~')? "selected" : ""?>>Spanish</option>
						<option value="japanese" <?php echo (session('LANGUAGE')=='ja~~')? "selected" : ""?>>Japanese</option>
                    </select>
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label><br />
    				<input type="submit" value="Current" style="width:100px; margin-right:15px"/>
				</label>
			</p>
		</form>
	</div>
</body>
</html>
