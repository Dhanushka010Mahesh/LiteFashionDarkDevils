<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php include_once '../includes/header.php'; ?>

<body>
  <hr>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Add New Product</h1>

    <form
      id="postForm"
      enctype="multipart/form-data"
      class="flex flex-col h-full">
      <div class="grid grid-cols-2 gap-10 flex-grow">
        <!-- Left Side -->
        <div class="flex flex-col justify-between">
          <div>
            <div class="mb-4">
              <label for="P_name" class="block text-gray-700 font-bold mb-2">Product Name</label>
              <input
                type="text"
                id="P_name"
                name="P_name"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                required />
            </div>

            <div class="mb-4">
              <label
                for="P_categoryId"
                class="block text-gray-700 font-bold mb-2">Category</label>
              <select
                id="P_categoryId"
                name="P_categoryId"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                required>
                <option value="">Select Category</option>
                <option value="C001">Men</option>
                <option value="C002">Women</option>
                <option value="C003">Kids</option>
              </select>
            </div>

            <div class="mb-4">
              <label for="P_price" class="block text-gray-700 font-bold mb-2">Price</label>
              <input
                type="number"
                step="0.01"
                id="P_price"
                name="P_price"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                required />
            </div>

            <div class="mb-4">
              <label
                for="P_quantity"
                class="block text-gray-700 font-bold mb-2">Quantity</label>
              <input
                type="number"
                id="P_quantity"
                name="P_quantity"
                value="1"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                required
                disabled />
            </div>

            <div class="mb-4">
              <label
                for="P_description"
                class="block text-gray-700 font-bold mb-2">Description</label>
              <textarea
                id="P_description"
                name="P_description"
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                rows="4"></textarea>
            </div>
          </div>
        </div>

        <!-- Right Side -->
        <div class="flex flex-col justify-between">
          <div>
            <!-- images -->
            <div>
              <div class="mb-4">
                <label for="P_image1" class="block text-gray-700 font-bold mb-2">Image 1</label>
                <input
                  type="file"
                  id="P_image1"
                  name="P_image1"
                  class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" />
              </div>

              <div class="mb-4">
                <label for="P_image2" class="block text-gray-700 font-bold mb-2">Image 2</label>
                <input
                  type="file"
                  id="P_image2"
                  name="P_image2"
                  class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" />
              </div>

              <div class="mb-4">
                <label for="P_image3" class="block text-gray-700 font-bold mb-2">Image 3</label>
                <input
                  type="file"
                  id="P_image3"
                  name="P_image3"
                  class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" />
              </div>

              <div class="mb-4">
                <label for="P_image4" class="block text-gray-700 font-bold mb-2">Image 4</label>
                <input
                  type="file"
                  id="P_image4"
                  name="P_image4"
                  class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" />
              </div>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 font-bold mb-2">Sizes</label>
              <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                  <input
                    type="checkbox"
                    id="P_small"
                    name="P_small"
                    value="S"
                    class="form-checkbox" />
                  <span class="ml-2">Small</span>
                </label>
                <label class="inline-flex items-center">
                  <input
                    type="checkbox"
                    id="P_medium"
                    name="P_medium"
                    value="M"
                    class="form-checkbox" />
                  <span class="ml-2">Medium</span>
                </label>
                <label class="inline-flex items-center">
                  <input
                    type="checkbox"
                    id="P_large"
                    name="P_large"
                    value="L"
                    class="form-checkbox" />
                  <span class="ml-2">Large</span>
                </label>
                <label class="inline-flex items-center">
                  <input
                    type="checkbox"
                    id="P_extraLarge"
                    name="P_extraLarge"
                    value="XL"
                    class="form-checkbox" />
                  <span class="ml-2">Extra Large</span>
                </label>
              </div>
            </div>

            <div class="mb-4">
              <label for="P_status" class="block text-gray-700 font-bold mb-2">Status</label>
              <select
                id="P_status"
                name="P_status"
                disabled
                class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-end items-center mt-4 gap-10 p-4 border-t border-gray-200">
        <!-- Message -->
        <h1 class="text-sky-500 font-semibold text-lg" id="show"></h1>
        <!-- Button -->
        <button
          type="submit"
          name="submit"
          class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition-transform duration-300 transform hover:scale-105">
          Add Product
        </button>
      </div>

    </form>
  </div>

  <script>
    document.getElementById('postForm').addEventListener('submit', postName);

    function postName(e) {
      e.preventDefault();

      let formData = new FormData(document.getElementById('postForm'));

      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'http://localhost/LiteFashionDarkDevils/admin/pages/backend/add-product.php', true);

      xhr.onload = function() {
        if (xhr.status === 200) {
          console.log(this.responseText);
          document.getElementById('show').innerHTML = this.responseText;
        } else {
          console.error('Error in form submission');
        }
      };

      xhr.send(formData);
    }
  </script>
</body>

</html>