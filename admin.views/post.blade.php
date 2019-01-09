<!DOCTYPE html>
<html lang="en-CA">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin | Timeline-News | 2017 WWC</title>
	<!-- include summernote -->
	<link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="{{ url('/') }}/js/summernote/dist/summernote.css">
	<link rel="stylesheet" href="{{ url('/') }}/css/bootstrap-datetimepicker.min.css" />
	<!-- include jquery -->
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<!-- include libraries BS3 -->
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/js/moment-with-locales.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/js/summernote/dist/summernote.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/js/summernote_wwc.js"></script>
	<script type="text/javascript">
        $(function() {
            $('.summernote').summernote({
                height: 500,
            });
        });
        $(document).ready(function() {
            $('.btn-codeview').click(function () {
                compose_load();
            });
            dt = new Date();
            if ($('#post_date').val()=="") {
                $('#post_date').val(dt.getFullYear()+'-'+(dt.getMonth()+1)+'-'+dt.getDate()+' '+dt.getHours()+':'+dt.getMinutes()+':'+dt.getSeconds());
                $('#post_modified').val(dt.getFullYear()+'-'+(dt.getMonth()+1)+'-'+dt.getDate()+' '+dt.getHours()+':'+dt.getMinutes()+':'+dt.getSeconds());
            }
        });
	</script>
	<script type="text/javascript">
        function formatDate(d){
            a1 = d.split(' ');
            a2 = a1[0].split('-');
            s = a2[0]+'-'+(a2[1].length==1?'0'+a2[1]:a2[1])+'-'+(a2[2].length==1?'0'+a2[2]:a2[2]);
            return s+' '+a1[1];
        }
        function upload() {
            fm = document.getElementById('fm_post');
            fm.action = '<?php echo url('/'); ?>/post-upload';
            fm.submit();
        }
        function updateName(o) {
            e = document.getElementById('post_name');
            e.value = o.value.toLowerCase().split(' ').join('-');
            e = document.getElementById('t_post_title');
            if (e.value=="") e.value = o.value;
        }
        function load() {
            id = document.getElementById('ID');
            fm = document.getElementById('fm_post');
            fm.action = '<?php echo url('/'); ?>/post-read/'+id.value;
            fm.submit();
        }
        function read(id) {
            fm = document.getElementById('fm_post');
            fm.action = '<?php echo url('/'); ?>/post-read/'+id;
            fm.submit();
        }
        function save() {
            extract_save();

            e1 = document.getElementById('post_content');
            e2 = document.getElementById('post_date');
            e3 = document.getElementById('post_modified');
            e4 = document.getElementById('post_title');
            e5 = document.getElementById('post_name');
            e6 = document.getElementById('post_status');
            e7 = document.getElementById('t_post_content');
            e8 = document.getElementById('t_post_title');
            e9 = document.getElementById('t_post_status');
            if (e1.value=="" || e2.value=="" || e3.value=="" || e4.value=="" || e5.value=="" || e6.value=="" || e7.value=="" || e8.value=="" || e9.value=="") {
                alert('Required Fields have not been filled.');
                return;
            }

            e2.value = formatDate(e2.value);
            e3.value = formatDate(e3.value);

            fm = document.getElementById('fm_post');
            fm.action = '<?php echo url('/'); ?>/post-save';
            fm.submit();
        }
        function dele(id) {
            y_n = confirm('Are you sure to delete the current record ?');
            if (!y_n) return;
            fm = document.getElementById('fm_post');
            fm.action = '<?php echo url('/'); ?>/post-delete/'+id;
            fm.submit();
        }
        function rese() {
            ele = document.getElementById('ID');
            ele.value="";
            ele = document.getElementById('post_date');
            ele.value="";
            ele = document.getElementById('post_date_gmt');
            ele.value="";
            ele = document.getElementById('post_content');
            ele.innerHTML="";
            ele = document.getElementById('post_title');
            ele.value="";
            ele = document.getElementById('post_excerpt');
            ele.value="";
            ele = document.getElementById('post_status');
            ele.value="";
            ele = document.getElementById('post_name');
            ele.value="";
            ele = document.getElementById('post_modified');
            ele.value="";
            ele = document.getElementById('post_modified_gmt');
            ele.value="";
            ele = document.getElementById('post_type');
            ele.value="post";
            ele = document.getElementById('post_mime_type');
            ele.value="";
            $('.summernote').summernote('code','')
            ele = document.getElementById('t_ID');
            ele.value="";
            ele = document.getElementById('t_post_content');
            ele.innerHTML="";
            ele = document.getElementById('t_post_title');
            ele.value="";
            ele = document.getElementById('t_post_status');
            ele.value="";
            ele = document.getElementById('t_post_type');
            ele.value="timeline_post";
        }
	</script>
	<link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
	<link id="team-css" href="{{ url('/') }}/css/team.css" rel="stylesheet" type="text/css" media="all">
	<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Cherry+Swash'>
	<link rel="stylesheet" href="{{ url('/') }}/css/menu/style.css">
	<script type="text/javascript">
        function goto_wwc() {
            ele = document.getElementById("post_name");
            if (ele != null) {
                p = "";
                e_t = document.getElementById("post_type");
                if (e_t != 'undefined') {
                    if (e_t.value == 'post') {
                        e_d = document.getElementById("post_date");
                        e_d = e_d.value.substring(0, 10).split('-').join('/');
                        p = 'News/NewsWithTimeLine/' + e_d + '/';
                    }
                    e_s = document.getElementById("post_status");
                    if (e_s.value!='publish') return;
                }
                if (ele.value != "" && ele.value!=null) {
                    if (ele.value=='online-booking')
                        window.open("https://ticket.2017wwc.com/","TICKET - 2017 WWC");
                    else
                        window.open('{{ config('app.url') }}' + p + '{{ $lang }}' + ele.value,"TEST - 2017 WWC");
                }
                else
                    window.open('{{ config('app.url') }}' + '{{ session('CURRENT') }}',"TEST - 2017 WWC");
            }
            else {
                window.open('{{ config('app.url') }}' + '{{ session('CURRENT') }}', "TEST - 2017 WWC");
            }
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
	<div class="container" style="width:100%">
		<h2 style="font-family: Raleway, sans-serif; font-weight: 600; text-transform: uppercase; color: #666; padding:10px; ">Timeline-News Editor</h2>
		<table style="font-size: 16px; margin-bottom: 15px;	width: 100%; border-top: 3px solid #e6e6e6;	border-bottom: 3px solid #e6e6e6;">
			<tbody>
			<tr>
				<!--th style="background: #e6e6e6;
                            font-size: 12px;
                            text-transform: uppercase;
                            color: #000000;
                            height: 40px;
                            text-align: center;
                            border-bottom: 3px solid #e6e6e6;
                            border-left: 1px solid #e6e6e6;
                            border-right: 1px solid #e6e6e6;"
                            >Id</th-->
				<th style="background: #e6e6e6;
                            	font-size: 12px;
                            	text-transform: uppercase;
                            	color: #000000;
                            	height: 40px;
                            	text-align: center;
                            	border-bottom: 3px solid #e6e6e6;
                            	border-left: 1px solid #e6e6e6;
                            	border-right: 1px solid #e6e6e6;"
				>Post Title</th>
				<th style="background: #e6e6e6;
                            	font-size: 12px;
                            	text-transform: uppercase;
                            	color: #000000;
                            	height: 40px;
                            	text-align: center;
                            	border-bottom: 3px solid #e6e6e6;
                            	border-left: 1px solid #e6e6e6;
                            	border-right: 1px solid #e6e6e6;"
				>Post Status</th>
				<th style="background: #e6e6e6;
                            	font-size: 12px;
                            	text-transform: uppercase;
                            	color: #000000;
                            	height: 40px;
                            	text-align: center;
                            	border-bottom: 3px solid #e6e6e6;
                            	border-left: 1px solid #e6e6e6;
                            	border-right: 1px solid #e6e6e6;"
				>Post Name</th>
				<!--th style="background: #e6e6e6;
                            font-size: 12px;
                            text-transform: uppercase;
                            color: #000000;
                            height: 40px;
                            text-align: center;
                            border-bottom: 3px solid #e6e6e6;
                            border-left: 1px solid #e6e6e6;
                            border-right: 1px solid #e6e6e6;"
                            >Post Date GMT</th-->
				<th style="background: #e6e6e6;
                            	font-size: 12px;
                            	text-transform: uppercase;
                            	color: #000000;
                            	height: 40px;
                            	text-align: center;
                            	border-bottom: 3px solid #e6e6e6;
                            	border-left: 1px solid #e6e6e6;
                            	border-right: 1px solid #e6e6e6;"
				>Post Content</th>
				<th style="background: #e6e6e6;
                            	font-size: 12px;
                            	text-transform: uppercase;
                            	color: #000000;
                            	height: 40px;
                            	text-align: center;
                            	border-bottom: 3px solid #e6e6e6;
                            	border-left: 1px solid #e6e6e6;
                            	border-right: 1px solid #e6e6e6;"
				>Post Date</th>
				<!--th style="background: #e6e6e6;
                            font-size: 12px;
                            text-transform: uppercase;
                            color: #000000;
                            height: 40px;
                            text-align: center;
                            border-bottom: 3px solid #e6e6e6;
                            border-left: 1px solid #e6e6e6;
                            border-right: 1px solid #e6e6e6;"
                            >Post Excerpt</th-->
				<!--th style="background: #e6e6e6;
                            font-size: 12px;
                            text-transform: uppercase;
                            color: #000000;
                            height: 40px;
                            text-align: center;
                            border-bottom: 3px solid #e6e6e6;
                            border-left: 1px solid #e6e6e6;
                            border-right: 1px solid #e6e6e6;"
                            >Post Modified</th-->
				<!--th style="background: #e6e6e6;
                            font-size: 12px;
                            text-transform: uppercase;
                            color: #000000;
                            height: 40px;
                            text-align: center;
                            border-bottom: 3px solid #e6e6e6;
                            border-left: 1px solid #e6e6e6;
                            border-right: 1px solid #e6e6e6;
                            line-height:12px"
                            >Post Modified GMT</th-->
				<!--th style="background: #e6e6e6;
                            font-size: 12px;
                            text-transform: uppercase;
                            color: #000000;
                            height: 40px;
                            text-align: center;
                            border-bottom: 3px solid #e6e6e6;
                            border-left: 1px solid #e6e6e6;
                            border-right: 1px solid #e6e6e6;"
                            >Post Type</th-->
				<!--th style="background: #e6e6e6;
                            font-size: 12px;
                            text-transform: uppercase;
                            color: #000000;
                            height: 40px;
                            text-align: center;
                            border-bottom: 3px solid #e6e6e6;
                            border-left: 1px solid #e6e6e6;
                            border-right: 1px solid #e6e6e6;
                            line-height:12px"
                            >Post Mime Type</th-->
			</tr>
            <?php foreach ($posts as $post) { ?>
			<tr onclick="read({{ $post->ID }})">
			<!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->ID }}</td-->
				<td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
				>{{ $post->post_title }}</td>
				<td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
				>{{ $post->post_status }}</td>
				<td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
				>{{ $post->post_name }}</td>
			<!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->post_date_gmt }}</td-->
				<td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
				>{{ substr($post->post_content,0,128) }}</td>
				<td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
				>{{ $post->post_date }}</td>
			<!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->post_excerpt }}</td-->
			<!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->post_modified }}</td-->
			<!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->post_modified_gmt }}</td-->
			<!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->post_type }}</td-->
			<!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->post_mime_type }}</td-->
			</tr>
            <?php } ?>
			</tbody>
		</table>
	</div>
	<div class="container">
		{{ $posts->links() }}

		<form id="fm_post" method="post" enctype="multipart/form-data">
			<div style="display: none;">
				<input type="hidden" id="t_post_parent" name="t_post_parent" value="{{ $t_post_parent }}" />
				<input type="hidden" id="isLoad" name="isLoad" value="" />
				<input type="hidden" name="page" value="{{ $page }}" />
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
			<h4 style="padding: 0px; margin:0px; text-align: center">News:</h4>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="ID" name="ID" placeholder="ID" value="{{ $ID }}" style="padding: 6px 6px; border: 1px solid #c0c0c0;	font-size: 14px; color: #666;" <?php echo ($ID)?"readonly":""; ?>/>
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Title:
					<input type="text" id="post_title" name="post_title" placeholder="Post Title*" value="{{ $post_title }}" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" onchange="updateName(this)" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Date:
					<input type="text" id="post_date" name="post_date" placeholder="Post Date*" value="{{ $post_date }}" style="padding: 6px 6px; border: 1px solid #c0c0c0;	font-size: 14px; color: #666;" />
				</label>
				<!--script type="text/javascript">
                    $("#post_date").datetimepicker({
                        format: "yyyy-mm-dd hh:ii:ss"
                    });
                </script-->
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Name:
					<input type="text" id="post_name" name="post_name" placeholder="Post Name*" value="{{ $post_name }}" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="post_date_gmt" name="post_date_gmt" placeholder="Post Date GMT*" value="{{ $post_date_gmt }}" style="padding: 6px 6px; border: 1px solid #c0c0c0;	font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Status:
					<select name="post_status" id="post_status" style="padding: 6px 6px; border: 1px solid #c0c0c0; width: 100%; background: #fff; font-size: 14px; color: #666; line-height: normal; outline: none;">
						<option value="publish" <?php echo ($post_status=='publish')? "selected" : ""?>>Publish</option>
						<option value="draft" <?php echo ($post_status=='draft')? "selected" : ""?>>Draft</option>
						<option value="auto-draft" <?php echo ($post_status=='auto-draft')? "selected" : ""?>>Auto-Draft</option>
						<option value="trash" <?php echo ($post_status=='trash')? "selected" : ""?>>Trash</option>
					</select>
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="post_excerpt" name="post_excerpt" placeholder="Post Excerpt*" value="{{ $post_excerpt }}" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Modified:
					<input type="text" id="post_modified" name="post_modified" placeholder="Post Modified*" value="{{ $post_modified }}" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
				<!--script type="text/javascript">
                    $("#post_modified").datetimepicker({
                        format: "yyyy-mm-dd hh:ii:ss"
                    });
                </script-->
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="post_modified_gmt" name="post_modified_gmt" placeholder="Post Modified GMT*" value="{{ $post_modified_gmt }}" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Title Image:
					<input type="file" id="post_large" name="post_large" placeholder="Large Picture*" style="width:100%; padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="post_type" name="post_type" placeholder="Post Type*" value="post" readonly style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px"><label>Content Images: (Under: {{ $post_image_path }})</label>
				<label style="width:100%" >
					<input type="file" id="post_image" name="post_image" placeholder="Picture*" style="float:left; width:85%; padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
					<input type="button" value="Upload First" style="margin-right:15px; float:right; " onclick="upload()" />
				</label>
				<label>
					<input type="button" value="Save" style="width:100px; margin-right:15px" onclick="save()" />
				</label>
				<label>
					<input type="button" value="Reset" style="width:100px" onclick="rese()">
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<textarea id="post_content" name="post_content" class="summernote" placeholder="Post Content*" rows="15" style="height:500px;">
	                    {{ $post_header }}
                        {{ $post_content }}
						{{ $post_footer }}
					</textarea>
				</label>
			</p>
			<h4 style="padding: 0px;  margin: 0px; text-align: center">Timeline:</h4>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="t_ID" name="t_ID" placeholder="Timeline ID" value="{{ $t_ID }}" style="padding: 6px 6px; border: 1px solid #c0c0c0;	font-size: 14px; color: #666;" readonly />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Title:
					<input type="text" id="t_post_title" name="t_post_title" placeholder="Tiemline Post Title*" value="{{ $t_post_title }}" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Content:
					<textarea id="t_post_content" name="t_post_content" placeholder="Timeline Post Content*" rows="5" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666; height:150px;">
                        <?php echo html_entity_decode($t_post_content); ?>
					</textarea>
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >Status:
					<select name="t_post_status" id="t_post_status" style="padding: 6px 6px; border: 1px solid #c0c0c0; width: 100%; background: #fff; font-size: 14px;	color: #666; line-height: normal; outline: none;">
						<option value="publish" <?php echo ($t_post_status=='publish')? "selected" : ""?>>Publish</option>
						<option value="draft" <?php echo ($t_post_status=='draft')? "selected" : ""?>>Draft</option>
					</select>
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<!--label><br />
                    <input type="button" value="Load" style="width:100px; margin-right:15px" onclick="load()" />
                </label-->
				<label><br />
					<input type="button" value="Save" style="width:100px; margin-right:15px" onclick="save()" />
				</label>
				<label><br />
					<input type="button" value="Delete" style="width:100px; margin-right:15px" onclick="dele({{ $ID }})" />
				</label>
				<label><br />
					<input type="button" value="Reset" style="width:100px" onclick="rese()">
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="post_mime_type" name="post_mime_type" placeholder="Post Mime Type*" value="{{ $post_mime_type }}" readonly style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="t_post_type" name="t_post_type" placeholder="Timeline Post Type*" value="timeline_post" readonly style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
		</form>
	</div>
	<div style="width:100%; height:50px; font-weight: bold " onclick="window.scrollTo( 0, 0 ); "><div style="float:right; margin: 100px; cursor: pointer; border: 1px solid #000; padding: 10px">UP</div></div>
	<div id="post_header" style="display:none"><?php echo htmlentities($post_header); ?></div>
	<div id="post_footer" style="display:none"><?php echo htmlentities($post_footer); ?></div>
	</body>
</html>
