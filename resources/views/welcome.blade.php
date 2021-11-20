<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/script.js') }}" defer></script>

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
  <div class="hero min-h-screen bg-base-200">
    <div class="flex-col justify-center hero-content lg:flex-row">
      <div class="text-center lg:text-left">
        <h1 class="mb-5 text-5xl font-bold">
          Krobot URL Shortener
        </h1>
        <p class="mb-5">
          You can create and edit your links
        </p>
        <a href="{{ route('login') }}" class="btn btn-primary">Create Now</a>
      </div>
      <div class="card flex-shrink-0 w-full max-w-md shadow-2xl bg-base-100">
        <form action="{{ route('guestStore') }}" method="POST" class="card-body">
          @csrf
          @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <div class="flex-1">
                <label>{{ $message }}</label>
              </div>
            </div>
          @endif
          @if ($message = Session::get('short_link'))
            <div class="mt-1 alert alert-success">
              <div class="underline cursor-pointer font-medium flex-1">
                <label onclick="copyToClipboard('{{ $message }}')">{{ $message }}</label>
              </div>
            </div>
          @endif
          @if ($errors->any())
            <div class="alert alert-error">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
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
          <div class="form-control mt-6">
            <input type="submit" value="Instant create" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
