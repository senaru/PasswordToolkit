
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
angular.module('tester', [])
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
angular.bootstrap(document, ['tester']);

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
(function() {

  let form = document.getElementById('app');
  let inputcharacters = document.getElementById('number-characters');
  let btns = document.getElementsByClassName('btn');
  
  let configuration = {
    characters: parseInt(inputcharacters.value),
    lowercase: true,
    uppercase: false,
    numbers: false,
    symbols: false,
    emojis: false
  };
  
  let characters = {
    lowercase: 'a b c d e f g h i j k l m n o p q r s t v w y z',
    uppercase: 'A B C D E F G H I J K L M N O P Q R S T V W Y Z',
    numbers: '0 1 2 3 4 5 6 7 8 9',
    symbols: '! @ & # $ % & ^ > < _ - + * = ( ) { } [ ] ; : , . ¿ ? / |',
    emojis: '😀 😄 😁 😅 🤣 😇 🙂 🙃 😉 😌 😍 😘 😗 😚 😛 😝 😜 😏 😒 😞 😔 😕 😫 😩 😢 😭 😤' +
            '😠 😡 😳 😱 😨 😰 😥 😓 🤗 🤔 😶 😑 🙄 😧 😵 👿 👹 👺 👻 ☠ 👽 🎃 👐 👏 🤝 👍 👎' +
            '👊 ✊ 🤘 👈 👉 ☝ ✋ 🤚 🖐 🖖 👋 🤙 ✍ 🙏 💍 💄 💋 👄 👅 👂 👃 👣 👁 👀 👤 👥 👶 👧 👩' +
            '👵 👚 👕 👖 👔 👘 👢 🎩 👒 🎓 ⛑ 👑 👝 👛 👜 💼 🎒 👓 🕶 🌂 🐶 🐱 🐭 🐹 🐰 🦊 🐻' +
            '🐼 🐨 🐯 🦁 🐮 🐷 🐽 🐸 🐵 🙈 🙉 🐒 🐔 🐧 🐦 🐤 🐣 🐥 🦆 🦅 🦉 🦇 🐺 🐗 🐴 🦄 🐝' +
            '🐛 🐌 🐚 🐞 🐜 🕷 🕸 🦂 🐢 🐍 🦎 🐙 🦑 🦐  🦀 🐡 🐠 🐟 🐬 🐳 🐋 🦈 🐊 🐅 🐆 🦍 🐘' +
            '🦏 🐪 🐫 🐃 🐂 🐄 🐎 🐖 🐏 🐑 🐐 🐕 🐩 🐈 🐓 🦃 🕊 🐇 🐁 🐀 🐿 🐾 🐉 🐲 🌵 🎄 🌲' +
            '🌳 🌴 🌱 🌿 ☘ 🍀 🎍 🎋 🍂 🍁 🍄 💐 🌹 🥀 🌺 🌸 🌼 🌻 🌞 🌝 🌛 🌜 🌚 🌕 🌘 🌑 🌒 🌓' +
            '🌔 🌍 🌏🌙 🌎 💫 ⭐ 🌟 ✨ ⚡ ☄ 💥 🔥 🌪 🌈 ☀ 🌤 🌥 ☁ 🌦 🌧 ⛈ 🌩 🌨 ❄ 💨 💧 💦 ☔' +
            '☂ 🌊 ⛸ ⛷ 🌫 ☃ ⛄ 🌬 ⚽ 🏓 🏸 🏀 🥅 🏈 🏒 🏂 🏋‍ 🏄‍ ⛹‍ 🤺 🤾‍ 🤸‍ 🏇 🏌‍ 🎫 🎟 🎪 🤹‍' +
            '🎭 🎨 🎬 🎤 🎧 🎼 🎹 🥁 🎷 🎺 🎲 🎳 🎮 🎰 ❤ 💔 ❣ 💕 💞 💓 💗 💘 🍏 🍎 🍊 🍋 🍌 🍉' +
            '🍇 🍓 🍈 🍒 🍑 🍍 🥝 🍅 🍆 🥑 🥒 🌶 🌽 🥕 🥔 🥐 🍞 🥖 🧀 🥚 🍳 🥞 🥓 🍗 🍖 🍖 🌭 🍔' +
            '🍟 🍕 🌮 🌯 🥗 🥘 🍝 🍜 🍲 🍛 🍣 🍱 🍤 🍙 🍚 🍘 🍢 🍡 🍧 🍨 🍦 🍰 🎂 🍮 🍭 🍬 🍫 🍿 🍩' +
            '🍪 🌰 🥜 🥛 🍼 ☕ 🍵 🍶 🍺 🍻 🥂 🍸 🥄 🍴 🍽'
  };

  form.addEventListener('submit', function(e) {
    e.preventDefault();
  });

  let maxcharacters = 30;
  form.elements.namedItem('btn-plus-one').addEventListener('click', function() {
    if (configuration.characters < maxcharacters) {
      configuration.characters++;
      inputcharacters.value = configuration.characters;
    }
  });

  let mincharacters = 2;
  form.elements.namedItem('btn-minus-one').addEventListener('click', function() {
    if (configuration.characters > mincharacters) {
      configuration.characters--;
      inputcharacters.value = configuration.characters;
    }
  });

  form.elements.namedItem('btn-symbols').addEventListener('click', function() {
    btnToggle(this);
    configuration.symbols = !configuration.symbols;
  });

  form.elements.namedItem('btn-numbers').addEventListener('click', function() {
    btnToggle(this);
    configuration.numbers = !configuration.numbers;
  });

  form.elements.namedItem('btn-uppercase').addEventListener('click', function() {
    btnToggle(this);
    configuration.uppercase = !configuration.uppercase;
  });

  form.elements.namedItem('btn-emojis').addEventListener('click', function() {
    btnToggle(this);
    configuration.emojis = !configuration.emojis;
    // Si eligen emojis, se cambia el caracter a 5 y lo máximo de caracteres pasa a 10 de lo contrario no
    if (configuration.emojis == true) {
        inputcharacters.value = 5;
        configuration.characters = 5;
        maxcharacters = 10;
    } else {
        maxcharacters = 30;
      }
  });

  form.elements.namedItem('btn-generate').addEventListener('click', function() {
    // Si escogen mas de 20 caracteres la letra de la calve generada se hace pequeña mediante una clase de lo contrario no
    if (configuration.characters > 20) {
      document.getElementById('input-password').classList.add('small');
    } else {
        document.getElementById('input-password').classList.remove('small');
      }
    generatePassword();
  });

  form.elements.namedItem('input-password').addEventListener('click', function() {
    this.select();
    document.execCommand('copy');
    document.getElementById('alert-copy').classList.add('active');
    // 7ms después del click se deselecciona el input de generar y se remueve la clase active para que se oculte la alerta
    setTimeout(function() {
      this.getSelection().removeAllRanges();
      document.getElementById('alert-copy').classList.remove('active');
    }, 700);
  });

  // Un ciclo para contar cuantos elementos con la clase btn hay, para luego que detecte al que le da click y ejecutar la función blurBtn
  for (let i = 0; i < btns.length; i++) {
    btns[i].addEventListener('click', blurBtn, false);
  }

  /* Funciones */
  function blurBtn() {
    this.blur();
  }

  function btnToggle(e) {
    e.classList.toggle('false');
    e.childNodes[1].classList.toggle('fa-check');
    e.childNodes[1].classList.toggle('fa-times');
  }

  function generatePassword() {
    let charactersEnd = '';
    let password = '';

    for (property in configuration) {
      if (configuration[property] == true) {
        charactersEnd += characters[property] + ' ';
      }
    }
		console.log(charactersEnd);
    charactersEnd = charactersEnd.trim();
    charactersEnd = charactersEnd.split(' ');
    for (let i = 0; i < configuration.characters; i++) {
      password += charactersEnd[Math.floor(Math.random() * charactersEnd.length)];
    }

    form.elements.namedItem('input-password').value = password;
  }

  generatePassword();
  
}());
//End Password Generator