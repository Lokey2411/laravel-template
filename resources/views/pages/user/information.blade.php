@extends('layouts.app')
@section('content')
    <a href="{{ route('home') }}">Back</a>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Trang thông tin</div>
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}">
                        <label for="name">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}">
                        <label for="name">phone number</label>
                        <input type="tel" name="phoneNumber" value="{{ $user->phone }}"><button type="submit">Cập
                            nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
