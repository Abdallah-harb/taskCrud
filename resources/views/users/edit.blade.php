<x-app-layout>
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
        <form method="post" action="{{route('user-update',$user->id)}}">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" name ="name" placeholder="Write name" value="{{$user->name}}">
                </div>
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
                <div class="col">
                    <input type="email" class="form-control" value="{{$user->email}}" name="email" placeholder="User email">
                </div>
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" name="mobile" placeholder="mobile" value="{{$user->mobile}}">
                </div>
                @error('mobile')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary text-danger">Submit</button>
        </form>

    </div>
</x-app-layout>

