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
    totalPosts = postsOnPage['total'][0];
    console.log(JSON.parse(totalPosts));
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
});
}
getPage(pageNum);


  window.addEventListener('scroll', function() {

    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight){
      pageNum++;
        getPage(pageNum);
        let postContainerChildren = postContainer.querySelectorAll('.card').length;
        console.log(postContainerChildren);
    }
  });
