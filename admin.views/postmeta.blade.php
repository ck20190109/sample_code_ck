@extends('layouts.app')

@section('content')
	<script type="text/javascript">
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
                        window.open('{{ config('app.url') }}' + p + ele.value,"TEST - 2017 WWC");
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
	function load() {
		id = document.getElementById('meta_id');
		fm = document.getElementById('fm_postmeta');
		fm.action = '<?php echo url('/'); ?>/postmeta-read/'+id.value;
		fm.submit();
	}
	function read(id) {
		fm = document.getElementById('fm_postmeta');
		fm.action = '<?php echo url('/'); ?>/postmeta-read/'+id;
		fm.submit();
	}
	function save() {
		e1 = document.getElementById('post_id');
		e2 = document.getElementById('meta_key');
		e3 = document.getElementById('meta_value');
		if (e1.value=="" || e2.value=="" || e3.value=="") {
			alert('Required Fields have not been filled.');
			return;
		}

		fm = document.getElementById('fm_postmeta');
		fm.action = '<?php echo url('/'); ?>/postmeta-save';
		fm.submit();
	}
	function dele(id) {
		y_n = confirm('Are you sure to delete the current record ?');
		if (!y_n) return;
		fm = document.getElementById('fm_postmeta');
		fm.action = '<?php echo url('/'); ?>/postmeta-delete/'+id;
		fm.submit();
	}
	</script>

    <div class="container">
		<h2 style="padding:10px">S.E.O. Editor</h2>
        <table style="font-size: 16px;">
            <tbody>
                <tr>
                    <!--th>Meta Id</th-->
                    <!--th>Post Id</th-->
                    <th>Post Title</th>
                    <th>Meta Key</th>
                    <th>Meta Value</th>
                </tr>
                <?php foreach ($postmetas as $postmeta) { ?>
                <tr onclick="read({{ $postmeta->meta_id }})">
                    <!--td>{{ $postmeta->meta_id }}</td-->
                    <!--td>{{ $postmeta->post_id }}</td-->
                    <td>{{ $postmeta->post_title }}</td>
                    <td>{{ $postmeta->meta_key }}</td>
                    <td style="text-align: left">{{ substr($postmeta->meta_value,0,128) }}</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    	{{ $postmetas->links() }}

		<form id="fm_postmeta" method="post">
			<div style="display: none;">
				<input type="hidden" name="page" value="{{ $page }}" />
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</div>
			<p>
				<label style="width:100%" >Title:
					<?php if ($post_title) { ?>
					<input type="text" id="post_title" name="post_title" placeholder="Post Title" value="{{ $post_title->post_title }}" readonly />
					<input type="hidden" id="post_id" name="post_id" placeholder="Post Id" value="{{ $post_id }}" />
					<input type="hidden" id="post_name" name="post_name" placeholder="Post Name" value="{{ $post_title->post_name }}" />
					<?php }
					else { ?>
                    <select name="post_id" id="post_id" placeholder="Post Title">
                    <?php for($i=0;$i<count($avail_posts);$i++) { ?>
                       <option value="{{ $avail_posts[$i]->ID }}" <?php echo ($post_id==$avail_posts[$i]->ID)? "selected" : ""?>>{{ $avail_posts[$i]->post_title }}</option>
                    <?php }
					} ?>
                    </select>
				</label>
			</p>
			<p>
				<label style="width:100%" >Key:
                    <select id="meta_key" name="meta_key">
                       <option value="<?php echo $lang; ?>_aioseop_title" <?php echo ($meta_key==$lang.'_aioseop_title')? "selected" : ""?>>Page Title</option>
                       <option value="<?php echo $lang; ?>_aioseop_description" <?php echo ($meta_key==$lang.'_aioseop_description')? "selected" : ""?>>Page Description</option>
                       <option value="<?php echo $lang; ?>_aioseop_keywords" <?php echo ($meta_key==$lang.'_aioseop_keywords')? "selected" : ""?>>Page Keywords</option>
                    </select>
				</label>
			</p>
			<p>
				<label style="width:100%" >Value:
					<textarea id="meta_value" name="meta_value" placeholder="Meta Value*" rows=2>{{ $meta_value }}</textarea>
				</label>
			</p>
			<p>
				<!--label><br />
					<input type="button" value="Load" style="margin-right:15px" onclick="load()" />
				</label-->
				<label><br />
    				<input type="button" value="Save" style="margin-right:15px" onclick="save()" />
				</label>
				<label><br />
    				<input type="button" value="Delete" style="margin-right:15px" onclick="dele({{ $meta_id }})" />
				</label>
				<label><br />
    				<input type="reset" value="Reset" style="">
				</label>
			</p>
			<p>
				<label style="width:100%" ><br />
					<input type="hidden" id="meta_id" name="meta_id" placeholder="Meta Id" value="{{ $meta_id }}" <?php echo $meta_id? "readonly":""; ?> />
				</label>
			</p>
		</form>
	</div>
@endsection