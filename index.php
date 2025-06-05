<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
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
            overflow-y: auto; /* Allow scrolling if content is too long */
        }

        /* Custom animation for title */
        @keyframes pulse-gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient-pulse {
            animation: pulse-gradient 5s ease infinite;
            background-size: 200% 200%;
        }

        /* Modal transitions */
        .modal-fade-enter-active, .modal-fade-leave-active {
            transition: opacity 0.3s ease-out;
        }
        .modal-fade-enter-from, .modal-fade-leave-to {
            opacity: 0;
        }
        .modal-scale-enter-active, .modal-scale-leave-active {
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .modal-scale-enter-from, .modal-scale-leave-to {
            transform: scale(0.9);
            opacity: 0;
        }

        /* Notification slide-in/out */
        .notification-enter-active, .notification-leave-active {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .notification-enter-from, .notification-leave-to {
            transform: translateY(-50px);
            opacity: 0;
        }

        /* Scrollbar styling for cool tables */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="antialiased">

<div class="relative z-10 w-full max-w-6xl bg-white p-10 rounded-3xl shadow-2xl overflow-hidden backdrop-blur-sm bg-opacity-90 border border-gray-100">
    <h1 class="text-5xl font-extrabold text-center mb-10 text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-purple-600 to-pink-500 animate-gradient-pulse">
        Data Mahasiswa Politeknik Hasnur
    </h1>

    <?php
    session_start(); // Start session to display messages
    include 'koneksi.php'; // Include koneksi.php
    ?>

    <?php if (isset($_SESSION['message'])): ?>
        <?php
        $message_type = $_SESSION['message_type'] ?? 'info';
        $message_class = '';
        $icon_class = '';
        if ($message_type == 'success') {
            $message_class = 'bg-green-100 border border-green-400 text-green-700';
            $icon_class = 'fas fa-check-circle';
        } elseif ($message_type == 'error') {
            $message_class = 'bg-red-100 border border-red-400 text-red-700';
            $icon_class = 'fas fa-times-circle';
        } else {
            $message_class = 'bg-blue-100 border border-blue-400 text-blue-700';
            $icon_class = 'fas fa-info-circle';
        }
        ?>
        <div id="notification-message" class="<?php echo $message_class; ?> px-6 py-4 rounded-lg relative mb-6 flex items-center justify-between shadow-md notification-enter-from transition-all duration-500 ease-out">
            <div class="flex items-center">
                <i class="<?php echo $icon_class; ?> text-2xl mr-4"></i>
                <span class="font-medium text-lg"><?php echo htmlspecialchars($_SESSION['message']); ?></span>
            </div>
            <button type="button" class="text-xl text-gray-500 hover:text-gray-700 transition-colors duration-200" onclick="document.getElementById('notification-message').classList.add('notification-leave-to'); setTimeout(() => { document.getElementById('notification-message').remove(); }, 400);">
                <i class="fas fa-times-circle"></i>
            </button>
        </div>
        <?php
        // Clear session messages after displaying
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
        <script>
            // Automatically hide notification after 5 seconds
            setTimeout(() => {
                const notification = document.getElementById('notification-message');
                if (notification) {
                    notification.classList.add('notification-leave-to'); // Add class for exit animation
                    setTimeout(() => {
                        notification.remove(); // Remove from DOM after animation
                    }, 400); // Match animation duration
                }
            }, 5000); // 5 seconds
        </script>
    <?php endif; ?>


    <div class="flex flex-col md:flex-row justify-between items-center mb-8 space-y-4 md:space-y-0 md:space-x-4">
        <a href="form-input.php" class="w-full md:w-auto inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 ease-in-out transform hover:scale-105 shadow-xl group">
            <i class="fas fa-user-plus mr-3 text-xl group-hover:rotate-6 transition-transform"></i> Tambah Mahasiswa Baru
        </a>

        <form method="GET" action="index.php" class="relative w-full md:w-96">
            <input type="text" name="search_nim" placeholder="Cari NIM atau Nama..."
                   class="shadow-inner appearance-none border border-gray-300 rounded-xl w-full py-3 px-5 pr-12 text-gray-700 leading-tight focus:outline-none focus:ring-3 focus:ring-blue-400 focus:border-blue-400 transition duration-200 ease-in-out"
                   value="<?php echo htmlspecialchars($_GET['search_nim'] ?? ''); ?>">
            <button type="submit" class="absolute right-0 top-0 h-full w-12 flex items-center justify-center text-gray-400 hover:text-gray-600 transition-colors duration-200 rounded-r-xl">
                <i class="fas fa-search"></i>
            </button>
            <?php if (isset($_GET['search_nim']) && $_GET['search_nim'] != '') : ?>
                <a href="index.php" class="absolute right-12 top-0 h-full flex items-center px-2 text-gray-400 hover:text-red-600 transition-colors duration-200" title="Reset Pencarian">
                    <i class="fas fa-times-circle text-lg"></i>
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="overflow-x-auto shadow-2xl rounded-2xl border border-gray-200">
        <table class="min-w-full leading-normal border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-blue-700 to-indigo-800 text-white shadow-lg">
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider rounded-tl-2xl">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">NIM</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">NAMA</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">GENDER</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">JURUSAN</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider">ALAMAT</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider rounded-tr-2xl">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Tambahkan pengecekan koneksi
                if (!$koneksi) {
                    // Jika koneksi gagal, tampilkan pesan dan keluar
                    echo "<tr><td colspan='7' class='px-6 py-4 text-center text-red-600 text-lg font-medium'>Error: Koneksi database gagal!</td></tr>";
                } else {
                    $search_query = $_GET['search_nim'] ?? ''; // Mengubah nama variabel agar lebih generik

                    $sql = "SELECT * FROM mahasiswa";
                    $params = [];
                    $types = '';

                    if (!empty($search_query)) {
                        $sql .= " WHERE nim LIKE ? OR nama LIKE ?";
                        $params[] = '%' . $search_query . '%';
                        $params[] = '%' . $search_query . '%';
                        $types = 'ss';
                    }
                    $sql .= " ORDER BY nim ASC";

                    $stmt = mysqli_prepare($koneksi, $sql);

                    if ($stmt) {
                        if (!empty($params)) {
                            mysqli_stmt_bind_param($stmt, $types, ...$params);
                        }
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        $no = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $jenis_kelamin_display = ($row['jenis_kelamin'] == 'P') ? 'Perempuan' : 'Laki-laki';
                                ?>
                                <tr class='bg-white border-b border-gray-100 hover:bg-blue-50 transition duration-200 ease-in-out transform hover:scale-[1.01] hover:shadow-lg'>
                                    <td class='px-6 py-4 text-sm text-gray-800'><?php echo $no++; ?></td>
                                    <td class='px-6 py-4 text-sm text-gray-800 font-semibold'><?php echo htmlspecialchars($row['nim']); ?></td>
                                    <td class='px-6 py-4 text-sm text-gray-800'><?php echo htmlspecialchars($row['nama']); ?></td>
                                    <td class='px-6 py-4 text-sm text-gray-800'><?php echo htmlspecialchars($jenis_kelamin_display); ?></td>
                                    <td class='px-6 py-4 text-sm text-gray-800'><?php echo htmlspecialchars($row['jurusan']); ?></td>
                                    <td class='px-6 py-4 text-sm text-gray-800'><?php echo htmlspecialchars($row['alamat']); ?></td>
                                    <td class='px-6 py-4 text-sm text-gray-800 whitespace-nowrap'>
                                        <div class='flex space-x-2'>
                                            <a href='form-edit.php?id=<?php echo $row['id_mhs']; ?>' class='bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-xs transition duration-150 ease-in-out transform hover:scale-110 shadow-md' title='Edit'>
                                                <i class='fas fa-edit mr-1'></i> Edit
                                            </a>
                                            <button data-mahasiswa-id='<?php echo $row['id_mhs']; ?>' data-mahasiswa-nama='<?php echo htmlspecialchars($row['nama']); ?>' data-mahasiswa-nim='<?php echo htmlspecialchars($row['nim']); ?>' class='delete-btn bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg text-xs transition duration-150 ease-in-out transform hover:scale-110 shadow-md' title='Hapus'>
                                                <i class='fas fa-trash-alt mr-1'></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='7' class='px-6 py-4 text-center text-gray-600 text-lg font-medium'>Tidak ada data mahasiswa ditemukan.</td></tr>";
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "<tr><td colspan='7' class='px-6 py-4 text-center text-red-600 text-lg font-medium'>Error mempersiapkan query: " . mysqli_error($koneksi) . "</td></tr>";
                    }
                    mysqli_close($koneksi);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4 z-50 hidden modal-fade-enter-from">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-sm relative text-center modal-scale-enter-from">
        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
            <i class="fas fa-exclamation-triangle text-red-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-3">Konfirmasi Hapus Data</h3>
        <p class="text-base text-gray-600 mb-8">
            Apakah Anda yakin ingin menghapus data mahasiswa <strong id="modalMahasiswaNama"></strong> (<strong id="modalMahasiswaNim"></strong>)? Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="flex justify-center space-x-4">
            <button id="deleteConfirmButton" type="button" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-7 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 ease-in-out transform hover:scale-105 shadow-lg">
                <i class="fas fa-trash-alt mr-2"></i>YA, HAPUS!
            </button>
            <button id="deleteCancelButton" type="button" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-7 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150 ease-in-out transform hover:scale-105 shadow-lg">
                <i class="fas fa-times-circle mr-2"></i>BATAL
            </button>
        </div>
    </div>
</div>

<input type="hidden" id="deleteMahasiswaId">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('deleteModal');
        const deleteConfirmButton = document.getElementById('deleteConfirmButton');
        const deleteCancelButton = document.getElementById('deleteCancelButton');
        const deleteMahasiswaIdInput = document.getElementById('deleteMahasiswaId');
        const modalMahasiswaNama = document.getElementById('modalMahasiswaNama');
        const modalMahasiswaNim = document.getElementById('modalMahasiswaNim');

        // Add event listeners to all delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const mahasiswaId = this.dataset.mahasiswaId;
                const mahasiswaNama = this.dataset.mahasiswaNama;
                const mahasiswaNim = this.dataset.mahasiswaNim;

                deleteMahasiswaIdInput.value = mahasiswaId;
                modalMahasiswaNama.textContent = mahasiswaNama;
                modalMahasiswaNim.textContent = mahasiswaNim;

                // Show modal with animation
                deleteModal.classList.remove('hidden');
                setTimeout(() => {
                    deleteModal.classList.remove('modal-fade-enter-from');
                    deleteModal.querySelector('.modal-scale-enter-from').classList.remove('modal-scale-enter-from');
                }, 10); // Small delay to ensure display before transition
            });
        });

        // Event listener for "Batal" button in modal
        deleteCancelButton.addEventListener('click', function() {
            // Hide modal with animation
            deleteModal.classList.add('modal-fade-leave-to');
            deleteModal.querySelector('.modal-scale-enter-from').classList.add('modal-scale-leave-to'); // Add for internal content fade-out
            setTimeout(() => {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('modal-fade-leave-to'); // Reset for next show
                deleteModal.querySelector('.modal-scale-enter-from').classList.remove('modal-scale-leave-to'); // Reset for next show
                deleteModal.querySelector('.modal-scale-enter-from').classList.add('modal-scale-enter-from'); // Prepare for next show
            }, 300); // Match CSS transition duration
        });

        // Event listener for "YA, HAPUS!" button in modal
        deleteConfirmButton.addEventListener('click', function() {
            const mahasiswaIdToDelete = deleteMahasiswaIdInput.value;
            window.location.href = 'delete.php?id_mhs=' + mahasiswaIdToDelete;
            // Modal will hide due to page reload after deletion
        });

        // Close modal if clicking outside the modal content
        deleteModal.addEventListener('click', function(event) {
            // Check if the click occurred directly on the backdrop (not on the modal content itself)
            if (event.target === deleteModal) {
                deleteCancelButton.click(); // Simulate clicking the cancel button
            }
        });

        // Close modal on Escape key press
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                deleteCancelButton.click(); // Simulate clicking the cancel button
            }
        });

        // Initial check for notification to ensure it starts with animation
        const notification = document.getElementById('notification-message');
        if (notification) {
            setTimeout(() => {
                notification.classList.remove('notification-enter-from');
            }, 50); // Small delay to apply initial hidden state then transition
        }
    });
</script>
</body>
</html>