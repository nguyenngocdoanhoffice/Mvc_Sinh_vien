@extends('layouts.master')

@section('title','Danh sách sinh viên')

@section('content')
    <div class="d-flex justify-content-between align-items-center my-3">
        <h2 class="mb-0">Danh sách sinh viên</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary">+ Thêm sinh viên</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="search" value="{{ old('search', $search ?? '') }}" class="form-control" placeholder="Tìm theo tên">
                </div>
                <div class="col-md-3">
                    <input type="text" name="major" value="{{ old('major', $major ?? '') }}" class="form-control" placeholder="Tìm theo ngành">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary">Tìm</button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary ms-1">Bỏ lọc</a>
                </div>
                <div class="col-md-3 text-end">
                    <a class="btn btn-sm btn-light" href="{{ route('students.index', array_merge(request()->except('page'), ['sort' => ($sort ?? '') === 'name_asc' ? 'name_desc' : 'name_asc'])) }}">
                        Sắp xếp tên @if(($sort ?? '') === 'name_asc') A→Z @elseif(($sort ?? '') === 'name_desc') Z→A @else (mới) @endif
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th style="width:80px">STT</th>
                    <th>Tên</th>
                    <th>Ngành</th>
                    <th style="width:180px">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $sv)
                    @php
                        $stt = ($students->currentPage()-1) * $students->perPage() + $loop->iteration;
                    @endphp
                    <tr>
                        <td>{{ $stt }}</td>
                        <td>
                            @if($search)
                                {!! preg_replace('/(' . preg_quote($search, '/') . ')/i', '<mark>$1</mark>', e($sv->name)) !!}
                            @else
                                {{ $sv->name }}
                            @endif
                        </td>
                        <td>
                            @if($major)
                                {!! preg_replace('/(' . preg_quote($major, '/') . ')/i', '<mark>$1</mark>', e($sv->major)) !!}
                            @else
                                {{ $sv->major }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('students.edit', $sv->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-action="{{ route('students.destroy', $sv->id) }}">Xóa</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Không có sinh viên nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <div>
            Trang {{ $students->currentPage() }} / {{ $students->lastPage() }}
        </div>
        <div>
            {{ $students->links() }}
        </div>
    </div>

    <!-- Delete confirmation modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Xác nhận xóa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Bạn có chắc chắn muốn xóa sinh viên này?
          </div>
          <div class="modal-footer">
            <form method="POST" action="#">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection

