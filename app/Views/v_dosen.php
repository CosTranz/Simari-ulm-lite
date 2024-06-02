<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<div class="d-flex align-items-end row">
        <div class="col-sm-12">
            <div class="card-body">
            <?php if (session()->has('success')) : ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom">
    <h4><?php echo $title ?> <a href="<?php echo site_url('dosenc/add') ?>" class="btn btn-success" id="add"><i class="bi bi-cloud-plus"></i></a></h4>
    </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIP</th>
                    <th>Nama Dosen</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($getData as $row) { ?>
                    <tr>

                        <td><?php echo $i ?></td>
                        <td><?php echo $row->nip ?></td>
                        <td><?php echo $row->nama_dosen ?></td>
                        <td>
                        <a href="<?php echo site_url('dosenc/edit/' . $row->nip) ?>" class="btn btn-outline-primary" id="edit"><i class="bi bi-pencil-square"></i></a>

                            <a href="<?php echo site_url('dosenc/delete/' . $row->nip) ?>"><button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></a>
                        </td>
                    </tr>
                <?php $i++;
                } ?>
            </tbody>
        </table>
    </div>
            </div>
        </div>
</div>

    
    <!-- Modal for Dosen Form -->
<div class="modal fade" id="modalDosenForm" tabindex="-1" aria-labelledby="modalDosenFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDosenFormLabel">Dosen Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php echo form_open('dosenc/submit', 'id="modalDosenForm"'); ?>

            <div class="modal-body">
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="<?= old('nip') ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="nama_dosen">Nama Dosen</label>
                    <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="<?= old('nama_dosen') ?>" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning" value="SIMPAN">Simpan</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>


    <script>
           $(document).ready(function() {
            $('#myTable').DataTable();

        });

        $(function() {
    $('#add').on('click', function(e) {
        e.preventDefault();
        $('[name="id"]').val(''); 
            $('#nip').val('');
            $('#nama_dosen').val('');
        $('#modalDosenForm').modal('show');
        $('.modal-title').text('Tambah Data');
       
        $('#modalDosenForm form').attr('action', '<?php echo site_url('dosenc/submit') ?>');
    })

    $(document).on('click', '#edit', function(e) {
        e.preventDefault();
        $link = $(this).attr('href');
        $.ajax({
            url: $link,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $.each(data, function(idx, val) {
                    $('[name="' + idx + '"]').val(val);
                })
                $('#modalDosenForm').modal('show');
                $('.modal-title').text('Ubah Data');
                $('#modalDosenForm form').attr('action', '<?php echo site_url('dosenc/update') ?>');
            }
        })
    })
})
    </script>
</body>

</html>