@extends('layouts.master')

@section('title','Sửa sinh viên')

@section('content')
    <div class="card shadow p-4 col-md-6 mx-auto">
        <h3 class="text-center mb-3">Sửa sinh viên</h3>

        <form method="POST" action="{{ route('students.update', $student->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" name="name" value="{{ old('name', $student->name) }}" class="form-control @error('name') is-invalid @enderror">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ngành học</label>
                <input type="text" name="major" value="{{ old('major', $student->major) }}" class="form-control @error('major') is-invalid @enderror">
                @error('major') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-success w-100">Cập nhật</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary w-100 mt-2">Quay lại</a>
        </form>
    </div>
@endsection

