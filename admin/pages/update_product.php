<?php
require_once '../auth_check.php';

require_once '../includes/config.php';

$product = null;

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    try {
        $stmt = $connection->prepare("SELECT * FROM clothproduct WHERE ProductId = :product_id");
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No product ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once '../includes/header.php'; ?>

<body class="bg-gray-800">
    <div class="container mx-auto px-8 py-3 max-w-4xl bg-gray-100 shadow">
        <h1 class="text-2xl font-bold text-center mb-6 text-gray-100 bg-sky-600 p-4 rounded-lg">Update Product</h1>

        <?php if ($product) : ?>
            <form id="updateForm" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="ProductId" value="<?php echo htmlspecialchars($product->ProductId); ?>" />

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Left Side -->
                    <div class="flex flex-col space-y-4">
                        <div class="mb-2">
                            <label for="P_name" class="block text-gray-700 font-semibold">Product Name</label>
                            <input type="text" id="P_name" name="P_name" value="<?php echo htmlspecialchars($product->P_name); ?>" class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required />
                        </div>

                        <div class="mb-2">
                            <label for="P_categoryId" class="block text-gray-700 font-semibold">Category</label>
                            <select id="P_categoryId" name="P_categoryId" class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                                <option value="C001" <?php echo $product->P_categoryId == 'C001' ? 'selected' : ''; ?>>Men</option>
                                <option value="C002" <?php echo $product->P_categoryId == 'C002' ? 'selected' : ''; ?>>Women</option>
                                <option value="C003" <?php echo $product->P_categoryId == 'C003' ? 'selected' : ''; ?>>Kids</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="P_price" class="block text-gray-700 font-semibold">Price</label>
                            <input type="number" step="0.01" id="P_price" name="P_price" value="<?php echo htmlspecialchars($product->P_price); ?>" class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required />
                        </div>

                        <div class="mb-2">
                            <label for="P_quantity" class="block text-gray-700 font-semibold">Quantity</label>
                            <input type="number" id="P_quantity" name="P_quantity" value="<?php echo htmlspecialchars($product->P_quantity); ?>" class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required />
                        </div>

                        <div class="mb-2">
                            <label for="P_description" class="block text-gray-700 font-semibold">Description</label>
                            <textarea id="P_description" name="P_description" class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" rows="4"><?php echo htmlspecialchars($product->P_description); ?></textarea>
                        </div>

                        <div class="mb-2">
                            <label class="block text-gray-700 font-semibold">Sizes</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="P_small" value="1" <?php echo $product->P_small ? 'checked' : ''; ?> class="form-checkbox" />
                                    <span class="ml-2">Small</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="P_medium" value="1" <?php echo $product->P_medium ? 'checked' : ''; ?> class="form-checkbox" />
                                    <span class="ml-2">Medium</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="P_large" value="1" <?php echo $product->P_large ? 'checked' : ''; ?> class="form-checkbox" />
                                    <span class="ml-2">Large</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="P_extraLarge" value="1" <?php echo $product->P_extraLarge ? 'checked' : ''; ?> class="form-checkbox" />
                                    <span class="ml-2">Extra Large</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="flex flex-col space-y-4">
                        <!-- Image Uploads -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold">Product Images</label>
                            <div class="grid grid-cols-2 gap-4">
                                <?php for ($i = 1; $i <= 4; $i++) : ?>
                                    <?php $imageField = "P_image$i"; ?>
                                    <div class="flex flex-col items-center space-y-2">
                                        <label for="<?php echo $imageField; ?>" class="font-semibold">Image <?php echo $i; ?></label>
                                        <input type="file" id="<?php echo $imageField; ?>" name="<?php echo $imageField; ?>" class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" />
                                        <?php if (!empty($product->$imageField)) : ?>
                                            <img src="../uploads/<?php echo htmlspecialchars($product->$imageField); ?>" alt="Current Image <?php echo $i; ?>" class="mt-2 w-20 h-auto rounded-md border border-gray-300" />
                                        <?php endif; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                       
                        <div class="mb-2">
                            <label for="P_status" class="block text-gray-700 font-semibold">Status</label>
                            <select id="P_status" name="P_status" class="w-full px-3 py-2 bg-white rounded-md border border-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                                <option value="1" <?php echo $product->P_status == 1 ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?php echo $product->P_status == 0 ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center gap-4 p-2 border-t border-gray-200">
                    <!-- Message -->
                    <h1 class="text-sky-500 font-semibold text-lg" id="show"></h1>
                    <!-- Button -->
                    <button
                        type="submit"
                        name="update"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition-transform duration-300 transform hover:scale-105">
                        Update Product
                    </button>
                </div>
            </form>
        <?php else : ?>
            <p>Product not found.</p>
        <?php endif; ?>
    </div>

    <script>
        document.getElementById('updateForm').addEventListener('submit', postName);

        function postName(e) {
            e.preventDefault();

            let formData = new FormData(document.getElementById('updateForm'));

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost/LiteFashionDarkDevils/admin/pages/backend/update-product.php', true);

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