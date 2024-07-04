@extends('layouts.admin.app')

@section('title', 'Catatan Terjadwal')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Catatan Terjadwal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Catatan Terjadwal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/todolist/store">
                    @csrf
                    <div class="mb-3">
                        <label for="category" class="form-label">Catatan</label>
                        <select class="form-select" name="todo_id" id="todo_id">
                            <option selected>Catatan</option>
                            @foreach ($todos as $value)
                            <option value="{{$value->id}}">{{$value->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Hari</label>
                        <select class="form-select" name="day" id="day">
                            <option selected>Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option selected>Status</option>
                            <option value="0">Belum</option>
                            <option value="1">Sedang</option>
                            <option value="2">Sudah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="todo_date" name="todo_date">
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<table class="table" id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Catatan</th>
            <th scope="col">Nama</th>
            <th scope="col">Hari</th>
            <th scope="col">Status</th>
            <th scope="col">Jadwal</th>
            <th scope="col">Actions</th> <!-- Menambah kolom untuk Actions -->
        </tr>
    </thead>
    <tbody>
        @php
            $count = 1;
        @endphp
        @foreach ($todolists as $todolist)
        <tr>
            <th scope="row">{{$count++}}</th>
            <td>{{$todolist->title}}</td>
            <td>{{$todolist->name}}</td>
            <td>{{$todolist->day}}</td>
            <td>
    @if ($todolist->status == 0)
        Belum
    @elseif ($todolist->status == 1)
        Sedang
    @elseif ($todolist->status == 2)
        Sudah
    @else
        Status Tidak Diketahui
    @endif
</td>
            <td>{{$todolist->todo_date}}</td>
            <td>
                <!-- Tombol Edit -->
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$todolist->id}}">
                    Edit
                </button>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{$todolist->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$todolist->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{$todolist->id}}">Edit Catatan Terjadwal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="/todolist/update/{{$todolist->id}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Catatan</label>
                                        <select class="form-select" name="todo_id" id="todo_id">
                                            @foreach ($todos as $value)
                                            <option value="{{$value->id}}" {{$todolist->todo_id == $value->id ? 'selected' : ''}}>{{$value->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Hari</label>
                                        <select class="form-select" name="day" id="day">
                                            <option value="Senin" {{$todolist->day == 'Senin' ? 'selected' : ''}}>Senin</option>
                                            <option value="Selasa" {{$todolist->day == 'Selasa' ? 'selected' : ''}}>Selasa</option>
                                            <option value="Rabu" {{$todolist->day == 'Rabu' ? 'selected' : ''}}>Rabu</option>
                                            <option value="Kamis" {{$todolist->day == 'Kamis' ? 'selected' : ''}}>Kamis</option>
                                            <option value="Jumat" {{$todolist->day == 'Jumat' ? 'selected' : ''}}>Jumat</option>
                                            <option value="Sabtu" {{$todolist->day == 'Sabtu' ? 'selected' : ''}}>Sabtu</option>
                                            <option value="Minggu" {{$todolist->day == 'Minggu' ? 'selected' : ''}}>Minggu</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status">
                                            <option value="0" {{$todolist->status == 0 ? 'selected' : ''}}>Belum</option>
                                            <option value="1" {{$todolist->status == 1 ? 'selected' : ''}}>Sedang</option>
                                            <option value="2" {{$todolist->status == 2 ? 'selected' : ''}}>Sudah</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="todo_date" name="todo_date" value="{{$todolist->todo_date}}">
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Delete -->
                <form action="{{ route('todolist.destroy', $todolist->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
