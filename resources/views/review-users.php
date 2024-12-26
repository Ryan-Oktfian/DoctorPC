<?php
include("../../app/Controller.php");
$controller = new Controller();

// Inisialisasi variabel untuk mode edit
$editMode = false;
$editReviewId = 0;
$editReviewText = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_review_id'])) {
        $controller->deleteReview($_POST['delete_review_id']);
    } elseif (isset($_POST['edit_review_id'])) {
        $editMode = true;
        $editReviewId = $_POST['edit_review_id'];
        $editReviewText = $_POST['review_text'];
    } elseif (isset($_POST['update_review'])) {
        $controller->updateReview($_POST['review_id'], $_POST['review']);
    } elseif (isset($_POST['review'])) {
        $controller->saveReview($_POST['review']);
    }
}

// Mengambil semua review
$allReviews = $controller->getReviews();

// Hanya untuk pengguna yang login
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $myReviews = $controller->getMyReviews($userId);
} else {
    $myReviews = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold text-center my-5">Leave a Review</h1>

        <!-- Form Section -->
        <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <!-- Review Input -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="review">
                    Review
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="review" name="review" placeholder="Enter your review"></textarea>
            </div>
            <!-- Buttons -->
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Send
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="../Dashboard.php">
                    Back to Dashboard
                </a>
            </div>
        </form>
        
        <!-- Bagian untuk 'Review Saya' -->
        <div class="my-reviews mx-auto max-w-2xl lg:max-w-4xl">
            <h2 class="text-2xl font-bold text-center my-5">Review Saya</h2>
            
            <?php foreach ($myReviews as $review) { ?>
                <div class="review bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <?php if ($editMode && $editReviewId == $review['id']) { ?>
                        <!-- Form untuk mengedit review -->
                        <form action="" method="post" class="space-y-4">
                            <textarea name="review" class="w-full rounded border px-3 py-2 text-gray-700 focus:outline-none focus:shadow-outline"><?= htmlspecialchars($editReviewText) ?></textarea>
                            <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
                            <button type="submit" name="update_review" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Review</button>
                        </form>
                        <?php } else { ?>
                            
                        <!-- Tampilkan review -->
                        <blockquote class="text-center text-xl font-semibold leading-8 text-gray-900 sm:text-2xl sm:leading-9">
                            <p>"<?= htmlspecialchars($review['review']) ?>"</p>
                        </blockquote>
                        <div class="mt-10 flex items-center justify-center">
                            <img class="h-10 w-10 rounded-full" src="https://img.freepik.com/free-photo/handsome-young-man-with-arms-crossed-white-background_23-2148222620.jpg" alt="">
                            <div class="ml-4 text-base font-semibold text-gray-900"><?= htmlspecialchars($review['USERNAME']) ?></div>
                        </div>
                        
                        <!-- Tombol Edit dan Delete -->
                        <div class="flex justify-end mt-4 space-x-3">
                            <form action="" method="post">
                                <input type="hidden" name="edit_review_id" value="<?= $review['id'] ?>">
                                <input type="hidden" name="review_text" value="<?= htmlspecialchars($review['review']) ?>">
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                            </form>
                            
                            <form action="" method="post" onsubmit="return confirmDelete()">
                            <input type="hidden" name="delete_review_id" value="<?= $review['id'] ?>">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                        </form>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

</div>

<script>
    function confirmDelete() {
        return confirm('Apakah Anda yakin ingin menghapus review ini?');
    }
</script>
</body>
</html>
