<html>
	<head>
		<title>OTP login</title>
		<meta charset="utf-8">

		<!-- CDN 样式文件引入 start -->
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
		<!-- <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
		<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<!-- 样式文件引入 end -->


		<!-- main样式文件引入 start -->
		<link rel="stylesheet" href="res/cover.css">
		<!-- main样式文件引入 end -->

	</head>
	<body class="text-conter">

		<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
	      <header class="masthead mb-auto">
	        <div class="inner">
	          <h3 class="masthead-brand">OTP pwd</h3>
	          <nav class="nav nav-masthead justify-content-center">
	            <a class="nav-link active" data-class="home" href="#">Home</a>
	            <a class="nav-link reg" data-class="register" href="#">Register</a>
	            <a class="nav-link " data-class="login" href="#">Login</a>
	          </nav>
	        </div>
	      </header>

	      <!-- home cintainer start-->
	      <main role="main" class="inner cover container-active" id="home-container">
	        <h1 class="cover-heading">Try your OPTpwd.</h1>
	        <p class="lead">
	        	OTP means one time password . It is convenient,safe and simple!
	        	If the other get your pswd,they can't login in as you cause they don't have the otppswd.
	        </p>
	        <p class="lead">
	        	Ps:The qrcode don't work without the vpn
	        </p>
	        <p class="lead">
	          <a href="#" class="btn btn-lg btn-secondary register">Register Now</a>
	        </p>
	      </main>
	      <!-- home conatiner end -->



	      <!-- register container start -->
	      <main role="main" class="inner cover hide" id="register-container">
	        <form class="form-signin" action="">
		      <div class="text-center mb-4">
		        <img class="mb-4" src="http://blog.raoye.me/wp-content/themes/crazyuncle/images/avatar.png" alt="" style="border-radius: 5px" width="72" height="72">
		        <h1 class="h3 mb-3 font-weight-normal">Register by email addr </h1>
		        
		      </div>
		      <div class="form-label-group">
		        <input type="email" id="register-Email" class="form-control" placeholder="Email address" required autofocus>
		        <label for="inputEmail">username, please input a email addr</label>
		      </div>

		      <div class="form-label-group">
		      	
		        <input type="password" id="register-Password" class="form-control" placeholder="Password" required>
		        <label for="inputPassword">Password, scan the qrcode by google authnication</label>
		      </div>

		      <div class="form-label-group qrcode-img">
		      	<img id="qrcode" alt="it can't work without vpn" src=""  width="200" height="200" >
		      </div>

		      <button class="btn btn-lg btn-primary btn-block register-btn"  type="submit">Register</button>
		      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
		    </form>
	      </main>
	      <!-- register container end -->



	      <!-- login container start -->
	      <main role="main" class="inner cover hide" id="login-container">
	       <form class="form-signin" action="">
		      <div class="text-center mb-4">
		        <img class="mb-4" src="http://blog.raoye.me/wp-content/themes/crazyuncle/images/avatar.png" alt="" style="border-radius: 5px" width="72" height="72">
		        <h1 class="h3 mb-3 font-weight-normal">Login by email addr </h1>
		        
		      </div>
		      <div class="form-label-group">
		        <input type="email" id="login-Email" class="form-control" placeholder="Email address" required autofocus>
		        <label for="inputEmail">username, please input a email addr</label>
		      </div>

		      <div class="form-label-group">
		      	
		        <input type="password" id="login-Password" class="form-control" placeholder="Password" required>
		        <label for="inputPassword">Password, check google authenticator</label>
		      </div>

		      <button class="btn btn-lg btn-primary btn-block login-btn"  type="submit">Login in</button>
		      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
		    </form>
	      </main>
	      <!-- login container end -->



	      <footer class="mastfoot mt-auto">
	        <div class="inner">
	          <p>OTP template for <a href="https://getbootstrap.com/">anyone</a>, by <a target="_blank" href="https://github.com/RiedSpencer">@spencer</a>.</p>
	        </div>
	      </footer>
	    </div>

	</body>
</html>

<script>
	$(".nav-link").click(function(){
		$(".nav").find(".nav-link").removeClass("active");
		$(this).addClass("active");
		$("#"+$(this).data("class")+"-container").removeClass("hide");
		$(".container-active").hide();
		$(".container-active").removeClass("container-active");
		$("#"+$(this).data("class")+"-container").fadeIn();
		$("#"+$(this).data("class")+"-container").addClass("container-active");



		//当注册的时候生成二维码图片
		if($(this).data("class")=="register"){
			$.get("server.php?type=getqr",function(res){
				// 替换二维码的图片
				$("#qrcode").attr("src",res);
			});
		}

	});

	$(".register").click(function(){
		$(".nav").find(".nav-link").removeClass("active");
		$(".reg").addClass("active");
		$(".container-active").hide();
		$(".container-active").removeClass("container-active");
		$("#register-container").fadeIn();
		$("#register-container").addClass("container-active");
		$.get("server.php?type=getqr",function(res){
				// 替换二维码的图片
				$("#qrcode").attr("src",res);
		});
	});


	$(".register-btn").click(function(){
			$.get("server.php?type=register&uname="+$("#register-Email").val()+"&pswd="+$("#register-Password").val(),function(res){
				alert(res);
			});
	});

	$(".login-btn").click(function(){
			$.get("server.php?type=login&uname="+$("#login-Email").val()+"&pswd="+$("#login-Password").val(),function(res){
				alert(res);
			});
	});
</script>
