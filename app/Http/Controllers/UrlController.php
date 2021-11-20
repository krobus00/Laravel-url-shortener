<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function generateRandomString()
    {
        do {
            $code = Str::random(8);
        } while (Url::where("custom_key", "=", $code)->first());

        return $code;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Url::where("user_id", "=", Auth::user()->id)
            ->where(function ($query) {
                $query->where("target", "LIKE", "%" . request('q', "") . "%")
                    ->orWhere("custom_key", "LIKE", "%" . request('q', "") . "%");
            })
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('url.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('url.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUrlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUrlRequest $request)
    {
        $newUrl = $request->validated();
        if (!$request->filled('custom_key')) {
            $newUrl["custom_key"] = $this->generateRandomString();
        }
        Url::create($newUrl);

        return redirect()->route('url.index')
            ->with('success', 'Url created successfully. https://s.krobot.my.id/' . $newUrl["custom_key"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        return view('url.edit', compact('url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUrlRequest  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        $updateUrl = $request->validated();
        if (!$request->filled('custom_key')) {
            $updateUrl["custom_key"] = $this->generateRandomString();
        }
        $url->update($updateUrl);

        return redirect()->route('url.index')
            ->with('success', 'Url created successfully. https://s.krobot.my.id/' . $updateUrl["custom_key"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        $url->delete();

        return redirect()->route('url.index')
            ->with('success', 'Url deleted successfully');
    }
    public function goToUrl($custom_key)
    {
        $url = Url::where('custom_key', $custom_key)->firstOrFail();
        return Redirect::to($url->target);
    }
}
