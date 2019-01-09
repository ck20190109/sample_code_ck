@extends('layouts.app')

@section('content')
	<script type="text/javascript">
        function goto_wwc() {
            window.open('{{ config('app.url') }}'+'{{ session('CURRENT') }}', "TEST - 2017 WWC");
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
		id = document.getElementById('option_id');
		fm = document.getElementById('fm_option');
		fm.action = '<?php echo url('/'); ?>/option-read/'+id.value;
		fm.submit();
	}
	function read(id) {
		fm = document.getElementById('fm_option');
		fm.action = '<?php echo url('/'); ?>/option-read/'+id;
		fm.submit();
	}
	var mdl__socials = null;
	var mdl__contacts = null;
	function save() {
		fm = document.getElementById('fm_option');
		if (mdl__socials!=null && mdl__contacts!=null) {
			opt_val = document.getElementById('mdl__socials');
			opt_val.value = JSON.stringify(mdl__socials);
			opt_val = document.getElementById('mdl__contacts');
			opt_val.value = JSON.stringify(mdl__contacts);
		}
		else {
			opt_nam = document.getElementById('option_name');
			opt_val = document.getElementById('option_value');
			if (opt_nam.value=="" || opt_val.value=="") {
				alert('Required fields have not filled.');
				return;
			}
		}
		fm.action = '<?php echo url('/'); ?>/option-save';
		fm.submit();
	}
	function dele(id) {
		y_n = confirm('Are you sure to delete the current record ?');
		if (!y_n) return;
		fm = document.getElementById('fm_option');
		fm.action = '<?php echo url('/'); ?>/option-delete/'+id;
		fm.submit();
	}
	</script>

    <div class="container">
		<h2 style="padding:10px">Team Informations Editor</h2>
        <table style="font-size: 16px;">
            <tbody>
                <tr>
                    <!--th>Option Id</th-->
                    <th>Option Name</th>
                    <th>Option Value</th>
                </tr>
                <?php foreach ($options as $option) { ?>
                <tr onclick="read({{ $option->option_id }})">
                    <!--td>{{ $option->option_id }}</td-->
                    <td style="text-align: left">{{ $option->option_name }}</td>
                    <td style="text-align: left">{{ substr($option->option_value,0,128) }}</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    	{{ $options->links() }}

		<form id="fm_option" method="post">
			<div style="display: none;">
				<input type="hidden" name="page" value="{{ $page }}" />
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" id="mdl__socials" name="mdl__socials" value="">
				<input type="hidden" id="mdl__contacts" name="mdl__contacts" value="">
			</div>
			<p>
				<label style="width:100%" ><br />
					<input type="hidden" id="option_id" name="option_id" placeholder="Option Id" value="{{ $option_id }}" readonly />
				</label>
			</p>
			<p>
				<label style="width:100%" >Name:
					<input type="text" id="option_name" name="option_name" placeholder="Option Name*" value="{{ $option_name }}" readonly/>
				</label>
			</p>

			<?php if($table_form_socials=="" && $table_form_contacts=="") { ?>
			<p>
				<label style="width:100%" >Values:
					<textarea id="option_value" name="option_value" placeholder="Option Value*" rows="5">{{ $option_value }}</textarea>
				</label>
			</p>
			<?php }
				else { ?>
					<div style="width:100%" align="center">
						<div style="width:100%">
							<h4>Socials:</h4>
							<?php echo html_entity_decode($table_form_socials); ?>
							<h4>Contacts:</h4>
							<?php echo html_entity_decode($table_form_contacts); ?>
						</div>
					</div>
			<?php } ?>

			<p>
				<!--label><br />
    				<input type="button" value="Load" style="margin-right:15px" onclick="load()" />
				</label-->
				<label><br />
					<input type="button" value="Save" style="margin-right:15px" onclick="save()" />
				</label>
				<!--label><br />
    				<input type="button" value="Delete" style="margin-right:15px" onclick="dele({{ $option_id }})" />
				</label-->
				<label><br />
    				<input type="reset" value="Reset" style="">
				</label>
			</p>
		</form>
	</div>
@endsection