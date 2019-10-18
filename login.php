<!DOCTYPE html>

<html lang="en">
  <head>
      <title>PasswordToolKit - LogIn</title>
    <meta charset="utf-8">

	<!-- JS-->
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
      
<span class="input">
      <input type="text" id="inputUsername"  placeholder="Email" name="username" required autofocus>
      </span>
      
      <span class="input">
      <input type="password" id="inputPassword"  placeholder="Password" name="password" required>
      </span>
      <br>
      <br>
        <button type="button" class="button"
                onclick="signInButton()">Sign in</button>
      <br>
        
	  <a class="gradient" onclick="forgotpasswordbutton()">Forgot Password</a>
        <br>
      <br>
      <p>Not a Member?</p>
        <a id="signup" class="gradient" onclick="registerLink()">Sign up!</a>
    </form>


<script>

  function signInButton() {
    
	var authenticationData = {
        Username : document.getElementById("inputUsername").value,
        Password : document.getElementById("inputPassword").value,
    };
	
    var authenticationDetails = new AmazonCognitoIdentity.AuthenticationDetails(authenticationData);
    
	var poolData = {
        UserPoolId : _config.cognito.userPoolId, // Your user pool id here
        ClientId : _config.cognito.clientId, // Your client id here
    };
	
    var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);
	
    var userData = {
        Username : document.getElementById("inputUsername").value,
        Pool : userPool,
    };
	
    var cognitoUser = new AmazonCognitoIdentity.CognitoUser(userData);
    
	cognitoUser.authenticateUser(authenticationDetails, {
        onSuccess: function (result) {
			var accessToken = result.getAccessToken().getJwtToken();
			console.log(accessToken);
            
            cognitoUser.getUserAttributes(function(err, result) {
				if (err) {
					console.log(err);
					return;
				}
				console.log(result);
                auth = result[0].getValue();
                var newauth = auth.replace(/-/g, "");
                //Save Unique UserID to file
                 test();
        
   function test(){    
        $.ajax({
            url: 'write.php', 
            type: "POST",
            data: ({auth: newauth}),
            success: function(data){
                console.log(data);
            }
        });     
 
   }
			});	
            
			window.location.href = "index.php";
        },

        onFailure: function(err) {
            alert(err.message || JSON.stringify(err));
        },
    });
  }
    
    function registerLink() {
        window.open("register.php")
    }
  
  function forgotpasswordbutton() {
	var poolData = {
        UserPoolId : _config.cognito.userPoolId, // Your user pool id here
        ClientId : _config.cognito.clientId, // Your client id here
    };
	
    var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);
	
    var userData = {
        Username : document.getElementById("inputUsername").value,
        Pool : userPool,
    };
	
    var cognitoUser = new AmazonCognitoIdentity.CognitoUser(userData);
		
    cognitoUser.forgotPassword({
        onSuccess: function (result) {
            console.log('call result: ' + result);
        },
        onFailure: function(err) {
            alert(err);
			console.log(err);
        },
        inputVerificationCode() {
            var verificationCode = prompt('Please input verification code ' ,'');
            var newPassword = prompt('Enter new password ' ,'');
            cognitoUser.confirmPassword(verificationCode, newPassword, this);
        }
    });
  }
  
</script>
</body>
</html>







