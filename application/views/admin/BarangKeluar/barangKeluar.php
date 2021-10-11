  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Data Barang Keluar</h1>
          </div>
          <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-12">
                        <h4 class="title-form">Form</h4>
                      </div>

                      <div class="col-md-12">
                        <h3 class="sub-title-form">Form Input Barang Keluar</h3>
                      </div>
                    </div>
                    <hr>  
                  </div>
                  <div class="card-body">
                      <p>
                      <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#add_modal_brgKeluar">
                          Tambah Data
                        </button>
                      </p>
                    
                  </div>
                </div>
              </div>
          <!--  -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Pembelian Bahan</h4>
                    <div class="card-header-action">
                      <!-- <form>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search">
                          <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form> -->
                    </div>
                  </div>

                <div class="card-body p-3">
                  <div class="table-responsive table-invoice">
                  <table class="table table-striped" id="table_brgKeluar">
                  <thead>
                  <th>Tanggal</th>
                        <th>Merk</th>
                        <th>Style</th>
                        <th>Model</th>
                        <th>Jumlah</th>
                        <th>Customer</th>
                        <th>Keterangan Lain</th>
                        <th>Action</th>
                  </thead>
                    </table>
                  </div>
                </div>

                <!-- <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                        <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item disabled">
                          <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                      </ul>
                    </nav>
                  </div> -->

              </div>
            </div>
          </div>
        </section>
      </div>

          <!-- Modal Tambah Data -->

          <div class="modal fade" tabindex="-1" role="dialog" id="add_modal_brgKeluar">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Input Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form" action="" method="post" id="form_brgKeluar">
                <!-- Row -->
                  <div class="row ">
                    <div class="col">
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control datemask" placeholder="YYYY/MM/DD" name="tgl_brgKeluar">
                      </div>
                  </div>
                    <div class="col">
                      <div class="form-group">
                        <label>Merk</label>
                        <input type="text" class="form-control" autocomplete="" name="merk_brgKeluar">
                      </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label>Style</label>
                      <input type="text" class="form-control" autocomplete="" name="style_brgKeluar">
                      </div>
                  </div>
                </div>
                  <!-- End Row -->

                <!-- Row -->
                <div class="row ">
                    <div class="col">
                      <div class="form-group">
                        <label>Model</label>
                        <input type="text" class="form-control purchase-code" placeholder="ASDF-GHIJ-KLMN-OPQR" name="model_brgKeluar">
                      </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control invoice-input" name="jml_barangKeluar">
                      </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                       <label>Customer</label>
                      <input type="text" class="form-control invoice-input" name="customer_brgKeluar">
                      </div>
                  </div>
                </div>
                <!-- End Row -->

              <!--Row-->
              <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Keterangan Lain</label>
                        <textarea class="form-control" id="add_ket_brgKeluar" rows="3"></textarea>
                    </div>
                </div>
              </div>
                </form>
            </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="insert_brgKeluar">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Akhir Modal Tambah Data -->

     
     