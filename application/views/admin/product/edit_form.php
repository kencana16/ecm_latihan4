<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view("admin/_partials/head.php") ?>
    </head>
    <body class="sb-nav-fixed">
        <?php $this->load->view("admin/_partials/navbar.php") ?>
        <div id="layoutSidenav">
            <?php $this->load->view("admin/_partials/sidebar.php") ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <?php $this->load->view("admin/_partials/breadcrumb.php") ?>
                        <!-- Content -->
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                            <?php endif; ?>

                            <!-- Card  -->
                            <div class="card mb-3">
                                <div class="card-header">

                                    <a href="<?php echo site_url('admin/products/') ?>"><i class="fas fa-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                                <div class="card-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                    <!-- Note: atribut action dikosongkan, artinya action-nya akan diproses 
                                        oleh controller tempat vuew ini digunakan. Yakni index.php/admin/products/edit/ID --->

                                        <input type="hidden" name="id" value="<?php echo $product->produk_id?>" />

                                        <div class="form-group">
                                            <label for="nama">Nama*</label>
                                            <input class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>"
                                            type="text" name="nama" placeholder="Nama Produk" value="<?php echo $product->produk_nama ?>" />
                                            <div class="invalid-feedback">
                                                <?php echo form_error('nama') ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="harga">harga*</label>
                                            <input class="form-control <?php echo form_error('harga') ? 'is-invalid':'' ?>"
                                            type="number" name="harga" min="0" placeholder="Harga Produk" value="<?php echo $product->produk_harga ?>" />
                                            <div class="invalid-feedback">
                                                <?php echo form_error('harga') ?>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="image">Photo</label>
                                            <input class="form-control-file <?php echo form_error('image') ? 'is-invalid':'' ?>"
                                            type="file" name="image" />
                                            <input type="hidden" name="gambar_lama" value="<?php echo $product->produk_image ?>" />
                                            <div class="invalid-feedback">
                                                <?php echo form_error('image') ?>
                                            </div>
                                        </div>

                                        <input class="btn btn-success" type="submit" name="btn" value="Save" />
                                    </form>

                                </div>

                                <div class="card-footer small text-muted">
                                    * required fields
                                </div>
                        <!-- end ofContent -->
                    </div>
                </main>
                <?php $this->load->view("admin/_partials/footer.php") ?>
            </div>
        </div>
        <?php $this->load->view("admin/_partials/js.php") ?>
    </body>
</html>
