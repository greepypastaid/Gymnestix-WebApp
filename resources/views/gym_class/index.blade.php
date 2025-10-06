@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Daftar Jadwal Kelas/Gym</h2>
    <a href="{{ route('gym_class.create') }}" class="btn btn-success mb-3">Tambah Jadwal Kelas</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Durasi (menit)</th>
                <th>Kapasitas</th>
                <th>Trainer</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
            <tr>
                <td>{{ $class->nama_kelas }}</td>
                <td>{{ $class->waktu_mulai }}</td>
                <td>{{ $class->waktu_selesai }}</td>
                <td>{{ $class->durasi }}</td>
                <td>{{ $class->kapasitas }}</td>
                <td>
                    @if($class->trainer && $class->trainer->user)
                        {{ $class->trainer->user->nama }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $class->deskripsi }}</td>
                <td>
                    <a href="{{ route('gym_class.show', $class->class_id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('gym_class.edit', $class->class_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('gym_class.destroy', $class->class_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus jadwal?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
