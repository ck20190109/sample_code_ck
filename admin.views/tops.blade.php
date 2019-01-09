@extends('layouts.app')

@section('content')
	<script type="text/javascript">
        $(document).ready(function() {
            dt = new Date();
            if ($('#post_date').val()=="") {
                $('#post_date').val(dt.getFullYear()+'-'+(dt.getMonth()+1)+'-'+dt.getDate()+' '+dt.getHours()+':'+dt.getMinutes()+':'+dt.getSeconds());
                $('#post_modified').val(dt.getFullYear()+'-'+(dt.getMonth()+1)+'-'+dt.getDate()+' '+dt.getHours()+':'+dt.getMinutes()+':'+dt.getSeconds());
            }
        });
        function goto_wwc() {
            ele = document.getElementById("post_name");
            if (ele != null) {
                p = "";
                e_t = document.getElementById("post_type");
                if (e_t != null) {
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
	<script type="text/javascript">
	function formatDate(d){
		a1 = d.split(' ');
		a2 = a1[0].split('-');
		s = a2[0]+'-'+(a2[1].length==1?'0'+a2[1]:a2[1])+'-'+(a2[2].length==1?'0'+a2[2]:a2[2]);
		return s+' '+a1[1];
	}
	function updateName(o) {
		e = document.getElementById('post_name');
		e.value = o.value.toLowerCase().split(' ').join('-');
	}
	function load() {
		id = document.getElementById('ID');
		fm = document.getElementById('fm_post');
		fm.action = '<?php echo url('/'); ?>/menu-read/'+id.value;
		fm.submit();
	}
	function read(id) {
		fm = document.getElementById('fm_post');
		fm.action = '<?php echo url('/'); ?>/menu-read/'+id;
		fm.submit();
	}
	function save() {
		e1 = document.getElementById('menu_order');
		e2 = document.getElementById('post_date');
		e3 = document.getElementById('post_modified');
		e4 = document.getElementById('post_title');
		e5 = document.getElementById('post_name');
		e6 = document.getElementById('post_status');
		if (e1.value=="" || e2.value=="" || e3.value=="" || e4.value=="" || e5.value=="" || e6.value=="" || isNaN(e1.value)) {
			alert('Required Fields have not been filled.');
			return;
		}

        e2.value = formatDate(e2.value);
        e3.value = formatDate(e3.value);

		fm = document.getElementById('fm_post');
		fm.action = '<?php echo url('/'); ?>/menu-save';
		fm.submit();
	}
	function dele(id) {
		y_n = confirm('Are you sure to delete the current record ?');
		if (!y_n) return;
		fm = document.getElementById('fm_post');
		fm.action = '<?php echo url('/'); ?>/menu-delete/'+id;
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
		ele.value="";
		ele = document.getElementById('post_mime_type');
		ele.value="";
	}
	</script>
    <div class="container">
		<h2 style="font-family: Raleway, sans-serif; font-weight: 600; text-transform: uppercase; color: #666; padding:10px">Top Menu Editor</h2>
        <table style="font-size: 16px; margin-bottom: 15px;	width: 100%; border-top: 3px solid #e6e6e6;	border-bottom: 3px solid #e6e6e6;">
            <tbody>
                <tr>
					<th style="background: #e6e6e6;
                            	font-size: 12px;
                            	text-transform: uppercase;
                            	color: #000000;
                            	height: 40px;
                            	text-align: center;
                            	border-bottom: 3px solid #e6e6e6;
                            	border-left: 1px solid #e6e6e6;
                            	border-right: 1px solid #e6e6e6;"
								>Order</th>
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
                    <!--th style="background: #e6e6e6;
                            	font-size: 12px;
                            	text-transform: uppercase;
                            	color: #000000;
                            	height: 40px;
                            	text-align: center;
                            	border-bottom: 3px solid #e6e6e6;
                            	border-left: 1px solid #e6e6e6;
                            	border-right: 1px solid #e6e6e6;"
                            	>Post Content Filtered</th-->
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
                                >Post Date GMT</th-->
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
					<td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
								>{{ $post->menu_order }}</td>
					<!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
								>{{ $post->ID }}</td-->
                    <!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->post_content_filtered }}</td-->
                    <td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->post_title }}</td>
                    <!--td style="padding: 0 20px;
                            	height: 40px;
                            	line-height: normal;
                            	border: 1px solid #e6e6e6;
                            	font-size: 12px;
                            	color: #141414;
                            	text-align: left;"
                            	>{{ $post->post_excerpt }}</td-->
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
                            	>{{ $post->post_date_gmt }}</td-->
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
    	{{ $posts->links() }}

		<form id="fm_post" method="post">
			<div style="display: none;">
				<input type="hidden" id="isLoad" name="isLoad" value="" />
				<input type="hidden" name="page" value="{{ $page }}" />
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%; font-size: 14px;">Menu Order:<br />
					<input type="text" id="menu_order" name="menu_order" value="{{ $menu_order }}" style="padding: 6px 6px; border: 1px solid #c0c0c0;	font-size: 14px; color: #666;" />
				</label>
			</p>
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
					<input type="text" id="post_date" name="post_date" placeholder="Post Date*" value="{{ $post_date }}" style="padding: 6px 6px; border: 1px solid #c0c0c0;	font-size: 14px; color: #666;" readonly/>
					<!--script type="text/javascript">
						$("#post_date").datetimepicker({
							format: "yyyy-mm-dd hh:ii:ss"
						});
					</script-->
				</label>
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
                    <select name="post_status" id="post_status" style="padding: 6px 6px; border: 1px solid #c0c0c0; width: 100%; background: #fff; font-size: 14px;	color: #666; line-height: normal; outline: none;">
                       <option value="publish" <?php echo ($post_status=='publish')? "selected" : ""?>>Publish</option>
                       <option value="draft" <?php echo ($post_status=='draft')? "selected" : ""?>>Draft</option>
                       <option value="trash" <?php echo ($post_status=='trash')? "selected" : ""?>>Trash</option>
                    </select>
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="post_type" name="post_type" placeholder="Post Type*" value="nav_menu_item" readonly style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
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
			<p style="padding: 0px; margin: 0px; display: none">
				<label style="width:100%" >Content:
					<textarea id="post_content" name="post_content" class="summernote" placeholder="Post Content*" rows="5" style="height:150px;">
                        <?php echo html_entity_decode($post_content); ?>
					</textarea>
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
					<input type="hidden" id="post_modified_gmt" name="post_modified_gmt" placeholder="Post Modified GMT*" value="{{ $post_modified_gmt }}" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="post_mime_type" name="post_mime_type" placeholder="Post Mime Type*" value="{{ $post_mime_type }}" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
			<p style="padding: 0px; margin: 0px">
				<label style="width:100%" >
					<input type="hidden" id="post_excerpt" name="post_excerpt" placeholder="Post Excerpt*" value="{{ $post_excerpt }}" style="padding: 6px 6px; border: 1px solid #c0c0c0; font-size: 14px; color: #666;" />
				</label>
			</p>
		</form>
	</div>
	<div style="width:100%; height:50px; font-weight: bold " onclick="window.scrollTo( 0, 0 ); "><div style="float:right; margin: 100px; cursor: pointer; border: 1px solid #000; padding: 10px">UP</div></div>
@endsection