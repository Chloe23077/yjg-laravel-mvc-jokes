<?php

namespace App\Http\Controllers;

use App\Models\Joke;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class JokeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jokes = Joke::paginate(6);
        return view('jokes.index', compact(['jokes',]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jokes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string',],
            'body' => ['required', 'string',],
            'category' => ['required', 'string', 'max:100'],
        ]);

        $joke = Joke::create($validated);

        return redirect(route('jokes.index'))
            ->with('success', 'Joke created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $joke = Joke::whereId($id)->get()->first();
        return view('jokes.show', compact(['joke',]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $joke = Joke::whereId($id)->get()->first();
        return view('jokes.update', compact(['joke',]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string',],
            'body' => ['required', 'string',],
            'category' => ['required', 'string', 'max:100'],
        ]);

        $joke = Joke::where('id', '=', $id)->get()->first();

        $joke->fill($validated);

        $joke->save();

        return redirect(route('jokes.show', compact(['joke'])))
            ->with('success', 'Joke updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $joke = Joke::where('id', '=', $id)->get()->first();

        if (auth()->user()->id !== $joke->id) {

            $joke->delete();

            return redirect(route('jokes.index'))
                ->with('success', 'Joke deleted');

        }

        return back()
            ->with('error', 'Cannot delete yourself');
    }

    public function search(Request $request)
    {
        $keywords = $request->input('keywords');
        $jokes = Joke::query()
            ->when($keywords, function ($query, $keywords) {
                $query->where('id', 'like', "%{$keywords}%")
                ->orWhere('title', 'LIKE', "%{$keywords}%");
            })
            ->paginate(6);
        return view('jokes.index', compact(['jokes',]));
    }

}
