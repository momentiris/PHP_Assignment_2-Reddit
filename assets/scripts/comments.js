const upvotePost = document.querySelector('.upvote');
const downvotePost = document.querySelector('.downvote');
const voteApi = 'http://localhost:8888/app/auth/votes.php';

const voteFunc = (e) => {
  fetch(voteApi, {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      credentials: "include",
      body: `postId=${e.target.value}&dir=${e.target.dataset.dir}`
    })
    .then(response => {
      return response.json()
    })
    .then(value => {
      console.log(value);
      switch (value) {
        case 1:
          upvotePost.classList.add('upvoted');
          downvotePost.classList.remove('downvoted');
          break;
        case -1:
          downvotePost.classList.add('downvoted');
          upvotePost.classList.remove('upvoted');
          break;
        case 0:
        upvotePost.classList.remove('downvoted');
        downvotePost.classList.remove('upvoted');
        break;
      
      }
    })

  fetch(voteApi, {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      credentials: "include",
      body:`post=true&postId=${e.target.value}}`
    })
    .then(response => {
      return response.json();
    })
    .then(newTotal => {
      e.target.parentNode.querySelector('.votes').innerHTML =
      newTotal;
    })

}

upvotePost.addEventListener('click', voteFunc);
downvotePost.addEventListener('click', voteFunc);
