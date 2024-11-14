/******  sidebar click events using JQuery ******/
$(document).ready(function () {
  $('#add-product-link').click(function (event) {
    event.preventDefault();
    $('#content-container').load(
      'http://localhost/LiteFashionDarkDevils/admin/pages/add_product.php'
    );
  });

  $('#product-list-link').click(function (event) {
    event.preventDefault();
    $('#content-container').load(
      'http://localhost/LiteFashionDarkDevils/admin/pages/product_list.php'
    );
  });

  $('#order-list-link').click(function (event) {
    event.preventDefault();
    $('#content-container').load(
      'http://localhost/LiteFashionDarkDevils/admin/pages/order_list.php'
    );
  });

  $('#report-link').click(function (event) {
    event.preventDefault();
    $('#content-container').load(
      'http://localhost/LiteFashionDarkDevils/admin/pages/report.php'
    );
  });

  // $('#profile').click(function (event) {
  //   event.preventDefault();
  //   $('#content-container').load(
  //     'http://localhost/LiteFashionDarkDevils/admin/pages/profile.php'
  //   );
  // });
});

/******  content change ******/
function showContent(contentId) {
  // Hide all content sections
  const allContent = document.querySelectorAll('.content');
  allContent.forEach((content) => content.classList.remove('active'));

  // Show the selected content section
  const selectedContent = document.getElementById(contentId);
  selectedContent.classList.add('active');
}
