<div class="modal fade" id="parentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('admin.parents.store') }}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Orang Tua</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="alert alert-info">
                            <p>
                                Nama Pengguna yang muncul, adalah pengguna yang belum mempunyai
                                relasi dengan data Orang Tua <i class="fas fa-info-circle"></i>
                            </p>
                        </div>
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pilih Pengguna</label>
                                <select class="form-control" name="user_id" required>
                                    <option selected disabled>== Pilih Orang Tua ==</option>
                                    @foreach ($users as $value => $key)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Handphone</label>
                                <input class="form-control" type="tel" maxlength="13" name="mobile"
                                    placeholder="081212345678" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <input type="text" class="form-control" name="occupation"
                                    placeholder="jenis pekerjaan" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="address" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
