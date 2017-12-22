let upVote = 0;
let downVote = 0;
let pageNum = 1;
let totalPosts = 0;

const api = "/../../pagination.php";
const voteApi = 'http://localhost:8888/app/auth/votes.php';
const postContainer = document.querySelector('.postcontainer');
let divElement = document.createElement('div');
let voteButton = document.createElement('button');
voteButton.classList.add('upvote');
voteButton.innerText = "upvote";

const voteFunc = () => {
upVote++;

fetch(voteApi, {
    method: 'POST',

     body: JSON.stringify({
    name: 'dean',
    login: 'dean',
  })
})
.then(function (data) {
  console.log('Request success: ', data);
})
.catch(function (error) {
  console.log('Request failure: ', error);
});

}

const voteBtn = (voteBtn) => {
  voteBtn.addEventListener('click', voteFunc);
}


 const getPage = (page) => {
fetch(`${api}/?page=${page}`)
  .then(response => {
    return response.json();
  })
  .then(postsOnPage => {
    totalPosts = JSON.parse(postsOnPage['total'][0]);
    for (posts of postsOnPage['posts'][0]) {
      let postElement =  `<div class="card postcontainer" style="margin-bottom: 1rem;padding: 0;">
        <div class="card-body">
          <h5 class="card-title title">${posts.title}</h4>
          <p class="card-text small content">${posts.content}</p>
          <p class="card-text small url">${posts.url}</p>
          <p class="card-text small username">${posts.username}</p>
          <p class="card-text small time">${posts.time}</p>
          <p class="card-text small votes">${posts.votes}</p>
        </div>
        </div>`;





          divElement.innerHTML += postElement;
          postContainer.appendChild(divElement);
          divElement.appendChild(voteButton);

          };
          const upvote = document.querySelectorAll('.upvote');
          upvote.forEach(voteBtn);
    //       for (button of upvote) {
    //         button.addEventListener('click', function(){
    //           console.log('hej');
    //         })
    //
    // }
})

}

getPage(pageNum);
const clicked = () => {
  console.log('hej');
}





  window.addEventListener('scroll', function() {
    let currentAmountOfPosts = postContainer.querySelectorAll('.card').length;
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && currentAmountOfPosts < totalPosts){
      console.log(currentAmountOfPosts, totalPosts);
      pageNum++;
        getPage(pageNum);
        console.log('hej');

    }
  });
