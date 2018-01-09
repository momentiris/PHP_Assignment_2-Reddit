editBtn = document.querySelector('.editprofile');
editForm = document.querySelector('.editForm');
posts = document.querySelector('.posts');
editPw = document.querySelector('.editpassword');
editPwForm = document.querySelector('.editPwForm');


editBtn.addEventListener('click', () =>  {
  editForm.classList.toggle('hidden');
  editForm.classList.toggle('showing_edit');

})

editPw.addEventListener('click', () =>  {
  editPwForm.classList.toggle('hidden');
  editPwForm.classList.toggle('showing_edit_pw');
})
