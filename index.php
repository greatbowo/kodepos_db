<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Kodepos Indonesia</title>
    <style>
       body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }

        input {
            padding: 10px;
            width: 70%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pencarian Kodepos Indonesia</h1>
        <form action="" method="post">
            <label for="search">Masukkan Kodepos atau Daerah:</label>
            <input type="text" id="search" name="search" required>
            <button type="submit">Cari</button>
        </form>

        <?php
        
        
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db   = 'kodepos_db';

        $conn = new mysqli($host, $user, $pass, $db);

        
        if ($conn->connect_error) {
         die("Koneksi gagal: " . $conn->connect_error);
        }

        
        $search = $_POST['search'];

        
        $query = "SELECT * FROM kodepos_indonesia WHERE kodepos LIKE '%$search%' OR keldesa LIKE '%$search%' OR kecamatan LIKE '%$search%' OR kotakab LIKE '%$search%' OR provinsi LIKE '%$search%'";
        $result = $conn->query($query);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            

            if ($result->num_rows > 0) {
                echo "<h2>Hasil Pencarian:</h2>";
                echo "<table>
                        <tr>                            
                            <th>Kodepos</th>
                            <th>Kelurahan/Desa</th>
                            <th>Kecamatan</th>
                            <th>Kota/Kabupaten</th>
                            <th>Provinsi</th>
                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>                            
                            <td>{$row['kodepos']}</td>
                            <td>{$row['keldesa']}</td>
                            <td>{$row['kecamatan']}</td>
                            <td>{$row['kotakab']}</td>
                            <td>{$row['provinsi']}</td>
                          </tr>";
                }

                echo "</table>";
            } else {
                echo "<h2>Tidak ada hasil yang ditemukan</h2>";
            }

            
        }
        ?>
    </div>
</body>
</html>
