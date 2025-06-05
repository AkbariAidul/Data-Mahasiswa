<?php
session_start(); // Start session to display messages
include "koneksi.php";

// Tambahkan pengecekan koneksi
if (!$koneksi) {
    $_SESSION['message'] = "Koneksi database gagal: " . mysqli_connect_error();
    $_SESSION['message_type'] = "error";
    header("location:index.php");
    exit();
}

// Pastikan parameter 'id' ada di URL
$id_mhs = $_GET['id'] ?? null;
if (!$id_mhs) {
    $_SESSION['message'] = "ID mahasiswa tidak ditemukan.";
    $_SESSION['message_type'] = "error";
    header("location:index.php");
    exit();
}

// Gunakan prepared statement untuk mengambil data
$query_select = "SELECT * FROM mahasiswa WHERE id_mhs = ?";
$stmt_select = mysqli_prepare($koneksi, $query_select);
mysqli_stmt_bind_param($stmt_select, "i", $id_mhs);
mysqli_stmt_execute($stmt_select);
$result = mysqli_stmt_get_result($stmt_select);

// Pengecekan apakah query berhasil dan data ditemukan
if (!$result || mysqli_num_rows($result) == 0) {
    $_SESSION['message'] = "Data mahasiswa tidak ditemukan atau query gagal: " . mysqli_error($koneksi);
    $_SESSION['message_type'] = "error";
    header("location:index.php");
    exit();
}

$row = mysqli_fetch_array($result);
mysqli_stmt_close($stmt_select);

// membuat array dinamis untuk pilihan jurusan
$jurusan_options = array(
    'D3 TEKNIK INFORMATIKA', 'D3 TEKNIK OTOMOTIF', 'D4 TEKNOLOGI REKAYASA MULTIMEDIA',
    'D3 BUDIDAYA TANAMAN PERKEBUNAN', 'D4 BISNIS DIGITAL',
    'D4 MANAJEMEN PEMASARAN INTERNASIONAL', 'D4 AKUNTANSI BISNIS DIGITAL'
);

// function set radio button
function active_radio_button($value,$input) {
    $result= $value==$input?'checked':'';
    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa Keren</title>
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
            <i class="fas fa-edit mr-3"></i>Edit Data Mahasiswa
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

        <form method="post" action="edit.php" class="space-y-6">
            <input type="hidden" value="<?php echo htmlspecialchars($row['id_mhs']); ?>" name="id_mhs">

            <div>
                <label for="nim" class="block text-gray-700 text-sm font-semibold mb-2">NIM:</label>
                <input type="text" id="nim" name="nim" value="<?php echo htmlspecialchars($row['nim']); ?>" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" required>
            </div>
            <div>
                <label for="nama" class="block text-gray-700 text-sm font-semibold mb-2">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Jenis Kelamin:</label>
                <div class="flex items-center space-x-8">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="L" class="form-radio h-5 w-5 text-blue-600 focus:ring-blue-500 transition-colors duration-200" <?php echo active_radio_button("L", $row['jenis_kelamin'])?> required>
                        <span class="ml-2 text-gray-700 font-medium">Laki-laki</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="P" class="form-radio h-5 w-5 text-pink-600 focus:ring-pink-500 transition-colors duration-200" <?php echo active_radio_button("P", $row['jenis_kelamin'])?>>
                        <span class="ml-2 text-gray-700 font-medium">Perempuan</span>
                    </label>
                </div>
            </div>
            <div>
                <label for="jurusan" class="block text-gray-700 text-sm font-semibold mb-2">Jurusan:</label>
                <select id="jurusan" name="jurusan" class="shadow-sm border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out" required>
                    <?php
                    foreach ($jurusan_options as $j) {
                        echo "<option value='" . htmlspecialchars($j) . "' ";
                        echo $row['jurusan']==$j?'selected="selected"':'';
                        echo ">" . htmlspecialchars($j) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="alamat" class="block text-gray-700 text-sm font-semibold mb-2">Alamat:</label>
                <input value="<?php echo htmlspecialchars($row['alamat']);?>" type="text" id="alamat" name="alamat" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            </div>
            <div class="flex justify-end space-x-3 mt-8">
                <button type="submit" value="simpan" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-7 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out transform hover:scale-105 shadow-lg">
                    <i class="fas fa-sync-alt mr-2"></i>UPDATE DATA
                </button>
                <a href="index.php" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-7 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150 ease-in-out transform hover:scale-105 shadow-lg">
                    <i class="fas fa-times-circle mr-2"></i>BATAL
                </a>
            </div>
        </form>
    </div>
    <?php mysqli_close($koneksi); // Tutup koneksi setelah selesai ?>
</body>
</html>