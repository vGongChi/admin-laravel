@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $user->name }}" required>
        <input type="password" name="password" value="{{ $user->password }}" required>
        <input type="text" name="token" value="{{ $user->token }}">
        <input type="text" name="state" value="{{ $user->state }}">
        <input type="number" name="balance" value="{{ $user->balance }}">
        <button type="submit">Update</button>
    </form>
@endsection
