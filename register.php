<!DOCTYPE html>

<html lang="en">
  <head>
      <title>PasswordToolKit - Register</title>
    <meta charset="utf-8">
	<!-- Js-->
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> 
  <script src="js/amazon-cognito-auth.min.js"></script>
  <script src="https://sdk.amazonaws.com/js/aws-sdk-2.7.16.min.js"></script> 
  <script src="js/amazon-cognito-identity.min.js"></script>  
  <script src="js/config.js"></script>
      
      <!--css -->
     <link id='stylecss' type="text/css" rel="stylesheet" href="css/loginregister.css"/>
     <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css" />
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"/>
      
  </head>

	
  <body>
      <form id="the-form">
      <h1 class="header">PasswordToolKit</h1>
      <h2 class="fab fa-keycdn header"></h2>
      <br>

    <h1 id="header">Register an Account</h1>
          <h2 ><green id="return"></green></h2>
	<span class="input">
	<input type="personalname" class="form-control" id="personalnameRegister" placeholder="Name" pattern=".*" required>
        </span>
        <span class="input">
    <input type="email" class="form-control" id="emailInputRegister" placeholder="Email" pattern=".*" required>
            </span>
          
            <span class="input">
	<input type="password" class="form-control" id="passwordInputRegister" placeholder="Password" pattern=".*" required>
                </span>
          
                <span class="input">
    <input type="password" class="form-control" id="confirmationpassword" placeholder="Confirm Password" pattern=".*" required>
                </span>
	<button id="reg" class="button" type="button" onclick="reportValidity()" >Register</button>
          
          <p>Already a User?</p>
        <a id="login" class="gradient" onclick="loginLink()">LogIn</a>

      </form>
      
	<script>
        //Form Validation
    $("#reg").on("click", function(){
    if($("#the-form")[0].checkValidity()) {
        registerButton();
    }
    else {
        $("#the-form")[0].reportValidity();
    }
});


		var username;
		var password;
		var personalname;
		var poolData;
        
        function loginLink() {
        window.open("file:register.html")
    }
			
	  function registerButton() {
		
		personalnamename =  document.getElementById("personalnameRegister").value;	
		username = document.getElementById("emailInputRegister").value;
		
		if (document.getElementById("passwordInputRegister").value != document.getElementById("confirmationpassword").value) {
			alert("Passwords Do Not Match!")
            
			throw "Passwords Do Not Match!"
		} else {
			password =  document.getElementById("passwordInputRegister").value;	
		}
		
		poolData = {
				UserPoolId : _config.cognito.userPoolId,
				ClientId : _config.cognito.clientId
			};		
		var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);

		var attributeList = [];
		
		var dataEmail = {
			Name : 'email', 
			Value : username,
		};
		
		var dataPersonalName = {
			Name : 'name', 
			Value : personalname,
		};

		var attributeEmail = new AmazonCognitoIdentity.CognitoUserAttribute(dataEmail);
		var attributePersonalName = new AmazonCognitoIdentity.CognitoUserAttribute(dataPersonalName);
		
		
		attributeList.push(attributeEmail);
		attributeList.push(attributePersonalName);

		userPool.signUp(username, password, attributeList, null, function(err, result){
			if (err) {
				alert(err.message || JSON.stringify(err));
				return;
			}
			cognitoUser = result.user;
			console.log('user name is ' + cognitoUser.getUsername());
			//change elements of page
			document.getElementById("return").innerHTML = "Check your email for a verification link";
            setTimeout("location.href = 'login.php';",3000);
			//window.location.href = "login.php";
		});
	  }

	</script>
 
 </body>
  
</html>








