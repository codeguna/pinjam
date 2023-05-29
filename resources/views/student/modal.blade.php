<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('admin.students.store') }}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="alert alert-info">
                            <p>
                                Nama Orang Tua yang muncul, adalah orang tua yang belum mempunyai
                                relasi dengan data Mahasiswa <i class="fas fa-info-circle"></i>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pilih Orang Tua</label>
                                <select class="form-control" name="parent_id" required>
                                    <option selected disabled>== Pilih Orang Tua ==</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Mahasiswa</label>
                                <input class="form-control" type="text" name="name"
                                    placeholder="nama lengkap mahasiswa" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nim Mahasiswa</label>
                                <input class="form-control" type="number" maxlength="10" min="-" name="nim"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control" name="class_id" required>
                                    <option selected disabled>==Pilih Kelas==</option>
                                    @foreach ($classRooms as $value => $key)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
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
