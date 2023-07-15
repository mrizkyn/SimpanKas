
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                @if ($errors->any())
                      <div class="alert alert-danger">
                        Validation Error!
                      </div>
                      @endif
                    
                      @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                      @endif
      <form action="/Account/store" method="POST">
        @csrf
    
        <div class="mb-3">
          <label for="code_name" class="form-label">No Akun</label>
          <input type="text" class="form-control  @error('code_name') is-invalid @enderror" id="code_name" name="code_name" value="{{ old('code_name') }}" placeholder="code_name">
          <div class="@error('code_name') @enderror invalid-feedback">
            @foreach ($errors->get('code_name') as $message)
            {{ $message }}
            @endforeach
          </div>
        </div>
    
        <div class="mb-3">
          <label for="account_name" class="form-label">Nama Akun</label>
          <input type="text" class="form-control @error('account_name') is-invalid @enderror" id="account_name" name="account_name" value="{{ old('account_name') }}" placeholder="account_name">
          <div class="@error('account_name') @enderror invalid-feedback">
            @foreach ($errors->get('account_name') as $message)
            {{ $message }}
            @endforeach
          </div>
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </form>
        
        