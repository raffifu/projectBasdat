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
    <form action="." method="GET">
      <div class="input-group input-group-lg mb-5 mx-auto">
        <input type="text" class="form-control" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : ""  ?>" placeholder="Masukkan kata kunci">
        <div class="input-group-append">
          <button class="btn btn-dark" type="submit" id="button-addon2">Search</button>
        </div>
      </div>
    </form>
    <div class="tambah-data">
      <button type="button" data-toggle="modal" data-target="#tambahData" class="btn btn-dark btn-sm mb-2 mx-auto">+ Tambah</button>
    </div>
    <div class="content">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Jenis</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_GET['search']) ? ($_GET['search'] != "" ? True : False) : False) {
              $searchItem = $_GET['search'];
              $query = "
              SELECT kodeBarang,namaBarang,namaLokasi,jumlah,namaJenis FROM barang
              INNER JOIN lokasi
              ON barang.kodeLokasi = lokasi.kodeLokasi
              INNER JOIN jenis
              ON barang.kodeJenis = jenis.kodeJenis
              WHERE namaBarang LIKE '%{$searchItem}%'
            ";
              $startWith = 0;
            } else if (isset($_GET['p'])) {
              if (is_numeric($_GET['p']) && $_GET['p'] > 0) {
                $startWith = ($_GET['p'] - 1) * 10;
              } else {
                $startWith = 0;
              }
              $query = "
              SELECT kodeBarang,namaBarang,namaLokasi,jumlah,namaJenis FROM barang
              INNER JOIN lokasi
              ON barang.kodeLokasi = lokasi.kodeLokasi
              INNER JOIN jenis
              ON barang.kodeJenis = jenis.kodeJenis
              LIMIT 10 OFFSET $startWith
              ";
            } else {
              $startWith = 0;
              $query = "
              SELECT kodeBarang,namaBarang,namaLokasi,jumlah,namaJenis FROM barang
              INNER JOIN lokasi
              ON barang.kodeLokasi = lokasi.kodeLokasi
              INNER JOIN jenis
              ON barang.kodeJenis = jenis.kodeJenis
              LIMIT 10 OFFSET $startWith
              ";
            }
            $result = mysqli_query($db, $query);
            $startWith++;
            while ($data = mysqli_fetch_array($result)) {
              echo "
                  <tr id='barang-{$data['kodeBarang']}'>
                    <th scope='row'>{$startWith}</th>
                    <td>{$data['namaBarang']}</td>
                    <td>{$data['namaLokasi']}</td>
                    <td>{$data['namaJenis']}</td>
                    <td>{$data['jumlah']}</td>
                    <td>
                      <button type='button' id='" . "edit-{$data['kodeBarang']}" . "' class='edit btn btn-warning btn-sm'>Edit</button>
                      <button type='button' id='" . "delete-{$data['kodeBarang']}" . "' class='delete btn btn-danger btn-sm'>Delete</button>
                    </td>
                  </tr>
                ";
              $startWith++;
            }
            ?>
          </tbody>
        </table>
      </div>
      <nav>
        <ul class="pagination justify-content-center">
          <?php
          if (!isset($_GET['search']) || $_GET['search'] === "") {
            $query = "SELECT COUNT(*) as total FROM barang";
            $result = mysqli_query($db, $query);
            $resulArr = mysqli_fetch_assoc($result);
            $totalPage = ceil($resulArr['total'] / 10);
            for ($i = 1; $i <= $totalPage; $i++) {
              echo "<li class='page-item'><a class='page-link' href='?p={$i}'>{$i}</a></li>";
            }
          }
          ?>
        </ul>
      </nav>
    </div>
  </main>
  <!-- Pop Up tambah Data -->
  <div class="modal fade" id="tambahData" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id='tambahBarang'>
            <div class="form-group">
              <label for="namaBarang">Nama Barang</label>
              <input type="text" name="nama" class="form-control">
            </div>
            <div class="form-group">
              <label for="lokasiBarang">Lokasi</label>
              <select class="form-control" name="lokasi">
                <?php
                $queryLokasi = "SELECT * FROM lokasi";
                $resultLokasi = mysqli_query($db, $queryLokasi);
                while ($data = mysqli_fetch_array($resultLokasi)) {
                  echo "<option value=" . "{$data['kodeLokasi']}" . ">{$data['namaLokasi']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="row">
              <div class="col">
                <label for="jenisBarang">Jenis</label>
                <select class="form-control" name="jenis">
                  <?php
                  $queryJenis = "SELECT * FROM jenis";
                  $resultJenis = mysqli_query($db, $queryJenis);
                  while ($data = mysqli_fetch_array($resultJenis)) {
                    echo "<option value=" . "{$data['kodeJenis']}" . ">{$data['namaJenis']}</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col">
                <label for="jumlahBarang">Jumlah Barang</label>
                <input type="number" name="jumlah" class="form-control">
              </div>
            </div>
            <input type="hidden" name="tambah" value="tambah">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button id="simpan" type="button" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Pop Up edit data -->
  <div class="modal fade" id="updateData" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id='formUpdate'>
            <div class="form-group">
              <label for="namaBarang">Nama Barang</label>
              <input type="text" name="nama" class="form-control" id="namaBarang">
            </div>
            <div class="form-group">
              <label for="lokasiBarang">Lokasi</label>
              <select class="form-control" name="lokasi" id="lokasiBarang">
                <?php
                $queryLokasi = "SELECT * FROM lokasi";
                $resultLokasi = mysqli_query($db, $queryLokasi);
                while ($data = mysqli_fetch_array($resultLokasi)) {
                  echo "<option value=" . "{$data['kodeLokasi']}" . ">{$data['namaLokasi']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="row">
              <div class="col">
                <label for="jenisBarang">Jenis</label>
                <select class="form-control" name="jenis" id="jenisBarang">
                  <?php
                  $queryJenis = "SELECT * FROM jenis";
                  $resultJenis = mysqli_query($db, $queryJenis);
                  while ($data = mysqli_fetch_array($resultJenis)) {
                    echo "<option value=" . "{$data['kodeJenis']}" . ">{$data['namaJenis']}</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col">
                <label for="jumlahBarang">Jumlah Barang</label>
                <input type="number" name="jumlah" class="form-control" id="jumlahBarang">
              </div>
            </div>
            <input type="hidden" name="update" value="update">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button id="update" type="button" class="btn btn-primary">Update</button>
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
    $('.edit').click(function() {
      // get value from row table
      const id = this.id.split('-')[1];
      const value = $(`#barang-${id}`).children('td');
      const namaBarang = value[0].innerText;
      const lokasi = value[1].innerText;
      const jenis = value[2].innerText;
      const jumlah = value[3].innerText;
      // set value to modal update barang
      findOption(lokasi).setAttribute('selected', 'selected');
      findOption(jenis).setAttribute('selected', 'selected');
      $('#namaBarang').val(namaBarang);
      $('#jumlahBarang').val(jumlah);
      $('input[name="update"]').val(id);
      $('#updateData').modal('show');
    });

    $('#update').click(event => {
      const form = $('#formUpdate');
      const namaBarang = form.find('input[name="nama"]')[0].value;
      const jumlahBarang = form.find('input[name="jumlah"]')[0].value;
      console.log(form.serialize());
      if (namaBarang != "" && jumlahBarang != "") {
        $.ajax({
          type: 'POST',
          url: "./processData.php",
          data: form.serialize(),
          success: (data) => {
            // console.log(data);
            data = JSON.parse(data);
            if (data.status) {
              location.reload();
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error(errorThrown);
          }
        });
      }
    });

    const findOption = (text) => {
      let element;
      document.querySelectorAll('option').forEach(item => {
        // console.log(item.innerText);
        if (item.innerText == text) {
          element = item;
        }
      })
      return element || false;
    }

    $('.delete').click(function() {
      const id = this.id.split('-')[1];
      $.ajax({
        type: 'POST',
        url: "./processData.php",
        data: `delete=${id}`,
        success: (data) => {
          data = JSON.parse(data);
          if (data.status) {
            location.reload();
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error(errorThrown);
        }
      });
    });

    $.urlParam = function(name) {
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      return results == null ? 0 : (results[1] || 0);
    }

    const page = $.urlParam('p');
    if (page == 0 || isNaN(parseInt(page))) {
      $('a[href*="?p=1"]')[0].parentElement.classList.add('active')
    } else {
      $(`a[href*="?p=${page}"]`)[0].parentElement.classList.add('active')
    }

    $('#simpan').click(event => {
      const form = $('#tambahBarang');
      const namaBarang = form.find('input[name="nama"]')[0].value;
      const jumlahBarang = form.find('input[name="jumlah"]')[0].value;
      if (namaBarang != "" && jumlahBarang != "") {
        $.ajax({
          type: 'POST',
          url: "./processData.php",
          data: form.serialize(),
          success: (data) => {
            data = JSON.parse(data);
            if (data.status) {
              $("#tambahData").modal('hide');
              location.reload();
            }
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