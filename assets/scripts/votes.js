let currentUser = 0;
let triggerHappy = true;

let editP = ``;
let pageNum = 1;
let totalPosts = 0;
const api = "/../../pagination.php";
const voteApi = 'http://localhost:8888/app/auth/votes.php';
const postContainer = document.querySelector('.postcontainer');
const loading = document.querySelector('.loading');
let divElement = document.createElement('div');

// generate upvote and downvote element
let upvoteBtn = document.createElement('button');
upvoteBtn.classList.add('upvote');
upvoteBtn.innerText = "A";
upvoteBtn.dataset.dir = "+1";
///////////////////////////
let downvoteBtn = document.createElement('button');
downvoteBtn.classList.add('downvote');
downvoteBtn.innerText = "Ω";
downvoteBtn.dataset.dir = "-1";
// end

//voteFunc recieves the clicked upvote/downvote and sends it value and dataset to votes.php
//votes.php return the vote value and then inside the fetch i add/remove classes depending on vote value.
//wanted to get the received value instead of reading button value directly to ensure no class is added until the fetch returns a value.
const voteFunc = (e) => {
  fetch(voteApi, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      credentials: "include",
      body: `postId=${e.target.value}&dir=${e.target.dataset.dir}`
    })
    .then(response => {
      return response.json();
    })
    .then(value => {
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
// Another fetch to get the new total sum of votes for the post and update score accordingly.
  fetch(voteApi, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      credentials: "include",
      body: `post=true&postId=${e.target.value}}`
    })
    .then(response => {
      return response.json();
    })
    .then(newTotal => {
      e.target.parentNode.querySelector('.votes').innerHTML =
        newTotal;
    })

}
const upvote = (upvote) => {
  upvote.addEventListener('click', voteFunc);
}
const downvote = (downvote) => {
  downvote.addEventListener('click', voteFunc);
}
// getPage makes a post to pagination.php which return posts. CHeck pagination.php JSON output for clarification ;)
// Then it loops out the complete post in accordance with the JSON data returned from pagination.php
const getPage = (page) => {
  loading.classList.remove('loadingHidden');
  fetch(`${api}/?page=${page}`, {
      credentials: "include",
    })
    .then(response => {
      return response.json();
    })
    .then(postsOnPage => {

        totalPosts = JSON.parse(postsOnPage['total'][0]);
        for (posts of postsOnPage['posts'][0]) {
          if (postsOnPage.session == posts.author_id) {
            let editBtn = `<p class="edit"><a href="/editpost.php?post=${posts.id}">Edit post</a></p>`;
            editP.href = `editpost.php?post=${posts.id}`
            editP = editBtn;
          } else {
            editP = "";
          }
          upvoteBtn.setAttribute("value", `${posts.id}`);
          downvoteBtn.setAttribute("value", `${posts.id}`);
          let postElement =
            `<div class="countMe">
              <div class="postCont">
                <div class="contentCont">
                  <a href="${posts.url}"><h5 class="card-title title">${posts.title}</h5></a>
                  <p class="small content">${posts.content.substring(0,50) + '...'}</p>
                  <div class="commentEdit">
                    <p class="comment"><a href="/comments.php?post=${posts.id}">Comment</a></p>
                    <p class="small content">${editP}</p>
                  </div>
                  <p class="small time">Submitted by <a href="/profile.php?user=${posts.author_id}">${posts.username}</a> on ${posts.time}</p>
                </div>
                <div class="voting">
                   ${upvoteBtn.outerHTML}
                <small class="votes">${posts.votes}</small>
                  ${downvoteBtn.outerHTML}
                </div>
              </div>
            </div>`;
          divElement.innerHTML += postElement;
          postContainer.appendChild(divElement);
        }

        let generatedButtonsUp = document.querySelectorAll('.upvote');
        let generatedButtonsDown = document.querySelectorAll('.downvote');
// This just for styling my JS created buttons.
        for (votedpost of postsOnPage['uservoted'][0]) {
          for (button of generatedButtonsUp) {
            button.style.cssText = "border: none; font-size: 20px; outline: none; cursor: pointer;";
            if (button.value == votedpost.post_id && votedpost.vote_value == 1) {
              button.classList.add('upvoted');
            }
          }
          for (button of generatedButtonsDown) {
            button.style.cssText = "border: none;  font-size: 20px; outline: none; cursor: pointer;";
            if (button.value == votedpost.post_id && votedpost.vote_value == -1) {
              button.classList.add('downvoted');
            }
          }
        }
        const upvoteArr = document.querySelectorAll('.upvote');
        const downvoteArr = document.querySelectorAll('.downvote');
        Array.from(upvoteArr).forEach(upvote);
        Array.from(downvoteArr).forEach(downvote);
        loading.classList.add('loadingHidden');

      })
}

getPage(pageNum);

//eventlistener for detecting if user scrolled to bottom. Only runs getPage func if current amount of posts generated in dom is less than total amount of posts in DB.
//This works better if resolution is like my computer where the body is higher than window without the "New post" curtain form visible. Else just toggle "new post" for it to work.
window.addEventListener('scroll', function() {
  let currentAmountOfPosts = postContainer.querySelectorAll('.countMe').length;
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && currentAmountOfPosts < totalPosts && triggerHappy == true) {
    pageNum++;
    getPage(pageNum);
    triggerHappy = false;
    setTimeout(function() {
      triggerHappy = true;
    }, 500)
  }
});
