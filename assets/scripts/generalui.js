const newPost= document.querySelector('.newpost');
const hiddenPost = document.querySelector('article');
let hiddenPostHeight = hiddenPost.clientHeight;
console.log(hiddenPostHeight);

const postBox = document.querySelector('.postBox')
newPost.addEventListener('click', function() {

  hiddenPost.classList.toggle('showing');
  hiddenPost.classList.toggle('hidden');
  postBox.style.cssText = `transform: translateY() `

});
