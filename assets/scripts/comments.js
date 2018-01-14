const upvotePost = document.querySelector('.upvotePost');
const downvotePost = document.querySelector('.downvotePost');
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
          e.target.classList.add('upvoted');
          e.target.parentNode.querySelector('.downvote').classList.remove('downvoted');
          break;
        case -1:
          e.target.classList.add('downvoted');
          e.target.parentNode.querySelector('.upvote').classList.remove('upvoted');
          break;
        case 0:
        e.target.parentNode.querySelector('.downvote').classList.remove('downvoted');
        e.target.parentNode.querySelector('.upvote').classList.remove('upvoted');
        default:
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
