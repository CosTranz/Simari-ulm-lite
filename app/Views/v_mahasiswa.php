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
                    <h4><?php echo $title ?> <a href="<?php echo site_url('mahasiswaa/add') ?>" class="btn btn-success" id="add"><i class="bi bi-cloud-plus"></i></a></h4>

                </div>
                <table id="myTable" class="table table-striped pt-3" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($getData as $row) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row->nim ?></td>
                                <td><?php echo $row->nama_mhs ?></td>
                                <td><?php echo $row->jenis_kelamin ?></td>
                                <td><?php echo date('d/m/y', strtotime($row->tgl_lahir)) ?></td>
                                <td><?php echo $row->alamat ?></td>
                                <td>

                                    <a href="<?php echo site_url('mahasiswaa/edit/' . $row->nim) ?>" class="btn btn-outline-primary" id="edit"><i class="bi bi-pencil-square"></i></a>


                                    <a href="<?php echo site_url('mahasiswaa/delete/' . $row->nim) ?>" class="btn btn-outline-danger" id="delete"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php echo form_open('mahasiswaa/submit', 'id="modalForm"'); ?>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="<?= old('nim') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mhs" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" value="<?= old('nama_mhs') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= old('tgl_lahir') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required<?= old('alamat') ?>></textarea>
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
                $('#nim').val('');
                $('#nama_mhs').val('');
                $('#tgl_lahir').val('');
                $('#jenis_kelamin').val('');
                $('#alamat').val('');
                $('#modalForm').modal('show');
                $('.modal-title').text('Tambah Data');

                $('#modalForm form').attr('action', '<?php echo site_url('mahasiswaa/submit') ?>');
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
                        $('#modalForm').modal('show');
                        $('.modal-title').text('Ubah Data');
                        $('#modalForm form').attr('action', '<?php echo site_url('mahasiswaa/update') ?>');
                    }
                })
            })
        })
    </script>

</body>


</html>