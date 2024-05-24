<?php

$hasil = "";
$info = "";

if(isset($_POST['submit'])) {

    if(!empty($_POST['nama_pelanggan']) && !empty($_POST['items']) && !empty($_POST['quantities']) && !empty($_POST['prices'])) {
        $nama_pelanggan = htmlspecialchars($_POST['nama_pelanggan']);
        $items = $_POST['items'];
        $quantities = $_POST['quantities'];
        $prices = $_POST['prices'];

        function hitungTotalBiaya($items, $quantities, $prices)
        {
            $total_biaya = 0;
            for($i = 0; $i < count($items); $i++) {
                $total_biaya += $quantities[$i] * $prices[$i];
            }
            return $total_biaya;
        }

        $hasil = hitungTotalBiaya($items, $quantities, $prices);

        if($hasil > 0) {
            $info = "Pelanggan: $nama_pelanggan<br>";
            $info .= "Detail Pembelian:<br>";
            for($i = 0; $i < count($items); $i++) {
                $info .= "{$items[$i]} - {$quantities[$i]} x Rp. " . number_format($prices[$i], 0, ',', '.') . "<br>";
            }
            $info .= "Total Biaya: Rp. " . number_format($hasil, 0, ',', '.') . ",-";
        } else {
            $info = "Input tidak valid";
        }
    } else {
        $info = "Semua input harus diisi";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Form Kasir</title>
    <style>
        body {
            background: #f2f2f2;
            font-family: sans-serif;
        }

        .input-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .input-container .h21 {
            margin-right: 20px;
            flex: 0 0 auto; 
        }

        .input-container .bil2 {
            flex: 1; 
            margin-left: 10px; 
            width: auto; 
        }

        .kalkulator {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 10px 20px 0px #d1d1d1;
            background-color: white;
        }

        .bil1,
        .bil2,
        .opt {
            width: 100%;
            border: none;
            font-size: 16pt;
            border-radius: 5px;
            padding: 10px;
            margin: 5px;
        }

        .tombol {
            background: lightgreen;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: rgb(29, 27, 27);
            font-size: 15pt;
            cursor: pointer;
            margin-top: 20px;
        }

        .judul {
            text-align: center;
            color: black;
            font-weight: normal;
            margin-top: 50px;
            font-size: 3rem;
        }

        .hasil-container {
            text-align: center;
        }

        .info {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .input-list {
            margin-top: 20px;
        }

        .input-list .item-row {
            display: flex;
            margin-bottom: 10px;
        }

        .input-list .item-row input {
            margin-right: 10px;
            flex: 1;
        }
    </style>
</head>
<body>
<h2 class="judul">Form Kasir</h2>
<div class="kalkulator">
    <form method="post" action="">
        <div class="input-container">
            <h2 class="h21">Nama Pelanggan:</h2>
            <input type="text" name="nama_pelanggan" class="bil1" autocomplete="off" placeholder="Masukkan nama pelanggan" required>
        </div>
        <div class="input-list">
            <div class="item-row">
                <input type="text" name="items[]" placeholder="Nama Barang" required>
                <input type="number" name="quantities[]" placeholder="Jumlah" required min="1">
                <input type="number" name="prices[]" placeholder="Harga Satuan" required min="1">
            </div>
            <div class="item-row">
                <input type="text" name="items[]" placeholder="Nama Barang">
                <input type="number" name="quantities[]" placeholder="Jumlah" min="1">
                <input type="number" name="prices[]" placeholder="Harga Satuan" min="1">
            </div>
            <div class="item-row">
                <input type="text" name="items[]" placeholder="Nama Barang">
                <input type="number" name="quantities[]" placeholder="Jumlah" min="1">
                <input type="number" name="prices[]" placeholder="Harga Satuan" min="1">
            </div>
        </div>
        <div class="input-container">
            <input type="submit" name="submit" value="Submit" class="tombol">
        </div>
    </form>
    <?php if($info != "") { ?>
    <div class="hasil-container">
        <p class="info"><?php echo $info; ?></p>
    </div>
    <?php } ?>
</div>
</body>
</html>
