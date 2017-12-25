
let downVoted = 0;


let pageNum = 1;
let totalPosts = 0;

const api = "/../../pagination.php";
const voteApi = 'http://localhost:8888/app/auth/votes.php';
const postContainer = document.querySelector('.postcontainer');
let divElement = document.createElement('div');
let voteButton = document.createElement('button');
voteButton.classList.add('upvote');

voteButton.innerText = "upvotes";
voteButton.dataset.dir = "1";



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


 const getPage = (page) => {
fetch(`${api}/?page=${page}`)
  .then(response => {
    return response.json();
  })
  .then(postsOnPage => {
    totalPosts = JSON.parse(postsOnPage['total'][0]);
    for (posts of postsOnPage['posts'][0]) {
      voteButton.setAttribute("value", `${posts.id}`);
      let postElement =
      `<div class="card postcontainer" style="margin-bottom: 1rem;padding: 0;">
        <div class="card-body">
          <h5 class="card-title title">${posts.title}</h4>
          <p class="card-text small content">${posts.content}</p>
          <p class="card-text small url">${posts.url}</p>
          <p class="card-text small username">${posts.username}</p>
          <p class="card-text small time">${posts.time}</p>
          <p class="card-text small votes">${posts.votes}</p>
          ${voteButton.outerHTML}
        </div>
      </div>`;
          divElement.innerHTML += postElement;
          postContainer.appendChild(divElement);

    };

          const upvoteArr = document.querySelectorAll('.upvote');
          Array.from(upvoteArr).forEach(upvote);

})
}

getPage(pageNum);

window.addEventListener('scroll', function() {
    let currentAmountOfPosts = postContainer.querySelectorAll('.card').length;
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && currentAmountOfPosts < totalPosts){
      console.log(currentAmountOfPosts, totalPosts);
      pageNum++;
        getPage(pageNum);
  }
});
