@section('title', 'Kirim File')
@if (session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
