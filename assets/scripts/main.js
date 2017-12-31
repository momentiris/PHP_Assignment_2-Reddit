let downVoted = 0;
let pageNum = 1;
let totalPosts = 0;
const api = "/../../pagination.php";
const voteApi = 'http://localhost:8888/app/auth/votes.php';
const postContainer = document.querySelector('.postcontainer');
let divElement = document.createElement('div');

// generate upvote and downvote element
let upvoteBtn = document.createElement('button');
upvoteBtn.classList.add('upvote');
upvoteBtn.innerText = "upvotes";
upvoteBtn.dataset.dir = "+1";
///////////////////////////
let downvoteBtn = document.createElement('button');
downvoteBtn.classList.add('downvote');
downvoteBtn.innerText = "downvote";
downvoteBtn.dataset.dir = "-1";
// end



const voteFunc = (e) => {
  fetch(voteApi, {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      credentials: "include",
      body: `postId=${e.target.value}&dir=${e.target.dataset.dir}`
    })
    .then(response => {
      console.log(response.json());

    })

console.log(e.target.dataset.dir);
console.log(e.target.value);

}

const upvote = (upvote) => {
  upvote.addEventListener('click', voteFunc);
}
const downvote = (downvote) => {
  downvote.addEventListener('click', voteFunc);
}


 const getPage = (page) => {
fetch(`${api}/?page=${page}`)
  .then(response => {
    return response.json();
  })
  .then(postsOnPage => {
    totalPosts = JSON.parse(postsOnPage['total'][0]);
    for (posts of postsOnPage['posts'][0]) {
      upvoteBtn.setAttribute("value", `${posts.id}`);
      downvoteBtn.setAttribute("value", `${posts.id}`);
      let postElement =
      `<div class="card">
        <div class="card-body">
          <a href="${posts.url}"><h5 class="card-title title">${posts.title}</h5></a>
          <p class="small content">${posts.content}</p>
          <p class="small username">${posts.username}</p>
          <p class="small time">${posts.time}</p>
          <p class="small votes">${posts.votes}</p>

          ${upvoteBtn.outerHTML}
          ${downvoteBtn.outerHTML}
        </div>
      </div>`;
          divElement.innerHTML += postElement;
          postContainer.appendChild(divElement);
    };
          const upvoteArr = document.querySelectorAll('.upvote');
          const downvoteArr = document.querySelectorAll('.downvote');
          Array.from(upvoteArr).forEach(upvote);
          Array.from(downvoteArr).forEach(downvote);
})
}

getPage(pageNum);

//eventlistener for detecting if user scrolled to bottom. Only runs getPage func if current amount of posts generated in dom is less than total amount of posts in DB.
window.addEventListener('scroll', function() {
    let currentAmountOfPosts = postContainer.querySelectorAll('.card').length;
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && currentAmountOfPosts < totalPosts){
      console.log(currentAmountOfPosts, totalPosts);
      pageNum++;
        getPage(pageNum);
  }
});
