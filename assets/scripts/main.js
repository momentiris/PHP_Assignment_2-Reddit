let pageNum = 1;
let totalPosts = 0;
const api = "/../../pagination.php";
const postContainer = document.querySelector('.postcontainer');

let divElement = document.createElement('div');


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
        </div>
        </div>`;
          divElement.innerHTML += postElement;
          postContainer.appendChild(divElement);
    }
})
}

getPage(pageNum);


  window.addEventListener('scroll', function() {
    let currentAmountOfPosts = postContainer.querySelectorAll('.card').length;
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && currentAmountOfPosts < totalPosts){
      console.log(currentAmountOfPosts, totalPosts);
      pageNum++;
        getPage(pageNum);
        console.log('hej');

    }
  });
