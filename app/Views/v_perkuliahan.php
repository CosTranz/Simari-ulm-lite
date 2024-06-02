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
        <h4><?php echo $title ?> <a href="<?php echo site_url('perkuliahanc/add') ?>" class="btn btn-success"><i class="bi bi-cloud-plus"></i></a></h4>
    </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-striped pt-2">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($getData as $row) { ?>
                    <tr>
                        <td><?php echo $row['nim'] ?></td>
                        <td><?php echo $row['nama_mk'] ?></td>
                        <td><?php echo $row['nama_dosen'] ?></td>
                        <td><?php echo $row['ruangan'] ?></td>
                        <td>
                            <a href="<?php echo site_url('perkuliahanc/hapus/' . $row['id_perkuliahan']) ?>"><button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></a>
                        </td>
                    </tr>

                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
        
    </div>
            </div>
        </div>
</div>
    
    

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>