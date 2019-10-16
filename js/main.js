//Start Password field

// toggle password visibility
$('#password + .glyphicon').on('click', function() {
  $(this).toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open'); // toggle our classes for the eye icon
  $('#password').togglePassword(); // activate the hideShowPassword plugin
});

$('#inPut + .glyphicon').on('click', function() {
  $(this).toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open');
  $('#inPut').togglePassword();
});

//End Password Field

// Start Password Strength
angular.module('app', [])
  .controller('Tester', ($scope) => {
    $scope.checkPd = () =>  {
      $scope.result = zxcvbn($scope.pwd);
      $scope.re = {
        time: $scope.result.crack_times_display,
        score: $scope.result.score,
        sequence: $scope.result.sequence,
        feedback: $scope.result.feedback
      };
    }
    $scope.clr = () => {
      $scope.result = '';
      $scope.re = null;
      $scope.pwd = '';
    }
  });
angular.bootstrap(document, ['app']);

//End Password Strength

//Start Password check
let first = "";
let last = "";
let hash = "";

function hexString(buffer) {
  const byteArray = new Uint8Array(buffer);

  const hexCodes = [...byteArray].map(value => {
    const hexCode = value.toString(16);
    const paddedHexCode = hexCode.padStart(2, '0');
    return paddedHexCode.toUpperCase();
  });

  return hexCodes.join('');
}

function digestMessage(message) {
  const encoder = new TextEncoder();
  const data = encoder.encode(message);
  return window.crypto.subtle.digest('SHA-1', data);
}

function runCheck() {
let outPut = document.getElementById("outPut");
let inPut = document.getElementById("inPut");
let text = inPut.value;
if (text === "") return false;

  
digestMessage(text).then(digestValue => {
  hash = hexString(digestValue);
  document.getElementById("outPut")
          .innerText = hash;
  first = hash.substring(0, 5);
  last = hash.substring(5);
  fetch('https://api.pwnedpasswords.com/range/' + first)
  .then(
    function(response) {
      if (response.status !== 200) {
        console.log('Looks like there was a problem. Status Code: ' +
          response.status);
        return;
      }
    return response.text();
  })
  .then(function(text) {
    return text.split("\r\n");  
  })
  .then(function(arr){
   
     document.getElementById("outPut")
          .innerHTML = "<safe>Safe</safe><br>" +  
          "SHA1 Hash : " + hash + 
          "<br>Was not captured in any breaches!";
   
     arr.forEach((s)=>{
      
       let a = s.split(":");
       
       if(a[0] == last) {
        
        document.getElementById("outPut")
           .innerHTML = "<comp>Compromised!</comp><br>" +
           "<br>SHA1 Hash : " + hash + 
           "<br>Was found <red>" + a[1] + "</red> times!";
           
        return true;
        
       }
      
     });
     
  })
  .catch(function(error) {
    log('Request failed', error)
  });

});
  
outPut.value = "";
  
}

//End Password Check

//Start Password Generate

//End Password Generator