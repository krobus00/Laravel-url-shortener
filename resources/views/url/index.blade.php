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
      <section class="flex flex-col break-words sm:border-1 sm:rounded-md sm:shadow-sm">
        <header
          class="flex justify-between items-center font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md ">
          <span> URL SHORTENER</span>
          <a href="{{ route('url.create') }}" class="btn btn-primary">Create</a>
        </header>
        <div class="w-full p-6 flex flex-col space-y-4">
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
          <form action="{{ route('url.index') }}" method="GET">
            <div class="form-control">
              <label class="label">
                <span class="label-text">Search</span>
              </label>
              <div class="relative">
                <input type="text" name="q" value="{{ Request::get('q', '') }}"
                  placeholder="https://random-url.com, custom code"
                  class="w-full pr-16 input input-primary input-bordered">
                <button type="submit" class="absolute top-0 right-0 rounded-l-none btn btn-primary">find</button>
              </div>
            </div>
          </form>
          <div class="overflow-x-auto">
            <table class="table w-full">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Url</th>
                  <th>Short Url</th>
                  <th>Last Updated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($data as $key => $value)
                  <tr class="hover">
                    <th>{{ ++$i }}</th>
                    <td>{{ $value->target }}</td>
                    <td class="hover:underline cursor-pointer"
                      onclick="copyToClipboard('{{ env('APP_SHORT_URL') }}{{ $value->custom_key }}')">
                      {{ $value->custom_key ?? '-' }}
                    </td>
                    <td>{{ $value->updated_at }}</td>
                    <td>
                      <form action="{{ route('url.destroy', $value->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('url.edit', $value->id) }}">Edit</a>
                        <a class="btn btn-secondary" href="{{ route('goToUrl', $value->custom_key) }}">Visit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center">
                      <p>No Data</p>
                    </td>

                  </tr>
                @endforelse

              </tbody>
            </table>
          </div>
          {{ $data->withQueryString()->links() }}
        </div>
      </section>
    </div>
  </main>
@endsection
