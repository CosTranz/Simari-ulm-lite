<div class="container">
    <div class="d-flex align-items-end row">
        <div class="col-sm-12">
            <div class="card-body">
                <h1>Form Insert Data Perkuliahan</h1>

                <form method="post" action="<?= base_url('PerkuliahanC/add') ?>" class="mt-4">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <select name="nim" id="nim" class="form-select" required>
                            <?php foreach ($mahasiswa as $mhs) : ?>
                                <option value="<?= $mhs->nim ?>"><?= $mhs->nim ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kode_mk" class="form-label">Mata Kuliah</label>
                        <select name="kode_mk" id="kode_mk" class="form-select" required>
                            <?php foreach ($matakuliah as $mk) : ?>
                                <option value="<?= $mk->kode_mk ?>"><?= $mk->nama_mk ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nip" class="form-label">Dosen</label>
                        <select name="nip" id="nip" class="form-select" required>
                            <?php foreach ($dosen as $dsn) : ?>
                                <option value="<?= $dsn->nip ?>"><?= $dsn->nama_dosen ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="ruangan" class="form-label">Ruangan</label>
                        <select name="ruangan" id="ruangan" class="form-select" required>
                            <option value="MIPA II 3.2">MIPA II 3.2</option>
                            <option value="MIPA II 3.1">MIPA II 3.1</option>
                            <option value="MIPA II 3.3">MIPA II 3.3</option>
                            <option value="MIPA I 2.1">MIPA I 2.1</option>
                            <option value="MIPA I 2.2">MIPA I 2.2</option>
                            <option value="AULA TESLA">AULA TESLA</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-warning">Simpan</button>
                </form>

            </div>
        </div>
    </div>
</div>