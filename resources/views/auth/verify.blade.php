@extends('layouts.app')
@section('page', 'Verifikasi Alamat Email')
@section('content')
<div class="card-body login-card-body">
  <p class="login-box-msg">Link verifikasi telah dikirim kepada alamat email anda.</p>

  {{ __('Sebelum melanjutkan silakan cek email anda.') }}
  {{ __('Jika kamu tidak menerima email') }},
  <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
      @csrf
      <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik disini untuk mendapatkan link verifikasi baru') }}</button>.
  </form>
</div>
@endsection
