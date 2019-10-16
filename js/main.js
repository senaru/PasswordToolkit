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

function score(){
  if($scope.re == 1){
    document.getElementById("demo").innerHTML ="bad";
  }
};

//End Password Strength
