@extends('layouts.app')
@section('content')
    <style>
        .modal {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
    @if ($errors->any())
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif
    @if ($message = Session::get('message'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    <button onclick="openAddModel()">Create</button>
    <form action="{{ route('search') }}" method="post">
        @csrf
        <input type="text" name="search">
        <button type="submit">Search</button>
    </form>
    {{-- <input type="text" onkeyup="search(this.value)"> --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã nhân viên</th>
                <th scope="col">Tên nhân viên</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <a href="#" onclick="showMessage({{ $user->id }})">
                            @csrf
                            Xóa</a>
                        <div id="confirm-{{ $user->id }}"
                            class="fixed-top fixed-bottom model d-flex justify-content-center align-items-center modal d-none">
                            <div class="bg-light w-50 p-5 rounded-2">
                                <p>Are you sure you want to delete this user?</p>
                                <button type="button"
                                    onclick="document.getElementById('confirm-{{ $user->id }}').classList.add('d-none');
                                    document.getElementById('confirm-{{ $user->id }}').classList.remove('d-flex'); ">Cancel</button>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"><button
                                        type="submit">
                                        @csrf
                                        @method('DELETE')
                                        Delete</button></form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="addModal" class="fixed-top fixed-bottom model d-flex justify-content-center align-items-center modal d-none">
        <div class="bg-light w-50 p-5 rounded-2">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Tên nhân viên</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khác</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="d-flex">
                    <button type="button"
                        onclick="document.getElementById('addModal').classList.add('d-none'); document.getElementById('addModal').classList.remove('d-flex');">Cancel</button>
                    <button type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
    {{-- pagination --}}
    {{ $users->links('components.pagination') }}
    <script>
        function showMessage(id) {
            document.getElementById(`confirm-${id}`).classList.remove("d-none");
            document.getElementById(`confirm-${id}`).classList.add("d-flex");
        }

        function openAddModel() {
            document.getElementById("addModal").classList.remove("d-none");
            document.getElementById("addModal").classList.add("d-flex");
        }
    </script>
@endsection
