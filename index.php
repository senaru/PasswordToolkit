<html>
 <head>
  <title>Live Add Edit Delete Datatables Records using PHP Ajax</title>
     
     <!--Cognito Script-->
    <script src="js/amazon-cognito-identity.min.js"></script>  
	<script src="js/config.js"></script>
    
<!--CSS-->
    <link id='stylecss' type="text/css" rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    
      
<!--   fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt&display=swap" rel="stylesheet">
     
<!--JS     -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  
 </head>
    
        <body>
<!-- TAB CONTROLLERS -->
<input id="managePanel-ctrl"
       class="panel-radios" type="radio" name="tab-radios" checked>
<input id="breachPanel-ctrl"
       class="panel-radios" type="radio" name="tab-radios">
<input id="strengthPanel-ctrl"
       class="panel-radios" type="radio" name="tab-radios">
<input id="generatorPanel-ctrl"
       class="panel-radios" type="radio" name="tab-radios">
<input id="aboutPanel-ctrl"
       class="panel-radios" type="radio" name="tab-radios">
<input id="nav-ctrl"
       class="panel-radios" type="checkbox" name="nav-checkbox">

<header id="introduction">
  <h1>PasswordToolKit</h1>
  <span id="headertext">
  <h2>Hello, </h2>
      <span id="headertext">
  <h2 id="email_value"> </h2>
      </span>
  </span>
    <sub>
    <a id='logout' onclick="signOut()">LogOut</a>
        </sub>
    
</header>

<!-- TABS LIST -->
<ul id="tabs-list">
    <!-- MENU TOGGLE -->
    <label id="open-nav-label" for="nav-ctrl"></label>
    <li id="li-for-managePanel">
      <label class="panel-label"
             for="managePanel-ctrl">Manage Passwords</label>
    </li><!--INLINE-BLOCK FIX
 --><li id="li-for-breachPanel">
      <label class="panel-label"
             for="breachPanel-ctrl">Password Breach</label>
    </li><!--INLINE-BLOCK FIX
 --><li id="li-for-strengthPanel">
      <label class="panel-label"
             for="strengthPanel-ctrl">AI Password Strength</label>
    </li><!--INLINE-BLOCK FIX
 --><li id="li-for-generatorPanel">
      <label class="panel-label"
             for="generatorPanel-ctrl">Password Generator</label>
    </li><!--INLINE-BLOCK FIX
 --><li id="li-for-aboutPanel" class="last">
      <label class="panel-label"
             for="aboutPanel-ctrl">About</label>
    </li>
    <label id="close-nav-label" for="nav-ctrl">Close</label>
</ul>

<!-- THE PANELS -->
<article id="panels">
  <div class="container">
    <section id="managePanel">
      <main>
        <h1>Password Manager</h1>
          <div class="container box">
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
    </div>
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Website/App</th>
       <th>Handle</th>
       <th>Password</th>
       <th></th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
          
          
      </main>
    </section>
    
<!--     Password Leaked -->
    <section id="breachPanel">
      <main>
        
        <h1>Have You Been Hacked?</h1>
        <p>This Checks if your password has been captured in any data breaches throughout the history of the internet to determine if your password is secure</p>
        <h1>Password Check</h1>
        
        <div id="wrapper">
  <div class="form-group has-feedback">
    <input type="password" class="form-control" id="inPut" placeholder="Password">
    <i class="glyphicon glyphicon-eye-open form-control-feedback"></i>
  </div>
</div>
        
<button OnClick=runCheck()>Check</button>

  <p id="outPut"></p>
      </main>
    </section>
    
<!--AI PW STRENGTH-->
    <section id="strengthPanel">
      <main>
        <div ng-controller="Tester" class="tester">
  
  <h1 class="header">Enter Password</h1>
  <br>
          <div id="wrapper">
  <div class="form-group has-feedback">
    
    <input type="password" class="form-control" id="password" placeholder="Password"  ng-change="checkPd()" ng-model="pwd">
    <i class="glyphicon glyphicon-eye-open form-control-feedback"></i>
    
  </div>
</div>
          <button ng-click="clr()">Clear</button>
    
<!--Score -->
            <div ng-if="re.score != null">
    <h1>Score: {{re.score}}</h1>
  
  <div ng-if="re.score == 0">
    <p>Worst</p>
</div>
  
  <div ng-if="re.score == 1">
    <p>Bad</p>
</div>
  
  <div ng-if="re.score == 2">
    <p>Weak</p>
  </div>
  
    <div ng-if="re.score == 3">
    <p>Good</p>
</div>
  
  <div ng-if="re.score == 4">
    <p>Strong</p>
</div>
            </div>
    
<!--     feedback -->
  <div ng-if="re.feedback.warning.length > 0">
    <h1>Feedback </h1>
     <p>{{re.feedback.warning}}</p>
  </div>
    
<!--     suggestions -->
  <div ng-if="re.feedback.suggestions.length > 0">
    <h1>Suggestions</h1>
      <dl>
        <li ng-repeat="fb in re.feedback.suggestions">{{fb}}</li>
      </dl>
  </div>
<!--     Crack Time -->
            <div ng-if="re.time != null">
    <h1>Estimated Time to Crack</h1>
  <p>
      <span ng-if="re.time">
        100/hr: {{re.time.online_throttling_100_per_hour}}<br>
        10/sec: {{re.time.online_no_throttling_10_per_second}} <br>
        1E4/sec: {{re.time.offline_slow_hashing_1e4_per_second}} <br>
        1E10/sec: {{re.time.offline_fast_hashing_1e10_per_second}}
      </span>
    </p>
            </div>
        <h1>About</h1>
        <p>Unlike every other password strength checker, this password strength checker uses AI and gathered data to determine the real strength of your password</p>
        

          </div>
      </main>
    </section>
      
