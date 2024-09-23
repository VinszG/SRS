<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Request</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.requests.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="departemen" class="col-md-4 col-form-label text-md-right">Departemen</label>
                            <div class="col-md-6">
                                <input id="departemen" type="text" class="form-control @error('departemen') is-invalid @enderror" name="departemen" value="{{ old('departemen') }}" required>
                                @error('departemen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan" class="col-md-4 col-form-label text-md-right">Jabatan</label>
                            <div class="col-md-6">
                                <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan') }}" required>
                                @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="request_date" class="col-md-4 col-form-label text-md-right">Request Date</label>
                            <div class="col-md-6">
                                <input id="request_date" type="date" class="form-control @error('request_date') is-invalid @enderror" name="request_date" value="{{ old('request_date') }}" required>
                                @error('request_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deskripsi_permasalahan" class="col-md-4 col-form-label text-md-right">Deskripsi Permasalahan</label>
                            <div class="col-md-6">
                                <textarea id="deskripsi_permasalahan" class="form-control @error('deskripsi_permasalahan') is-invalid @enderror" name="deskripsi_permasalahan" required>{{ old('deskripsi_permasalahan') }}</textarea>
                                @error('deskripsi_permasalahan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bukti_foto" class="col-md-4 col-form-label text-md-right">Bukti Foto</label>
                            <div class="col-md-6">
                                <input id="bukti_foto" type="file" class="form-control-file @error('bukti_foto') is-invalid @enderror" name="bukti_foto">
                                @error('bukti_foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>