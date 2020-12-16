<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Blasout 2021 Event TO terbesar di Klaten">
  <meta name="theme-color" content="#db0000" />
  <title>Project Basis Data</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<link rel="stylesheet" href="./assets/style.css">

<body class="container">
  <header class="header"></header>
  <main>
    <div class="input-group input-group-lg mb-5 mx-auto">
      <input type="text" class="form-control" placeholder="Masukkan kata kunci">
      <div class="input-group-append">
        <button class="btn btn-dark" type="button" id="button-addon2">Search</button>
      </div>
    </div>
    <div class="tambah-data">
      <button type="button" data-toggle="modal" data-target="#tambahData" class="btn btn-dark btn-sm mb-2 mx-auto">+ Tambah</button>
    </div>
    <div class="content">
      <table class="table table-striped table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Jenis</th>
            <th scope="col">Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "
              SELECT nama_barang,nama_lokasi,jumlah,nama_jenis FROM tb_barang
              INNER JOIN tb_lokasi
              ON tb_barang.kode_lokasi = tb_lokasi.kode_lokasi
              INNER JOIN tb_jenis
              ON tb_barang.kode_jenis = tb_jenis.kode_jenis
              ";
          $result = mysqli_query($db, $query);
          $i = 1;
          while ($data = mysqli_fetch_array($result)) {
            echo "
                  <tr>
                    <th scope='row'>{$i}</th>
                    <td>{$data['nama_barang']}</td>
                    <td>{$data['nama_lokasi']}</td>
                    <td>{$data['nama_jenis']}</td>
                    <td>{$data['jumlah']}</td>
                  </tr>
                ";
            $i++;
          }
          ?>
        </tbody>
      </table>
      <nav>
        <ul class="pagination justify-content-center">
          <li class="page-item"><a class="page-link bg-dark text-white" href="#">1</a></li>
          <li class="page-item"><a class="page-link bg-dark text-white" href="#">2</a></li>
          <li class="page-item"><a class="page-link bg-dark text-white" href="#">3</a></li>
        </ul>
      </nav>
    </div>
  </main>
  <!-- Pop Up -->
  <div class="modal fade" id="tambahData" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id='tambahBarang'>
            <div class="form-group">
              <label for="namaBarang">Nama Barang</label>
              <input type="text" name="nama" class="form-control" id="namaBarang">
            </div>
            <div class="form-group">
              <label for="lokasiBarang">Lokasi</label>
              <select class="form-control" name="lokasi" id="lokasiBarang">
                <?php
                $queryLokasi = "SELECT * FROM tb_lokasi";
                $resultLokasi = mysqli_query($db, $queryLokasi);
                while ($data = mysqli_fetch_array($resultLokasi)) {
                  echo "<option value=" . "{$data['kode_lokasi']}" . ">{$data['nama_lokasi']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="row">
              <div class="col">
                <label for="jenisBarang">Jenis</label>
                <select class="form-control" name="jenis" id="jenisBarang">
                  <?php
                  $queryJenis = "SELECT * FROM tb_jenis";
                  $resultJenis = mysqli_query($db, $queryJenis);
                  while ($data = mysqli_fetch_array($resultJenis)) {
                    echo "<option value=" . "{$data['kode_jenis']}" . ">{$data['nama_jenis']}</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col">
                <label for="jumlahBarang">Jumlah Barang</label>
                <input type="number" name="jumlah" class="form-control" id="jumlahBarang">
              </div>
            </div>
            <input type="hidden" name="submit" value="submit">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button id="simpan" type="button" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <footer>

  </footer>

  <!-- Script -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  <script>
    $('#simpan').click(event => {
      const form = $('#tambahBarang');
      const namaBarang = form.find('input[name="nama"]')[0].value;
      const jumlahBarang = form.find('input[name="jumlah"]')[0].value;
      if (namaBarang != "" && jumlahBarang != "") {
        $.ajax({
          type: 'POST',
          url: "./tambahdata.php",
          data: form.serialize(),
          dataType: 'JSON',
          success: (data) => {
            console.log(data);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error(errorThrown);
          }
        });
      }
    })
  </script>
</body>

</html>