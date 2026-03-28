<!DOCTYPE html>
<html>

<head>
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">
            <a href="/" class="text-decoration-none text-dark">
                Danh sách sinh viên
            </a>
        </h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="/add" class="btn btn-primary">+ Thêm sinh viên</a>

            <form method="GET" class="d-flex">
                <input type="text" name="search" value="{{ $keyword ?? '' }}" class="form-control me-2"
                    placeholder="Nhập tên sinh viên">
                <button class="btn btn-outline-primary">Tìm</button>
            </form>
        </div>

        <table class="table table-bordered table-hover text-center">
            <thead class="table-primary">
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                @if ($students->count() > 0)
                    @foreach ($students as $sv)
                        <tr>
                            <td>
                                {{ $allStudents->search(function ($item) use ($sv) {
                                    return $item->id == $sv->id;
                                }) + 1 }}
                            </td>
                            <td>{{ $sv->name }}</td>
                            <td>{{ $sv->major }}</td>
                            <td>
                                <a href="/edit/{{ $sv->id }}" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="/delete/{{ $sv->id }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Xóa sinh viên này?')">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center text-danger">
                            Không có sinh viên nào
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>


        <div class="d-flex justify-content-center">
            {{ $students->links() }}
        </div>

    </div>

</body>

</html>
