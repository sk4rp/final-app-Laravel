@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Пополнение баланса') }}</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <p>{{ __('Текущий баланс:') }} <strong>{{ Auth::user()->balance }}</strong> {{ __('рублей') }}</p>
                <form action="{{ route('advertiser.balance') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="amount">{{ __('Сумма пополнения') }}</label>
                        <input type="number" name="amount" id="amount" class="form-control" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Пополнить') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
