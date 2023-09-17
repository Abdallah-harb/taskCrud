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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{route('user-create')}}" class="btn btn-primary">Creat User</a>
                    <a href="{{route('user-all')}}" class="btn btn-primary">All Users</a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

{{--bootstrap Moodel--}}
<!-- Modal -->

