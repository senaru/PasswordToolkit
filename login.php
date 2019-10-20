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
    <link id='stylecss' type="text/css" rel="stylesheet" href="css/loginregister.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />

</head>

<body>
    <form id="the-form">
        <h1 class="header">PasswordToolKit
      <h2 class="fab fa-keycdn header"></h2></h1>
        <br>
        <h1>Login</h1>
        <span class="input">
      <input type="email" id="inputUsername"  placeholder="Email" name="username" required autofocus>
      </span>

        <span class="input">
      <input type="password" id="inputPassword"  placeholder="Password" name="password" required>
      </span>
        <br>
        <br>
        <h3><red id="return"></red></h3>
        <button id="btn" type="button" class="button" onclick="reportValidity()">Sign in</button>
        <br>

        <a class="gradient" onclick="forgotpasswordbutton()">Forgot Password</a>
        <br>
        <br>
        <p>Not a Member?</p>
        <a id="signup" class="gradient" onclick="registerLink()">Sign up!</a>
    </form>

    <script>
        //Form Validation
        $("#btn").on("click", function() {
            if ($("#the-form")[0].checkValidity()) {
                signInButton();
            } else {
                $("#the-form")[0].reportValidity();
            }
        });

        function signInButton() {

            var authenticationData = {
                Username: document.getElementById("inputUsername").value,
                Password: document.getElementById("inputPassword").value,
            };

            var authenticationDetails = new AmazonCognitoIdentity.AuthenticationDetails(authenticationData);

            var poolData = {
                UserPoolId: _config.cognito.userPoolId,
                ClientId: _config.cognito.clientId,
            };

            var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);

            var userData = {
                Username: document.getElementById("inputUsername").value,
                Pool: userPool,
            };

            var cognitoUser = new AmazonCognitoIdentity.CognitoUser(userData);

            cognitoUser.authenticateUser(authenticationDetails, {
                onSuccess: function(result) {
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

                        function test() {
                            $.ajax({
                                url: 'write.php',
                                type: "POST",
                                data: ({
                                    auth: newauth
                                }),
                                success: function(data) {
                                    console.log(data);
                                }
                            });

                        }
                    });

                    window.location.href = "index.php";
                },

                onFailure: function(err) {
                    document.getElementById("return").innerHTML = err.message || JSON.stringify(err);
                },
            });
        }

        function registerLink() {
            window.open("register.php")
        }

        function forgotpasswordbutton() {
            var poolData = {
                UserPoolId: _config.cognito.userPoolId,
                ClientId: _config.cognito.clientId,
            };

            var userPool = new AmazonCognitoIdentity.CognitoUserPool(poolData);

            var userData = {
                Username: document.getElementById("inputUsername").value,
                Pool: userPool,
            };

            var cognitoUser = new AmazonCognitoIdentity.CognitoUser(userData);

            cognitoUser.forgotPassword({
                onSuccess: function(result) {
                    console.log('call result: ' + result);
                },
                onFailure: function(err) {
                    document.getElementById("return").innerHTML = err.message || JSON.stringify(err);
                    if ((err.message || JSON.stringify(err)) == "Username/client id combination not found.") {
                        document.getElementById("return").innerHTML = "User does not Exist!"
                    } else {
                        document.getElementById("return").innerHTML = "Please Enter Email"
                    }
                    console.log(err);
                },
                inputVerificationCode() {
                    var verificationCode = prompt('Please input verification code ', '');
                    var newPassword = prompt('Enter new password ', '');
                    cognitoUser.confirmPassword(verificationCode, newPassword, this);
                }
            });
        }
        
        //"aws/amazon-cognito-auth-js", GitHub, 2019. [Online]. Available: https://github.com/aws/amazon-cognito-auth-js. [Accessed: 20- Oct- 2019].
        
    </script>
</body>

</html>