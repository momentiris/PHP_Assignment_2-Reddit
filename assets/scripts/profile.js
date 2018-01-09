editBtn = document.querySelector('.editprofile');
editForm = document.querySelector('.editForm');
posts = document.querySelector('.posts');


editBtn.addEventListener('click', () =>  {
  editForm.classList.toggle('hidden');
  editForm.classList.toggle('showing');
  posts.classList.toggle('posts-move');
})
