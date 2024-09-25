@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Пополнение баланса') }}</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <p>{{ __('Текущий баланс:') }} <strong>{{ Auth::user()->balance }}</strong> {{ __('рублей') }}</p>
                <form action="{{ route('advertiser.balance') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="amount">{{ __('Сумма пополнения') }}</label>
                        <input type="number" name="balance" id="balance" class="form-control" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Пополнить') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
