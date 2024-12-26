<?php
include("../../app/Controller.php");

$controller = new Controller();
$dataReq = $controller->showrequest();

if (isset($_GET['add'])) {
    $namaPelanggan = $_POST['namaPelanggan'];
    $kontakPelanggan = $_POST['kontakPelanggan'];
    $merkDevice = $_POST['merkDevice'];
    $deskripsi = $_POST['deskripsi'];
    $controller->addrequest($namaPelanggan, $kontakPelanggan, $merkDevice, $deskripsi);
    header("location: service-request.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Service Request</title>
    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }

    h1 {
        padding-top: 50px;
        text-align: center;
    }
    h3{
        padding-top: 50px;
    }

    main {
        flex: 1;
    }

    footer {

        text-align: center;
        padding: 1rem;
    }
    </style>
</head>

<body class="bg-gray-100">
    <main class="container">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
            aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        </div>
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Have Problem With Your Device?</h1>
            <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Let`s Get Service!</h2>
        </div>

        <div class="text-center">
        <h3 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Queue List</h3>
        </div>
        <form class="form-inline" style="margin-top: 50px; margin-bottom: 5px;">
            <div class="form-group">
                <input type="text" class="form-control" id="search" placeholder="Enter Name">
            </div>
            <button type="button" class="btn btn-default" id="searchBtn">Search</button>
        </form>
        <div style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID Service</th>
                        <th>Nama Pelanggan</th>
                        <th>Kontak Pelanggan</th>
                        <th>Merk Device</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                foreach ($dataReq as $row) {
                    echo "<tr>";
                    echo "<td>{$row['ID_SERVICE']}</td>";
                    echo "<td>{$row['NAMA_PELANGGAN']}</td>";
                    echo "<td>{$row['KONTAK_PELANGGAN']}</td>";
                    echo "<td>{$row['MERK_DEVICE']}</td>";
                    echo "<td>{$row['DESKRIPSI']}</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <button type="button" style="margin-left:90%;" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white"
            data-toggle="modal" data-target="#addRequestModal">
            Get Request
        </button>
        </div>
        <div class="modal fade" id="addRequestModal" tabindex="-1" role="dialog" aria-labelledby="addRequestModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form tambah request -->
                        <form id="addRequestForm" action="?add" method="POST">
                            <div class="form-group">
                                <label for="namaPelanggan">Nama:</label>
                                <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="kontakPelanggan">Kontak:</label>
                                <input type="text" class="form-control" id="kontakPelanggan" name="kontakPelanggan"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="merkDevice">Merk Device:</label>
                                <input type="text" class="form-control" id="merkDevice" name="merkDevice" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Keluhan:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                            </div>

                            <button type="submit"
                                class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white">Tambah Request</button>
                        </form>
                    </div>
                </div>
            </div>
    </main>
    <script>
    $(document).ready(function() {
        // Handle search button click event
        $("#searchBtn").click(function() {
            var searchText = $("#search").val().toLowerCase();
            // Loop through each row in the table and hide/show based on the search text
            $("tbody tr").each(function() {
                var rowText = $(this).text().toLowerCase();
                if (rowText.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
    </script>
</body>
<footer class="shadow max-auto px-8 bg-gray-800 mt-auto">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/"
                class="hover:underline">Kelompok 2</a>. All Rights Reserved.</span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <li><a href="#" class="hover:underline me-4 md:me-6">Naufal</a></li>
            <li><a href="#" class="hover:underline me-4 md:me-6">Ryan</a></li>
            <li><a href="#" class="hover:underline me-4 md:me-6">Arvin</a></li>
            <li><a href="#" class="hover:underline me-4 md:me-6">Hali</a></li>
            <li><a href="#" class="hover:underline">Alam</a></li>
        </ul>
    </div>
</footer>

</html>

<?php
?>
