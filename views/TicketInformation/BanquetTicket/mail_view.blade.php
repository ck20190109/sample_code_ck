
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<style>
.sucess-box {
	width: 70%;
	height: 50%;
	margin: auto;
	margin-top: 15%;
	border: 1px solid black;
}

.sucess-smallbox {
	width: 50%;
	height: 50%;
	margin: auto;
	border: 0px solid black;
}

img.sucess {
margin:auto;
	margin-top: 5%;
	margin-bottom: 3%;
	padding-left: 41%;
	width: 100px;
	height: 100px;
}
img.sucess2 {
margin:auto;
	margin-top: 5%;
	margin-bottom: 3%;
	padding-left: 40%;
	width: 100px;
	height: 100px;
}

button.sucess {
margin-top:2%;
	margin-bottom: 5%;
	margin-left: 38%;
}

.sucess-smallbox2 {
	width: 200px;
	height: 100px;
	margin: auto;
	padding-bottom: 30px;
	border: 0px solid black;
}

.sucess {
	margin:auto;
}

.sucess h1 {
	text-align: center;
	color: #000000;
}

.sucess p {
	text-align: center;
	color: #000000;
	font-size: 27px;
}
</style>
</head>
<body>
	<div class="sucess">
		<div class="sucess-box">
			<div class="sucess-smallbox">
				<img class="sucess"
					src="resources/images/home-content/checkMark.png">

				<h1>Thank You!</h1>
				<p>Your submission had been sucessfully completed</p>

				<img class="sucess2" src="resources/images/home-content/logo.png"> <br>

				<button class="sucess" type="button" id="goto" onclick="window.location='{{ 'http://'.$_SERVER['HTTP_HOST'].'/' }}'">View Our Website</button>
			</div>
		</div>
	</div>
</body>
</html>