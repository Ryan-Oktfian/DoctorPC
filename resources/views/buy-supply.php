<?php

include_once "../../app/Controller.php";

$controller = new Controller();

if (isset($_GET['act']) && $_GET['act'] == 'showPreview') {

    $id = $_GET['id'];

    $dataPreview = $controller->getDataPreview($id);

    foreach ($dataPreview as $row) {
        $id = $row['ID_BARANG'];
        $name = $row['NAMA_SUPPLY'];
        $price = $row['HARGA_SUPPLY'];
        $stock = $row['STOK_SUPPLY'];
        $idcategory = $row['ID_CATEGORY'];

        if($idcategory == 1) {
            $category = "Laptop";
        } else if($idcategory == 2) {
            $category = "Desktop";
        } else {
            $category = "Gadget";
        }

        $image = $row['GAMBAR_SUPPLY'];

    }

} else if (isset($_GET['buy'])) {
    $id = $_GET['id'];
    $quantityBuy = $_POST['quantityBuy'];

    $data = $controller->getDataPreview($id);

    foreach ($data as $row) {
        $stock = $row['STOK_SUPPLY'];
    }

    if($quantityBuy < $stock) {
        $controller->updateData($id, $quantityBuy);
    } else if($quantityBuy == $stock) {
        $controller->deleteData($id);
    } 
    
    header("Location: supply-list.php");

}

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <title>Document</title>
    </head>
    <body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <div class="bg-white">
        <div class="pt-6">
            <nav aria-label="Breadcrumb">
            <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 sm:px-6 lg:max-w-7xl lg:px-8">
                <li>
                <div class="flex items-center">
                    <a href="supply-list.php" class="mr-2 text-sm font-medium text-gray-900">Our Collections</a>
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                    </svg>
                </div>
                </li>

                <li class="text-sm">
                <a href="#" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600"><?= $name ?></a>
                </li>
            </ol>
            </nav>

            <!-- Image gallery -->
            <div class="mx-auto max-h-80  mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:px-8">
                <div class="hidden overflow-hidden rounded-lg lg:block">
                    <img src="<?= $image ?>" alt="Two each of gray, white, and black shirts laying flat." class="h-full w-full object-cover object-center">
                </div>
            </div>

            <!-- Product info -->
            <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
            <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"><?= $name ?></h1>
            </div>

            <!-- Receipt -->
            <div class="mt-4 lg:row-span-3 lg:mt-0">
                <h2 class="sr-only">Receipt</h2>
                <p class="text-3xl tracking-tight text-gray-900">Receipt</p>

                <!-- Quantity -->
                <div class="mt-10">
                    <h3 class="text-sm font-medium text-gray-900">Quantity</h3>
                    <div class="mt-3">
                        <input type="number" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="<?= $stock ?>" required>
                    </div>
                    <h3 class="text-sm font-medium text-red">
                        
                    <?php 
                    
                    if(isset($err_message)) {
                        echo $err_message;
                    } else {
                        echo "";
                    }
                    
                    ?>
                    
                </h3>
                </div>

                <button id="buyButton" type="button" onclick="calculateTotal()" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add to bag</button>
            </div>

            <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                <!-- Description and details -->
                <div>
                <h3 class="sr-only">Price</h3>

                <div class="space-y-6">
                    <p id="price" class="text-3xl tracking-tight text-gray-900">Rp <?= $price ?></p>
                    <p id="thePrice" class="hidden text-3xl tracking-tight text-gray-900"><?= $price ?></p>
                </div>
                </div>

                <div class="mt-4">
                    <h3 class="text-lg font-medium text-gray-900">Stock</h3>
                    <p id="stock" class="mt-2 text-gray-400"><span class="text-gray-600"><?= $stock ?></span></p>
                </div>

                <div class="mt-4">
                    <h2 class="text-lg font-medium text-gray-900">Category</h2>

                <div class="mt-2 space-y-6">
                    <p class="text-sm text-gray-600"><?= $category ?></p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- Buy Popup Modal -->
        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-3 text-lg font-normal text-gray-500">Are you sure you want to buy this product?</h3>
                        <h3 class="mb-3 text-lg font-normal text-gray-500">This is the total</h3>
                        <p id="totalAlert" class="hidden mt-2 mb-2 bg-red-100 border border-red-600 text-gray-900 tracking-tight text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-4"></p>
                        <p id="total" class="hidden mt-2 mb-2 bg-gray-100 border border-gray-300 text-green-600 tracking-tight text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-4"></p>
                        <form action="?buy&id=<?= $id ?>" method="POST" id="confirmationForm" class="hidden">
                            <input type="number" name="quantityBuy" id="quantityBuy" class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg cursor-not-allowed block w-full p-2.5" placeholder="" required readonly>
                            <button type="submit" data-modal-hide="popup-modal" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                Yes, I'm sure
                            </button>
                            <button type="button" data-modal-hide="popup-modal" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--  -->

    <script>

    let total;

    function calculateTotal() {
        const quantity = document.getElementById('quantity').value;
        const price = document.getElementById('thePrice').textContent;
        const stock = document.getElementById('stock').textContent;

        if(quantity > stock || quantity < 0) {
            document.getElementById('totalAlert').style.display = "block";
            document.getElementById('total').style.display = "none";
            document.getElementById('totalAlert').innerText = "Invalid quantity";
            document.getElementById('confirmationForm').style.display = "none";
        } else {
            total = quantity * price;
            document.getElementById('total').style.display = "block";
            document.getElementById('totalAlert').style.display = "none";
            document.getElementById('total').innerText = "Rp " + total;
            document.getElementById('quantityBuy').placeholder = quantity;
            document.getElementById('quantityBuy').value = quantity;
            document.getElementById('confirmationForm').style.display = "block";
        }
    }

    </script>
</body>

</html>