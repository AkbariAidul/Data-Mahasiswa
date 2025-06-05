<?php
session_start(); // Start session to display messages
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Mahasiswa Keren</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f2fe, #e3f2fd, #bbdefb); /* Subtle gradient background */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
    </style>
</head>
<body class="antialiased">

    <div class="container mx-auto max-w-lg bg-white p-8 rounded-2xl shadow-2xl my-8 border border-gray-100 transform transition-all duration-300 ease-in-out hover:scale-[1.01]">
        <h2 class="text-4xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 animate-pulse">
            <i class="fas fa-user-plus mr-3"></i>Input Data Mahasiswa
        </h2>

        <?php
        // Display error messages from session
        if (isset($_SESSION['message'])) {
            $message_type = $_SESSION['message_type'] ?? 'info';
            $message_class = '';
            $icon_class = '';
            if ($message_type == 'error') {
                $message_class = 'bg-red-100 border border-red-400 text-red-700';
                $icon_class = 'fas fa-times-circle';
            }
            echo '<div class="' . $message_class . ' px-4 py-3 rounded-lg relative mb-6 flex items-center shadow-md">';
            echo '<i class="' . $icon_class . ' text-xl mr-3"></i>';
            echo '<strong class="font-bold mr-1">Error!</strong>';
            echo '<span class="block sm:inline"> ' . htmlspecialchars($_SESSION['message']) . '</span>';
            echo '<button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-red-500 hover:text-red-700 transition-colors duration-200" onclick="this.parentElement.remove();"><i class="fas fa-times-circle"></i></button>';
            echo '</div>';
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <form method="post" action="simpan.php" class="space-y-6">
            <div>
                <label for="nim" class="block text-gray-700 text-sm font-semibold mb-2">NIM:</label>
                <input type="text" id="nim" name="nim" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" required>
            </div>
            <div>
                <label for="nama" class="block text-gray-700 text-sm font-semibold mb-2">Nama:</label>
                <input type="text" id="nama" name="nama" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Jenis Kelamin:</label>
                <div class="flex items-center space-x-8">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="L" class="form-radio h-5 w-5 text-blue-600 focus:ring-blue-500 transition-colors duration-200" required>
                        <span class="ml-2 text-gray-700 font-medium">Laki-laki</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="P" class="form-radio h-5 w-5 text-pink-600 focus:ring-pink-500 transition-colors duration-200">
                        <span class="ml-2 text-gray-700 font-medium">Perempuan</span>
                    </label>
                </div>
            </div>
            <div>
                <label for="jurusan" class="block text-gray-700 text-sm font-semibold mb-2">Jurusan:</label>
                <select id="jurusan" name="jurusan" class="shadow-sm border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" required>
                    <option value="">--PILIH JURUSAN--</option>
                    <option value="D3 TEKNIK INFORMATIKA">D3 TEKNIK INFORMATIKA</option>
                    <option value="D3 TEKNIK OTOMOTIF">D3 TEKNIK OTOMOTIF</option>
                    <option value="D4 TEKNOLOGI REKAYASA MULTIMEDIA">D4 TEKNOLOGI REKAYASA MULTIMEDIA</option>
                    <option value="D3 BUDIDAYA TANAMAN PERKEBUNAN">D3 BUDIDAYA TANAMAN PERKEBUNAN</option>
                    <option value="D4 BISNIS DIGITAL">D4 BISNIS DIGITAL</option>
                    <option value="D4 MANAJEMEN PEMASARAN INTERNASIONAL">D4 MANAJEMEN PEMASARAN INTERNASIONAL</option>
                    <option value="D4 AKUNTANSI BISNIS DIGITAL">D4 AKUNTANSI BISNIS DIGITAL</option>
                </select>
            </div>
            <div>
                <label for="alamat" class="block text-gray-700 text-sm font-semibold mb-2">Alamat:</label>
                <input type="text" id="alamat" name="alamat" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            </div>
            <div class="flex justify-end space-x-3 mt-8">
                <button type="submit" value="simpan" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-7 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out transform hover:scale-105 shadow-lg">
                    <i class="fas fa-save mr-2"></i>SIMPAN DATA
                </button>
                <a href="index.php" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-7 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150 ease-in-out transform hover:scale-105 shadow-lg">
                    <i class="fas fa-times-circle mr-2"></i>BATAL
                </a>
            </div>
        </form>
    </div>
</body>
</html>