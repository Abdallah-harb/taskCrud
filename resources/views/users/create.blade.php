<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
        @endif
    <div class="container">
        <br>
        <form method="post" action="{{route('user-store')}}">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" name = "name" placeholder=" name">
                </div>
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
                <div class="col">
                    <input type="email" class="form-control" name = "email" placeholder="User email">
                </div>
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <br><br>
            <div class="row">
                <div class="col">
                    <input type="password" class="form-control" name="password" placeholder=" user-password">
                </div>
                @error('password')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-primary text-danger">Submit</button>
        </form>

    </div>
</x-app-layout>

{{--bootstrap Moodel--}}
<!-- Modal -->

