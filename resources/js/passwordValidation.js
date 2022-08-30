
let password = '';
const passwordListener = document.getElementById('password').addEventListener('keyup', function() {
  password = document.getElementById('password').value;
});

let passwordConfirm = '';
const passwordConfirmListener = document.getElementById('password-confirm').addEventListener('keyup', function() {
  passwordConfirm = document.getElementById('password-confirm').value;

  const messageContainer = document.getElementById('message');
  if ( passwordConfirm === password ) {
    messageContainer.innerHTML = ``;
  } else {
    messageContainer.innerHTML = `Le password non corrispondono.`;
  }
});