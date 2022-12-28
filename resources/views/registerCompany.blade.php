@extends('layout/main')
@section('container')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row align-items-center justify-content-center">
        <div class="col-5">
            <div class="card" style="mt-3">
                <div class="card-header text-center">
                   <span class="fw-bold">
                    REGISTER COMPANY
                   </span>
                </div>
                <div class="form-container">
                    <form name="register" id="register" method="post" action="{{ url('store-form-company') }}">
                        @csrf
                        <div class="form-row">
                            <div class="mt-3">
                                <label for="inputName">Name</label>
                                <input type="name" class="form-control form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="Name" name="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="inputPassword4">Confirm Password</label>
                                <input type="password" class="form-control @error('confirmedPassword') is-invalid @enderror"
                                    id="confirmedPassword" placeholder="Password" name="confirmedPassword">
                                @error('confirmedPassword')
                                    {{-- <span class="text-danger">{{ $errors->first('confirmedPassword') }}</span> --}}
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="inputEmail4">Location</label>
                                <input type="name" class="form-control" id="location" placeholder="location" name="location">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="inputEmail4">Phone</label>
                                <input type="name" class="form-control" id="phone" placeholder="phone" name="phone">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                {{-- <label for="inputEmail4">Description</label>
                                <textarea id="w3review" name="description" rows="4" cols="50">
                                </textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                                <label for="description">Description</label>
                                <input type="name" class="form-control" id="description" placeholder="description" name="description">
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-3">Register</button>
                        <br>
                        <span>Already have an account ? login <a href="{{route('login')}}">here</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

