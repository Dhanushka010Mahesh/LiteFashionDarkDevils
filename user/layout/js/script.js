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
