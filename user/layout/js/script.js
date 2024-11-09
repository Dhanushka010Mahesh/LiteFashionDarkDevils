/******** single product page image change method **********/
const mainImage = document.getElementById('main-image');
const smallImages = document.querySelectorAll('.small-image');

smallImages.forEach((smallImage) => {
  smallImage.addEventListener('click', () => {
    mainImage.src = smallImage.src;
  });
});

/******** login popup **********/
function popup() {
  const dropdownMenu = document.getElementById('dropdownMenu');
  dropdownMenu.classList.toggle('hidden');
}

/******** contact page form submit **********/
document.getElementById('postForm').addEventListener('submit', postName);

function postName(e) {
  e.preventDefault();

  let formData = new FormData(document.getElementById('postForm'));

  let xhr = new XMLHttpRequest();
  xhr.open('POST', '#', true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById('show').innerHTML = 'Message sent successfully';
    } else {
      console.error('Error in form submission');
    }
  };

  xhr.send(formData);
}