<!--Password Generator-->
    
    <section id="generatorPanel">
      <main>
        <h1>Generate Secure Password</h1>
        <div class="generator-container">

	<form action="#" id="app" class="app" autocomplete="off" accept-charset="utf-8">
		<div class="row number-characters">
			<div class="col">
				<label for="number-characters">
					Number of Characters
				</label>
			</div>

			<div class="col buttons">
				<div>
					<button id="btn-minus-one" class="btn">
						<i class="fa fa-minus"></i>
					</button>
				</div>

				<div>
					<input type="text" id="number-characters" readonly="readonly" value="5">
				</div>

				<div>
					<button id="btn-plus-one" class="btn">
						<i class="fa fa-plus"></i>
					</button>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<label for="lowercase">
					Include lowercase?
				</label>
			</div>

			<div class="col">
				<button id="btn-lowercase" class="btn disabled">
					<i class="fa fa-check"></i>
				</button>
			</div>
		</div>

		<div class="row uppercase">
			<div class="col">
				<label for="uppercase">
					Include UPPERCASE?
				</label>
			</div>

			<div class="col">
				<button id="btn-uppercase" class="btn false">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>

		<div class="row numbers">
			<div class="col">
				<label for="numbers">
					Include Numbers?
				</label>
			</div>

			<div class="col">
				<button id="btn-numbers" class="btn false">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>

		<div class="row symbols">
			<div class="col">
				<label for="symbols">
					Include Symbols?
				</label>
			</div>

			<div class="col">
				<button id="btn-symbols" class="btn false">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>

		<div class="row uppercase">
			<div class="col">
				<label for="uppercase">
					Include Emojis?
				</label>
			</div>

			<div class="col">
				<button id="btn-emojis" class="btn false">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>

		<div class="row generate">
			<div class="col">
				<button id="btn-generate" class="btn btn-generate">
					Generate
					<i class="fa fa-lock"></i>
				</button>
			</div>

			<div class="col">
				<input type="text" id="input-password" class="input-password" readonly="readonly">
			</div>
		</div>

		<div class="row alert">
			<div class="col">
				<div id="alert-copy" class="alert-copy">
					<p>
						<i class="fa fa-copy"></i>
						Copied to Clipboard
					</p>
				</div>
			</div>
		</div>

	</form>
</div>
      </main>
    </section>
    
<!--About -->
    <section id="aboutPanel">
      <main>
         <h1>About</h1>
          <p>PasswordToolkit is a collection of tools associated with helping the users Create Passwords, Manage Passwords and Determine Security of Passwords</p>
        <p>PasswordToolkit was developed as a part of an Assignment for Cloud Computing at RMIT University</p>   
        <h1>Technologies Used</h1>
        <p>AWS for Hosting and Storage</p>
        <p>AWS Cognito for Authentication</p>
        <p>PWNED API for Checking for Password breaches</p>
        <p>zxcvbn to check for Password Strength</p>
          
        <h1>Programming Languages Used</h1>
          <p>HTML</p>
          <p>CSS</p>
          <ul style="list-style-type:none;">
              JavaScript
              <li>Angular</li>
              <li>JQuery</li>
              </ul>
      </main>
    </section>
  </div>
</article>
        
<!--Js-->
            
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.3.0/zxcvbn.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/2.0.8/hideShowPassword.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
        
    

<script type="text/javascript" language="javascript" >
    var auth = null;
    
    //Cognito for Authentication
var data = { 
		UserPoolId : _config.cognito.userPoolId,
        ClientId : _config.cognito.clientId
    };
    var userPool = new AmazonCognitoIdentity.CognitoUserPool(data);
    var cognitoUser = userPool.getCurrentUser();
	
	$(document).ready(function(){
        
        if (cognitoUser == null) {
            console.log("error User not logged in")
//            alert ("Please Login");
            window.location.href = "login.php";
            
        }
    if (cognitoUser != null) {
        cognitoUser.getSession(function(err, session) {
            if (err) {
                alert(err);
                console.log(err);
                return;
            }
            console.log('session validity: ' + session.isValid());
			//Set the profile info
			cognitoUser.getUserAttributes(function(err, result) {
				if (err) {
					console.log(err);
					return;
				}
				console.log(result);
                auth = result[0].getValue();
//                var newauth = auth.replace(/-/g, "");
				document.getElementById("email_value").innerHTML = result[2].getValue();
                
                //Save Unique UserID to file
//                 test();
        
//   function test(){    
//        $.ajax({
//            url: 'write.php', 
//            type: "POST",
//            data: ({name: newauth}),
//            success: function(data){
//                console.log(data);
//            }
//        });     
// 
//   }
			});			
			
        });
    }
});
	function signOut(){
	    if (cognitoUser != null) {
          cognitoUser.signOut();
          window.location.href = "login.php";
        }
	}

 $(document).ready(function(){
     
       
  fetch_data();

  function fetch_data()
  {
      
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var first_name = $('#data1').text();
   var last_name = $('#data2').text();
   var password = $('#data3').text();
   if(first_name != '' && last_name != '' && password != '')
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{first_name:first_name, last_name:last_name, password:password},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
</script>
