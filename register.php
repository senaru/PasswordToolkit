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
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"/>
     <link id='stylecss' type="text/css" rel="stylesheet" href="css/loginregister.css"/>
     <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css" />
      
  </head>

	
  <body>
      <form>
      <h1 class="header">PasswordToolKit</h1>
      <h2 class="fab fa-keycdn"></h2>
      <br>

    <h1 class="h3 mb-3 font-weight-normal" id="titleheader">Register an Account</h1>
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
	<button id="reg" class="button" type="button" onclick="registerButton()" >Register</button>
          
          <p>Already a User?</p>
        <a id="login" class="gradient" onclick="loginLink()">LogIn</a>

      </form>
	<script>

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
				UserPoolId : _config.cognito.userPoolId, // Your user pool id here
				ClientId : _config.cognito.clientId // Your client id here
			};		
		var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);

		var attributeList = [];
		
		var dataEmail = {
			Name : 'email', 
			Value : username, //get from form field
		};
		
		var dataPersonalName = {
			Name : 'name', 
			Value : personalname, //get from form field
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
			document.getElementById("titleheader").innerHTML = "Check your email for a verification link";
			window.location.href = "login.php";
		});
	  }

	</script>
 
 </body>
  
</html>







