@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-12">
                {{-- <a href="{{ url('home') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Kembali</a> --}}
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="bi bi-person-check" style="color: gray"> </i>My Profile</h3>

                        <table class="table table-borderless" style="vertical-align: middle">
                            <tbody>
                                <tr>
                                    <td width='200'>Nama</td>
                                    <td width='20'>:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email Address</td>
                                    <td>:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>No Telepon</td>
                                    <td>:</td>
                                    <td>{{ $user->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $user->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="bi bi-pencil" style="color: gray"></i> Edit Profile</h3>

                        <form action="{{ url('profile') }}" method="POST">
                            @csrf
                            <table class="table table-borderless" style="vertical-align: middle">
                                <tbody>
                                    <tr>
                                        <td width='200'>
                                            <label for="name" class=" col-form-label text-md-end">{{ __('Name') }}
                                            </label>
                                        </td>
                                        <td width='20'>:</td>
                                        <td>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $user->name }}" autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="email"
                                                class=" col-form-label text-md-end">{{ __('Email Address') }}
                                            </label>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ $user->email }}" autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="no_hp"
                                                class=" col-form-label text-md-end">{{ __('No Telepon') }}
                                            </label>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <input id="no_hp" type="text"
                                                class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                                value="{{ $user->no_hp }}" autocomplete="no_hp" autofocus>

                                            @error('no_hp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="alamat" class=" col-form-label text-md-end">{{ __('Alamat') }}
                                            </label>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat">
                                                {{ $user->alamat }}
                                            </textarea>

                                            @error('alamat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="password" class=" col-form-label text-md-end">{{ __('Password') }}
                                            </label>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="password-confirm"
                                                class=" col-form-label text-md-end">{{ __('Confirm Password') }}
                                            </label>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" autocomplete="new-password">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
