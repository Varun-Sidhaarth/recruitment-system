<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <script src="https://kit.fontawesome.com/172c5b79cc.js" crossorigin="anonymous"></script>
  <title>Admin | Recruitment Management System</title>
 	

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
		
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	
	
	#login-left{
		position: absolute;
		left:0;
		width:100%;
		height: calc(100%);
		background:transparent;
		display: flex;
		align-items: center;
		background-image: linear-gradient(rgba(255,255,255,0.5),rgba(255,255,255,0.6)),url("assets/img/459-background.png");
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	.login-box{
    width: 100%;
    max-width: 550px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background: #fff;
    padding: 50px 60px ;
    text-align: center;
    border-radius: 15px;
    background: transparent;
     
}
.card {
	background-color:transparent;
	border:transparent;
}

.login-box h1{
    font-size:30px;
    margin-bottom: 40px;
	margin-top:20px;
    color: #3c00a0;
    position: relative;
}

.login-box h1::after{

    content: '';
    height: 4px;
    width: 30px;
    border-radius: 3px;
    background: #3c00a0;
    position: absolute;
    bottom:-12px;
    left: 50%;
    transform: translateX(-50%);
}
.btn-sm{
	background: #3c00a0;
	border-color:#3c00a0;
} 


.textbox{
    background: #eaeaea;
    margin: 15px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    max-height: 65px;
    transition: max-height 0.5s;

}

.textbox input{
    width: 100%;
    background: transparent;
    border: 0;
    outline: 0;
    padding: 18px 15px;
}

.textbox i{
    margin-left: 15px;
    color: #999;

}
.remember-forgot {
    display: flex;
    justify-content: space-between;
    margin: 20px 0;
}

.remember-forgot label {
    font-size: 14px;
    color: #4a148c;
    margin-left: 10px;
}

.remember-forgot a {
    color: #4a148c;
    text-decoration: none;
}
form p{
    text-align: left;
    font-size: 13px;
}

form p a{
    text-decoration: none;
    color: #3c00a0;
}



.btn-field{
    width: 100%;
    display: flex;
    justify-content: center;
   
}

.btn-field button{
    flex-basis: 48%;
    background: #3c00a0;
    color: #fff;
    height: 40px;
    border-radius: 20px;
    border: 0;
    outline: 0;
    cursor: pointer;
    transition: background 1s;
  
}

.signup p{
    font-size: 14.5px;
    text-align: center;
    margin-top: 20px;
}

.signup a {
    color:#3c00a0;
    
    font-weight: 600;
}

.signup a:hover{
    text-decoration: underline;
}
	
	
	



</style>

<body>


  <main id="main" class=" bg-dark">

  		<div id="login-left">
  			
  			<div class="login-box">

			
				<div class="card col-md-12">
				<h1>Login</h1>
					<div class="card-body">
							
						<form id="login-form" >
							<div class="textbox">
								<i class="fa-solid fa-user"></i>
								<label for="username" class="control-label"></label>
								<input type="text" id="username" name="username" placeholder="Enter your Username or Email" class="form-control">
							</div>
							<div class="textbox">
								<i class="fa-solid fa-key"></i>
								<label for="password" class="control-label"></label>
								<input type="password" id="password" name="password" placeholder="Enter your Password" class="form-control">
							</div>
								<div class="remember-forgot">
								<label><input type="checkbox">Remember me</label>
								<a href="reset_request.html">Forgot password?</a>
							
							</div>
							
							<div class="signup">
								<p>Don't have an Account? <a href="signup.html">Sign up</a></p>
							</div>
							<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
						</form>
					</div>
				</div>
			</div>
		</div>

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>