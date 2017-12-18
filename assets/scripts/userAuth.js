

const usernameField = document.querySelector('#usernameInput');
const deniedUsername = document.querySelector('.deniedUsername');

fetch(`../../search_users.php`)
  .then(response => {
    return response.json();
  })
  .then(jsonUsernames => {
    let checkUsername = () => {
      let usernameInput = usernameField.value;
    for (usernames of jsonUsernames ) {

      if (usernameInput.toLowerCase() == usernames['username'].toLowerCase()) {
        deniedUsername.textContent = "Sorry, that username is taken...";
        deniedUsername.style.color="red";
        break;

      } else if (usernameInput !== usernames['username']){
        deniedUsername.textContent = "This username is available";
        deniedUsername.style.color="green";

      }
    }
  }
  usernameField.addEventListener('keyup', checkUsername);
});


// let lastKeyPressTime = 0;
// usernameField.addEventListener('keyup', function() {
//   if (Date.now() - lastKeyPressTime > 2000) {
//     console.log('last pressed:', lastKeyPressTime);
//     lastKeyPressTime = Date.now();
//     checkUsername();
//   }
// });
