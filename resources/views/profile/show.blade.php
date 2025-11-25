@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h3 class="mb-3">Profil Saya</h3>

    <div class="mb-3">
      <strong>Nama</strong>
      <div>{{ $user->name }}</div>
    </div>

    <div class="mb-3">
      <strong>Email</strong>
      <div>{{ $user->email }}</div>
    </div>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
  </div>
</div>
@endsection
