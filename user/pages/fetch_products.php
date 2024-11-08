<?php
require_once('../includes/config.php');

$category = $_GET['category'] ?? 'all';
$search = $_GET['search'] ?? '';
$sortOrder = $_GET['sortOrder'] ?? 'default';

$query = "SELECT * FROM clothProduct WHERE P_status = 1";

// Filter by category
if ($category !== 'all') {
    $query .= " AND P_categoryId = :category";
}

// Search by name
if (!empty($search)) {
    $query .= " AND P_name LIKE :search";
}

// Sort by price
if ($sortOrder === 'low-to-high') {
    $query .= " ORDER BY P_price ASC";
} elseif ($sortOrder === 'high-to-low') {
    $query .= " ORDER BY P_price DESC";
}

$statement = $connection->prepare($query);

// Bind parameters
if ($category !== 'all') {
    $statement->bindParam(':category', $category);
}
if (!empty($search)) {
    $searchTerm = '%' . $search . '%';
    $statement->bindParam(':search', $searchTerm);
}

$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

$output = '';
foreach ($products as $product) {
    $output .= '
        <div class="p-4 border rounded-md shadow hover:shadow-lg transition duration-200 cursor-pointer" onclick="window.location.href=\'single_product.php?id=' . $product['ProductId'] . '\'">
            <img src="http://localhost/LiteFashionDarkDevils/admin/uploads/' . $product['P_image1'] . '" alt="' . $product['P_name'] . '" class="w-full h-64 object-cover rounded-md" />
            <div class="mt-4">
                <span class="block text-gray-600">' . $product['P_categoryId'] . '</span>
                <h3 class="text-lg font-semibold">' . $product['P_name'] . '</h3>
                <p class="text-red-400 font-bold">$' . $product['P_price'] . '</p>
            </div>
        </div>
    ';
}

echo $output;
?>
