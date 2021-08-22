@extends('layouts.app')

@section('content')
    @if (is_null(\Illuminate\Support\Facades\Auth::user()->activeDesk))
        <div class="mt-5">
            <div class="card bg-danger">
                <div class="card-body">
                    <p class="card-title text-light">
                        لطفا ابتدا یک میزکار ایجاد کنید
                    </p>
                </div>
            </div>
        </div>
    @else

        <livewire:note.index :desk="$desk"/>
    @endif
@endsection
