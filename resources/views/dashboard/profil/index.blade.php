@extends("dashboard.layouts.main")
@section('container')

{{-- header --}}
<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom border-2">
<h1 style="text-transform: uppercase; ">edit profil {{ auth()->user()->driver }}</h1>
</div>
{{-- end header --}}

{{-- form edit --}}
<form action="/dashboard/profil/{{ auth()->user()->driver }}" method="POST"  enctype="multipart/form-data" class="row g-3">
    @csrf
    @method('PUT')
    <div class="input col-md-3">
        <label for="driver" class="form-label">Nama :</label>
        <input type="text" id="driver" name="driver" value="{{ auth()->user()->driver }}" class="form-control">
    </div>
    <div class="input col-md-3">
        <label for="email" class="form-label">Email :</label>
        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control">
    </div>
    <div class="input col-md-3">
        <label for="password" class="col-sm-auto form-label">New Password : </label>
        <div class="pw-container">
            <input type="password" id="password" name="password" class="form-control">
            <button class="toggle-btn" type="button"  onclick="togglePassword()"><i class="bi bi-eye-fill" id="toggle-icon"></i></button>
        </div>
    </div>
    <div class="input col-12">
        <label for="image" class="form-label">Upload Image:</label>
        <input type="hidden" name="oldImage" value="{{ auth()->user()->image }}">
        <div class="mb-3">
            <img src="{{ asset('storage/' . auth()->user()->image) }}" class="image-priview col-sm-4 img-fluid mb-3 d-block" style=" display: block;width: 150px;height: 150px;object-fit: cover;border-radius: 50%;">
            <input onchange="imagePreview()" class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="btn-dashboard col-4">
        <button type="submit" class="btn btn-primary">SUBMIT</button>
    </div>
</form>
{{-- end form edit --}}

<script>
     function imagePreview() {
          const image = document.querySelector('#image');
          const imgPriview = document.querySelector('.image-priview');

          imgPriview.style.display = 'block';

          const oFReader = new FileReader();
          oFReader.readAsDataURL(image.files[0]);

          oFReader.onload = function(oFREvent) {
            imgPriview.src = oFREvent.target.result;
          }
        }

    function togglePassword() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.getElementById("toggle-icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("bi-eye-fill");
        toggleIcon.classList.add("bi-eye-slash-fill");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("bi-eye-slash-fill");
        toggleIcon.classList.add("bi-eye-fill");
    }
}
</script>

@endsection
