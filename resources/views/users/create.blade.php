@extends('layouts.app')

@section('content')
    <h1>Create User</h1>
    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="token" placeholder="Token">
        <input type="text" name="state" placeholder="State">
        <input type="number" name="balance" placeholder="Balance">
        <button type="submit">Create</button>
    </form>
@endsection
