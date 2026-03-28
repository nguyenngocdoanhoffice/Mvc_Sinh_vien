<!DOCTYPE html>
<html>
<head>
    <title>Thêm sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4 col-md-6 mx-auto">
        <h3 class="text-center mb-3">Thêm sinh viên</h3>

        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                <div>{{ $err }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="/store">
            @csrf

            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Ngành học</label>
                <input type="text" name="major" class="form-control">
            </div>

            <button class="btn btn-primary w-100">Thêm</button>
            <a href="/" class="btn btn-secondary w-100 mt-2">Quay lại</a>
        </form>
    </div>
</div>

</body>
</html>
