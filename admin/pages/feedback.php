<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php'; ?>

<body>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Customer Feedback</h1>

    <!-- Feedback List Table -->
    <div class="bg-white shadow-md rounded-md overflow-hidden">
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="py-2 px-4 bg-gray-800 text-white">Feedback ID</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Customer</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Message</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Date</th>
            <th class="py-2 px-4 bg-gray-800 text-white">Actions</th>
          </tr>
        </thead>
        <tbody id="feedback-table-body">
          <tr>
            <td class="border px-4 py-2">1</td>
            <td class="border px-4 py-2">Jane Doe</td>
            <td class="border px-4 py-2">Great product! I'm very satisfied.</td>
            <td class="border px-4 py-2">2024-10-05</td>
            <td class="border px-4 py-2">
              <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded" onclick="markAsReviewed(1)">Mark as Reviewed</button>
              <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded ml-2" onclick="deleteFeedback(1)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

  <script>
    function markAsReviewed(id) {
      alert('Feedback ' + id + ' marked as reviewed.');
    }

    function deleteFeedback(id) {
      if (confirm('Are you sure you want to delete this feedback?')) {
        alert('Feedback ' + id + ' has been deleted.');
      }
    }
  </script>
</body>

</html>