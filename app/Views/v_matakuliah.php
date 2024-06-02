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
    <h4><?php echo $title ?> <a href="<?php echo site_url('matakuliahc/add') ?>" class="btn btn-success" id="add"><i class="bi bi-cloud-plus"></i></a></h4>
    </div>

    <div class="table-responsive">
        <table id="myTable" class="table table-striped pt-3" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($getData as $row) { ?>
                    <tr>

                        <td><?php echo $i ?></td>
                        <td><?php echo $row->kode_mk ?></td>
                        <td><?php echo $row->nama_mk ?></td>
                        <td><?php echo $row->sks ?></td>
                        <td><?php echo $row->semester ?></td>
                        <td>
                        <a href="<?php echo site_url('matakuliahc/edit/' . $row->kode_mk) ?>" class="btn btn-outline-primary" id="edit"><i class="bi bi-pencil-square"></i></a>

                            <a href="<?php echo site_url('matakuliahc/delete/' . $row->kode_mk) ?>"><button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></a>
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
    


<!-- Modal for Matakuliah Form -->
<div class="modal fade" id="modalMatakuliahForm" tabindex="-1" aria-labelledby="modalMatakuliahFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMatakuliahFormLabel">Matakuliah Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php echo form_open('matakuliahc/submit', 'id="modalMatakuliahForm"'); ?>

            <div class="modal-body">
                <div class="form-group">
                    <label for="kode_mk">Kode MK</label>
                    <input type="text" class="form-control" id="kode_mk" name="kode_mk" value="<?= old('kode_mk') ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_mk">Mata Kuliah</label>
                    <input type="text" class ="form-control" id="nama_mk" name="nama_mk" value="<?= old('nama_mk') ?>" required>
                </div>
                <div class="form-group">
                    <label for="sks">SKS</label>
                    <input type="text" class="form-control" id="sks" name="sks" value="<?= old('sks') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <select name="semester" id="semester" class="form-select" required>
                        <option value="1"<?= old('semester') == '1' ? ' selected' : '' ?>>1</option>
                        <option value="2"<?= old('semester') == '2' ? ' selected' : '' ?>>2</option>
                        <option value="3"<?= old('semester') == '3' ? ' selected' : '' ?>>3</option>
                        <option value="4"<?= old('semester') == '4' ? ' selected' : '' ?>>4</option>
                        <option value="5"<?= old('semester') == '5' ? ' selected' : '' ?>>5</option>
                        <option value="6"<?= old('semester') == '6' ? ' selected' : '' ?>>6</option>
                        <option value="7"<?= old('semester') == '7' ? ' selected' : '' ?>>7</option>
                        <option value="8"<?= old('semester') == '8' ? ' selected' : '' ?>>8</option>
                        <!-- Add other semester options as needed -->
                    </select>
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
            $('#kode_mk').val('');
            $('#nama_mk').val('');
            $('#sks').val('');
            $('#semester').val('');
        $('#modalMatakuliahForm').modal('show');
        $('.modal-title').text('Tambah Data');
       
        $('#modalMatakuliahForm form').attr('action', '<?php echo site_url('matakuliahc/submit') ?>');
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
                $('#modalMatakuliahForm').modal('show');
                $('.modal-title').text('Ubah Data');
                $('#modalMatakuliahForm form').attr('action', '<?php echo site_url('matakuliahc/update') ?>');
            }
        })
    })
})

    </script>
</body>

</html>