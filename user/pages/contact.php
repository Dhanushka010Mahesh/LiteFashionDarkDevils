<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);
  $store_email = 'litefashion256@gmail.com';

  $resendApiKey = $_ENV['RESEND_API_KEY'];
  $resend = Resend::client($resendApiKey);

  $resend->emails->send([
    "from" => "litefashion@zhake.live",
    "to" => $store_email,
    "subject" => $subject,
    "html" => "
            <h2>Message from: $name</h2>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>"
  ]);
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php' ?>

<body>
  <!-- navbar -->
  <?php include_once '../includes/navbar.php' ?>

  <!-- page header -->
  <section
    id="page-header-about"
    class="flex flex-col py-0 px-20 text-center justify-center">
    <h1 class="text-6xl font-semibold text-white/90 p-3">#Let's_talk</h1>
    <p class="text-white/80">We're Here to Help You</p>
  </section>

  <!-- location details -->
  <section class="py-10 px-20 mx-10 my-30">
    <div class="flex items-center justify-between">
      <div>
        <span class="text-xl text-slate-700">GET IN TOUCH</span>
        <h2 class="text-5xl font-bold pt-2">Lite Fashion Store</h2>
        <p class="text-2xl font-bold text-slate-800">Kandy</p>
        <ul class="list-none py-5 text-slate-700">
          <li class="flex py-2 px-0.5 items-center gap-5">
            <i class="fa-solid fa-location-dot"></i>
            <p>No. 123, Main Street,Kandy, Sri Lanka.</p>
          </li>
          <li class="flex py-2 items-center gap-5">
            <i class="fa-solid fa-envelope"></i>
            <p>+94 81 123 4567</p>
          </li>
          <li class="flex py-2 items-center gap-5">
            <i class="fa-solid fa-phone"></i>
            <p>info@lite_fashion.lk</p>
          </li>
          <li class="flex py-2 items-center gap-5">
            <i class="fa-solid fa-clock"></i>
            <p>Monday to Saturday: 9:00 AM to 7:00 PM</p>
          </li>
        </ul>
      </div>
      <div>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1013129.8222267724!2d80.076382965625!3d7.293244200000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3662bc0efce8d%3A0x72eef83f0635fce0!2sFashion%20Bug%20Kandy%20City!5e0!3m2!1sen!2ssg!4v1726865372035!5m2!1sen!2ssg"
          width="550"
          height="350"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

  <!-- contact form -->
  <section class="py-10 px-20 mx-10">
    <div class="py-8 px-4 mx-auto max-w-screen-md">
      <div class="text-center">
        <p class="text-lg text-slate-700">LEAVE A MESSAGE</p>
        <h2 class="text-4xl font-bold pb-5">Let us know what you need</h2>
      </div>
      <form action="" method="post" class="space-y-2">
        <div>
          <label for="name" class="block mb-1 font-medium text-gray-900">Your Name</label>
          <input
            type="text"
            name="name"
            class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2"
            placeholder="Alex Martin"
            required />
        </div>
        <div>
          <label for="email" class="block mb-1 font-medium text-gray-900">Your email</label>
          <input
            type="email"
            name="email"
            class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2"
            placeholder="name@gmail.com"
            required />
        </div>
        <div>
          <label for="subject" class="block mb-1 font-medium text-gray-900">Subject</label>
          <input
            type="text"
            name="subject"
            class="mb-4 block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500"
            placeholder="Let us know how we can help you"
            required />
        </div>
        <div class="sm:col-span-2">
          <label for="message" class="block mb-1 font-medium text-gray-900">Your message</label>
          <textarea
            name="message"
            rows="6"
            class="block p-2.5 w-full text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 mb-4"
            placeholder="Leave a comment..."></textarea>
        </div>
        <button
          type="submit"
          class="py-3 px-5 text-sm font-medium text-center text-white bg-sky-500 rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300">
          Send message
        </button>
      </form>
    </div>
  </section>


  <!-- footer -->
  <?php include_once '../includes/footer.php' ?>

  <script src="../layout/js/script.js"></script>
</body>

</html>