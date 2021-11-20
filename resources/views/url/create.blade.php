@extends('layouts.app')

@section('content')
  <main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">
      @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
          role="alert">
          {{ session('status') }}
        </div>
      @endif
      <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm">
        <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
          Create new url
        </header>
        <div class="w-full p-6">
          @if ($errors->any())
            <div class="alert alert-error">
              <div class="flex-1">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif
          <form action="{{ route('url.store') }}" method="POST" class="lg:w-2/5 space-y-3">
            @csrf
            <div class="form-control">
              <label class="label">
                <span class="label-text">url</span>
              </label>
              <input type="text" name="target" placeholder="https://random-url.com" class="input input-bordered"
                value="{{ old('target') }}">
            </div>
            <div class="form-control">
              <label class="label">
                <span class="label-text">custom key</span>
              </label>
              <label class="input-group">
                <span>{{ env('APP_SHORT_URL') }}</span>
                <input type="text" name="custom_key" placeholder="myurl" class="input input-bordered w-full"
                  value="{{ old('custom_key') }}">
              </label>
            </div>
            <button class="btn btn-primary btn-active" type="submit">Submit</button>
          </form>
        </div>
      </section>
    </div>
  </main>
@endsection
