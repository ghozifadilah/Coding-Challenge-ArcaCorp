<?php $this->load->view('layout/header');?>
        <h2 style="margin-top:0px">Pembayaran List</h2>
        
        
        
                <button type="button" onclick="resetModal()" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPembayaran">
               Tambah Pembayran Baru
                </button>
        <div class="row mt-2" style="margin-bottom: 10px">
            
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('pembayaran/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pembayaran'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered text-center" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Tanggal Dan Waktu</th>
                <th>Pembayaran</th>
                <th>Aksi</th>
            </tr><?php
            foreach ($pembayaran_data as $pembayaran)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pembayaran->timestamp ?></td>
			<td>Rp. <?php echo $pembayaran->pembayaran ?></td>
			<td style="text-align:center" width="400px">
                <a class="btn btn-primary" onclick="pembayaranDetail(<?=$pembayaran->ID?>)"> Detail </a>
                <a class="btn btn-primary" onclick="editPembayaran(<?=$pembayaran->ID?>)"> Ubah </a>
                <!-- if hak akses not admin -->
                <?php if($this->session->userdata('user_hak_akses') === 'admin') { 
                    echo '<a href="' . site_url('pembayaran/delete/' . $pembayaran->ID) . '" class="btn btn-danger" onclick="return confirm(\'Anda yakin ?\')"> Hapus </a>';
               } ?>

			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

 <!-- modal Tambah -->
<div class="modal fade" id="addPembayaran" tabindex="-1" aria-labelledby="addPembayaranLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="addPembayaranLabel">Tambah Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <!-- List Buruh -->
        <div class="row">
            <div class="col-md-6">
                <!-- option -->
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pilih Buruh</label>
                    <select class="form-control" id="selectedBuruh">
                        <?php foreach ($buruh_data as $item) { ?>
                            <option value="<?= $item->ID ?>"><?= $item->nama ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- end option -->
            </div>
            <div class="col-md-6">
              <a style="margin-top: 30px" class="btn btn-success" onclick="addBuruh('add')">Add Buruh</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                
                <div class="row">
                    <div class="col-md-3 text-center mt-2">
                       <h5>Pembayaran</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input onkeyup="checkPembayaran('add')" type="number" class="form-control" id="totalPembayaran">
                        </div>
                    </div>
                </div>

                <!-- buruh form added -->
                <div id="buruhForm"></div>
                <!-- End buruh form added -->
                <hr>
                <!-- list buruh check -->
                <div id="buruhCheck"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="simpanPembayaran()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- End Modal Tambah-->

 <!-- modal Edit -->
 <div class="modal fade" id="editPemabayaran" tabindex="-1" aria-labelledby="editPemabayaranLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="editPemabayaranLabel">Edit Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <!-- List Buruh -->
        <div class="row">
            <div class="col-md-6">
                <!-- option -->
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pilih Buruh</label>
                    <select class="form-control" id="selectedBuruhEdit">
                        <?php foreach ($buruh_data as $item) { ?>
                            <option value="<?= $item->ID ?>"><?= $item->nama ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- end option -->
            </div>
            <div class="col-md-6">
              <a style="margin-top: 30px" class="btn btn-success" onclick="addBuruh('edit')">Add Buruh</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                
                <div class="row">
                    <div class="col-md-3 text-center mt-2">
                       <h5>Pembayaran</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" onkeyup="checkPembayaran('edit')" class="form-control" id="totalPembayaranEdit">
                        </div>
                    </div>
                </div>

                <!-- buruh form added -->
                <div id="buruhFormEdit"></div>
                <!-- End buruh form added -->
                <hr>
                <!-- list buruh check -->
                <div id="buruhCheckEdit"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitEditPembayaran()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- End Modal Edit-->


 <!-- modal Edit -->
 <div class="modal fade" id="pembayaranModalDetail" tabindex="-1" aria-labelledby="pembayaranModalDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="pembayaranModalDetailLabel">Detail Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

       
        <div class="row">
            <div class="col-md-12">
                
                <div class="row">
                    <div class="col-md-12 mt-2">
                       <p>tanggal : <span id="tanggalPembayaranDetail"><strong>  </strong></span></p>
                       <p>Pembayaran : <span id="pembayaranDetail"><strong> Rp.0,- </strong></span></p>
                       <table class="table table-bordered text-center ">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Buruh</th>
                            <th scope="col">Persentase</th>
                            <th scope="col">Bonus</th>
                            </tr>
                        </thead>
                        <tbody id="tableDetail" >
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            </tr>  
                        </tbody>
                        </table>
                    </div>
                </div>

                <!-- buruh form added -->
                <div id="buruhFormEdit"></div>
                <!-- End buruh form added -->
                <hr>
                <!-- list buruh check -->
                <div id="buruhCheckEdit"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- End Modal Edit-->

    <?php $this->load->view('layout/footer');?>

    
<script>
    var IDBuruhAdded = [];
    var presentaseTotal = 0;

    var dataBonusEdit = [];
    var idPembayaran ='';

    // reset html modal saat modal edit atau tambah sebelum aktu=if
    function resetModal() {
        IDBuruhAdded = [];
        dataBonusEdit = [];
        idPembayaran ='';
        $('#buruhFormEdit').html('');
        $('#buruhCheckEdit').html('');
        $('#buruhForm').html('');
        $('#buruhCheck').html('');
    }

    function addBuruh(mode) {
    
        if (mode == 'add') {
            var selected = $("#selectedBuruh").val();
            var name = $("#selectedBuruh option:selected").text();
            var ID = selected;
            if (!IDBuruhAdded.includes(ID)) {
                var html = `
                <div class="row" id="buruh_${ID}">
                    <div class="col-md-3 text-center mt-2">
                        <h5>${name}</h5>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input onkeyup="checkPembayaran('add')" id="${ID}_buruh_form" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3 mt-2">
                        <h5>% Bonus</h5>
                    </div>
                </div>`;
                $("#buruhForm").append(html);
    
                html = `
                <div class="row mt-3" id="bonus_${ID}">
                    <div class="col-md-3 text-center mt-2">
                        <h5>${name}</h5>
                    </div>
                    <div class="col-md-3 mt-2">
                        <h5 id="${ID}_buruh_bonusText">Rp ........................... ,-</h5>
                        <input id="${ID}_buruh_formHidden" type="hidden" class="form-control">
                    </div>
                </div>`;
                $("#buruhCheck").append(html);
    
                IDBuruhAdded.push(ID);
            }
        }else{
            console.log('mode edit');
            var selected = $("#selectedBuruhEdit").val();
            var name = $("#selectedBuruh option:selected").text();
            var ID = selected;
            if (!IDBuruhAdded.includes(ID)) {
                var html = `
                <div class="row" id="buruh_${ID}">
                    <div class="col-md-3 text-center mt-2">
                        <h5>${name}</h5>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input onkeyup="checkPembayaran('edit')" id="${ID}_buruh_form" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3 mt-2">
                        <h5>% Bonus</h5>
                    </div>
                </div>`;
                $("#buruhFormEdit").append(html);
    
                html = `
                <div class="row mt-3" id="bonus_${ID}">
                    <div class="col-md-3 text-center mt-2">
                        <h5>${name}</h5>
                    </div>
                    <div class="col-md-3 mt-2">
                        <h5 id="${ID}_buruh_bonusText">Rp ........................... ,-</h5>
                        <input id="${ID}_buruh_formHidden" type="hidden" class="form-control">
                        <input id="${ID}_isEdit" value="false" type="hidden" class="form-control"> 
                    </div>
                </div>`;
                $("#buruhCheckEdit").append(html);
    
                IDBuruhAdded.push(ID);
            }
        }

    }

    function checkPembayaran(mode) {
        var totalPembayaran = 0;

        if (mode == 'add') {
            totalPembayaran = parseFloat($("#totalPembayaran").val());
        }else{
            totalPembayaran = parseFloat($("#totalPembayaranEdit").val());
        }

        if (isNaN(totalPembayaran) || totalPembayaran <= 0) {
            alert("Masukkan jumlah total pembayaran yang valid.");
            return;
        }

        var totalPersentase = 0;
        IDBuruhAdded.forEach(function(ID) {
            var persentase = parseFloat($(`#${ID}_buruh_form`).val());
            if (!isNaN(persentase)) {
                totalPersentase += persentase;
            }
        });

       
        if (totalPersentase > 100) {
            alert("pembagian bonusmasih salah");
            return;
        }

        IDBuruhAdded.forEach(function(ID) {
            var persentase = parseFloat($(`#${ID}_buruh_form`).val());
            var bonus = (totalPembayaran * persentase) / 100;
         

            if (isNaN(bonus)) {
                $(`#${ID}_buruh_bonusText`).text(`Rp 0 ,-`);
            }else{
                $(`#${ID}_buruh_bonusText`).text(`Rp ${bonus} ,-`);
                $(`#${ID}_buruh_formHidden`).val(bonus);
            }

           
        });

        presentaseTotal = totalPersentase;
    }

    function simpanPembayaran() {
        // Logika untuk menyimpan data ke dalam database

        var dataBonusBuruh = [];
        
        var countIDBuruhAdded = IDBuruhAdded.length;

        if (countIDBuruhAdded < 3 ) {
            alert("Buruh minimal 3 orang !");
            return;
        }

     
        if (presentaseTotal !== 100) {
            alert("Total persentase harus sama dengan 100%.");
            return;
        }

        IDBuruhAdded.forEach(function(ID) {
 
            var persentase = parseFloat($(`#${ID}_buruh_form`).val());
            var total = parseFloat($(`#${ID}_buruh_formHidden`).val());
            dataBonusBuruh.push({
                ID: ID,
                persentase: persentase,
                total: total
            }); 
            
        });
        console.log(dataBonusBuruh);

        var pembayaran = $('#totalPembayaran').val();

        $.ajax({
            url: '<?= site_url('pembayaran/savePembayaran') ?>',
            type: 'POST',
            data: {
                pembayaran: pembayaran,
                dataBonusBuruh: dataBonusBuruh
            },
            success: function(response) {
                alert(response);
                // window.location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });


    }


    function editPembayaran(ID) {
        resetModal();
        $('#editPemabayaran').modal('show');

        $.ajax({
            url: '<?= site_url('pembayaran/editPembayaran') ?>',
            type: 'GET',
            data: {
                ID: Number(ID)
            },
            success: function(response) {
               
                var data = JSON.parse(response);
                var bonusPembayaranCount = data.bonusPembayaranCount;
                dataBonusEdit = data.bonusPembayaran;
                $('#totalPembayaranEdit').val(data.pembayaran.pembayaran);
                presentaseTotal = 100;
                
            // foreach bonuspembayaran
                for (var i = 0; i < bonusPembayaranCount; i++) {

                    var idBuruh = data.bonusPembayaran[i].idBuruh;
                    if (!IDBuruhAdded.includes(idBuruh)) { 
                    var ID = data.bonusPembayaran[i].ID;
                    idPembayaran = data.bonusPembayaran[i].idPembayaran;
                    var Persentase = data.bonusPembayaran[i].Persentase;
                    var TotalPembayaran = data.bonusPembayaran[i].TotalPembayaran;
                    var nama = data.bonusPembayaran[i].nama;
                    var html = `
                    <div class="row" id="buruh_${idBuruh}">
                    <div class="col-md-3 text-center mt-2">
                        <h5>${nama}</h5>
                        </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input onkeyup="checkPembayaran('edit')" id="${idBuruh}_buruh_form" value="${Persentase}" type="number" class="form-control">
                                </div>
                            </div>
                           <div class="col-md-3 mt-2">
                            <h5>% Bonus</h5>
                        </div>
                    </div>`;


                    $("#buruhFormEdit").append(html);


                    html = `
                    <div class="row mt-3" id="bonus_${idBuruh}">
                        <div class="col-md-3 text-center mt-2">
                            <h5>${nama}</h5>
                        </div>
                        <div class="col-md-3 mt-2">
                            <h5 id="${idBuruh}_buruh_bonusText">Rp ${TotalPembayaran} ,-</h5>
                            <input id="${idBuruh}_buruh_formHidden" value="${TotalPembayaran}" type="hidden" class="form-control">
                            
                            <input id="${idBuruh}_isEdit" value="true" type="hidden" class="form-control"> 
                        </div>
                    </div>`;
                    $("#buruhCheckEdit").append(html);

                    IDBuruhAdded.push(idBuruh);
                 }
                }

 
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }


    function submitEditPembayaran() {
        // saveEditPembayaran

        var dataBonusBuruh = [];
        

        
        if (presentaseTotal !== 100) {
            alert("Total persentase harus sama dengan 100%.");
            return;
        }

        IDBuruhAdded.forEach(function(ID) {
 
            var persentase = parseFloat($(`#${ID}_buruh_form`).val());
            var total = parseFloat($(`#${ID}_buruh_formHidden`).val());
            dataBonusBuruh.push({
                ID: ID,
                persentase: persentase,
                total: total,
                isEdit : $(`#${ID}_isEdit`).val()
            }); 
            
        });
        console.log(dataBonusBuruh);

        var pembayaran = $('#totalPembayaranEdit').val();
      
     
        $.ajax({
            url: '<?= site_url('pembayaran/saveEditPembayaran') ?>',
            type: 'POST',
            data: {
                idPembayaran: idPembayaran,
                pembayaran: pembayaran,
                dataBonusBuruh: dataBonusBuruh,
                dataBonusEdit: dataBonusEdit
            },
            success: function(response) {
                alert(response);
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }

    function pembayaranDetail(ID) {

       $('#pembayaranModalDetail').modal('show');
       $.ajax({
            url: '<?= site_url('pembayaran/editPembayaran') ?>',
            type: 'GET',
            data: {
                ID: Number(ID)
            },
            success: function(response) {
               
                var data = JSON.parse(response);
                var bonusPembayaranCount = data.bonusPembayaranCount;
                var bonusPembayaran = data.bonusPembayaran;

                // table detail
                var html = "";
                var no = 1;
                for (var i = 0; i < bonusPembayaranCount; i++) {
                    var idBuruh = bonusPembayaran[i].idBuruh;
                    var idPembayaran = bonusPembayaran[i].idPembayaran;
                    var Persentase = bonusPembayaran[i].Persentase;
                    var TotalPembayaran = bonusPembayaran[i].TotalPembayaran;
                    var nama = bonusPembayaran[i].nama;
                    html += `
                    <tr>
                        <td>${no++}</td>
                        <td>${nama}</td>
                        <td>${Persentase} %</td>
                        <td>Rp.${TotalPembayaran}</td>
                    </tr>
                    `;
                }
                $("#tableDetail").html(html);
                $("#pembayaranDetail").html(data.pembayaran.pembayaran);
                $("#tanggalPembayaranDetail").html(data.pembayaran.timestamp);
 
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    }


</script>