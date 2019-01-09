<script type="text/javascript">
{{ $mdl_name }}={!! $$mdl_name !!};

function {{ $mdl_prefix }}_new() {
	e = document.getElementById('{{ $mdl_prefix }}_line');
	e.readOnly = false;
	e.value="-1";
	e = document.getElementById('{{ $mdl_prefix }}_text');
	e.value="";
	e = document.getElementById('{{ $mdl_prefix }}_icon');
	e.value="";
	e = document.getElementById('{{ $mdl_prefix }}_link');
	e.value="";
}
function {{ $mdl_prefix }}_read(r) {
	if (r<{{ $mdl_name }}.length) {
    	e = document.getElementById('{{ $mdl_prefix }}_line');
    	e.readOnly = true;
    	e.value = r;
    	e = document.getElementById('{{ $mdl_prefix }}_text');
    	e.value = {{ $mdl_name }}[r].text;
    	e = document.getElementById('{{ $mdl_prefix }}_icon');
    	e.value = {{ $mdl_name }}[r].icon;
    	e = document.getElementById('{{ $mdl_prefix }}_link');
    	e.value = {{ $mdl_name }}[r].link;
	}
}
function {{ $mdl_prefix }}_get() {
	e = document.getElementById('{{ $mdl_prefix }}_line');
	e.readOnly = true;
	r = e.value*1;
	e = document.getElementById('{{ $mdl_prefix }}_text');
	e.value = {{ $mdl_name }}[r].text;
	e = document.getElementById('{{ $mdl_prefix }}_icon');
	e.value = {{ $mdl_name }}[r].icon;
	e = document.getElementById('{{ $mdl_prefix }}_link');
	e.value = {{ $mdl_name }}[r].link;
}
function {{ $mdl_prefix }}_put() {
	e = document.getElementById('{{ $mdl_prefix }}_line');
	r = e.value*1;
	if (r>0 && r<{{ $mdl_name }}.length) {
    	e = document.getElementById('{{ $mdl_prefix }}_text');
    	{{ $mdl_name }}[r].text = e.value;
    	e = document.getElementById('{{ $mdl_prefix }}_icon');
    	{{ $mdl_name }}[r].icon = e.value;
    	e = document.getElementById('{{ $mdl_prefix }}_link');
    	{{ $mdl_name }}[r].link = e.value;
	}
	else {
		{{ $mdl_prefix }}_ar = new Object();
    	e = document.getElementById('{{ $mdl_prefix }}_text');
    	{{ $mdl_prefix }}_ar.text = e.value;
    	e = document.getElementById('{{ $mdl_prefix }}_icon');
    	{{ $mdl_prefix }}_ar.icon = e.value;
    	e = document.getElementById('{{ $mdl_prefix }}_link');
    	{{ $mdl_prefix }}_ar.link = e.value;
    	{{ $mdl_name }}.push({{ $mdl_prefix }}_ar);
	}
	
	e = document.getElementById('{{ $mdl_prefix }}_line');
	e.readOnly = false;
	e.value="-1";
	e = document.getElementById('{{ $mdl_prefix }}_text');
	e.value="";
	e = document.getElementById('{{ $mdl_prefix }}_icon');
	e.value="";
	e = document.getElementById('{{ $mdl_prefix }}_link');
	e.value="";

	{{ $mdl_prefix }}_b=document.getElementById('{{ $mdl_prefix }}_body');
	{{ $mdl_prefix }}_b.innerHTML = {{ $mdl_prefix }}_render();
}
function {{ $mdl_prefix }}_render() {
	html = "";
	html += "<tr>";
	html += "	<th>{{ $name }} Line</th>";
	html += "	<th>{{ $name }} Text</th>";
	html += "	<th>{{ $name }} Link</th>";
	html += "	<th>{{ $name }} Icon</th>";
	html += "</tr>";
    for(i=0;i<{{ $mdl_name }}.length;i++) {
    	html += "<tr onclick=\"{{ $mdl_prefix }}_read("+i+")\">";
    	html += "    <td>"+i+"</td>";
		html += "    <td>"+{{ $mdl_name }}[i].text+"</td>"
    	html += "    <td>"+{{ $mdl_name }}[i].link+"</td>"
		html += "    <td>"+{{ $mdl_name }}[i].icon+"</td>"
    	html += "</tr>"
    }
    return html;
}
function {{ $mdl_prefix }}_del() {
	e = document.getElementById('{{ $mdl_prefix }}_line');
	e.readOnly = false;
	r = e.value*1;
	e.value="-1";
	e = document.getElementById('{{ $mdl_prefix }}_text');
	e.value="";
	e = document.getElementById('{{ $mdl_prefix }}_icon');
	e.value="";
	e = document.getElementById('{{ $mdl_prefix }}_link');
	e.value="";

	{{ $mdl_name }}.splice(r, 1);
	
	{{ $mdl_prefix }}_b=document.getElementById('{{ $mdl_prefix }}_body');
	{{ $mdl_prefix }}_b.innerHTML = {{ $mdl_prefix }}_render();
}
</script>
            <table style="font-size: 16px;">
                <tbody id="{{ $mdl_prefix }}_body">
                    <tr>
                        <!--th>{{ $name }} Line</th-->
                        <th>{{ $name }} Text</th>
                        <th>{{ $name }} Link</th>
                        <th>{{ $name }} Icon</th>
                    </tr>
					<?php for($i=0;$i<count($option_array[$mdl_name]);$i++) { // 'mdl__socials'; 'mdl__contacts' : text / link / icon ?>
                    <tr onclick="{{ $mdl_prefix }}_read({{ $i }})">
                        <!--td>{{ $i }}</td-->
                        <td style="text-align: left">{{ $option_array[$mdl_name][$i]['text'] }}</td>
                        <td style="text-align: left">{{ $option_array[$mdl_name][$i]['link'] }}</td>
                        <td style="text-align: left">{{ $option_array[$mdl_name][$i]['icon'] }}</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
			<p>
				<label style="width:100%" >
					<input type="hidden" id="{{ $mdl_prefix }}_line" name="{{ $mdl_prefix }}_line" placeholder="line*" value="" />
				</label>
			</p>
			<p>
				<label style="width:100%" >
					<input type="text" id="{{ $mdl_prefix }}_text" name="{{ $mdl_prefix }}_text" placeholder="text*" value="" /> 
				</label>
			</p>
			<p>
				<label style="width:100%" >
					<input type="text" id="{{ $mdl_prefix }}_link" name="{{ $mdl_prefix }}_link" placeholder="link*" value="" /> 
				</label>
			</p>
			<p>
				<label style="width:100%" >
					<input type="text" id="{{ $mdl_prefix }}_icon" name="{{ $mdl_prefix }}_icon" placeholder="icon*" value="" /> 
				</label>
			</p>
			<p>
				<label><br />
    				<input type="button" value="New" style="margin-right:15px" onclick="{{ $mdl_prefix }}_new()" />
				</label>
				<label><br />
    				<input type="button" value="Get" style="margin-right:15px" onclick="{{ $mdl_prefix }}_get()" />
				</label>
				<label><br />
    				<input type="button" value="Put" style="margin-right:15px" onclick="{{ $mdl_prefix }}_put()" />
				</label>
				<label><br />
    				<input type="button" value="Del" style="" onclick="{{ $mdl_prefix }}_del()" />
				</label>
			</p>

