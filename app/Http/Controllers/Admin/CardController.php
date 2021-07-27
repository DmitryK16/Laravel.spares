<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Group;
use App\Models\Manufacturer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cards = Card::paginate(10);
        return view('admin.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturers = Manufacturer::pluck('title', 'id')->all();
        $groups = Group::pluck('title', 'id')->all();
        return view('admin.cards.create', compact('manufacturers', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'wight' => 'required',
            'manufacturer_id' => 'required|integer',
            'group_id' => 'required|integer',
            'thumbnail' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $folder = date('Y-m-d');
            $data['thumbnail'] = $request->file('thumbnail')->store("images/{$folder}");
        }

        $card = Card::create($data);


        return redirect()->route('cards.index')->with('success', 'Товар добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {

        $card = Card::find($id);
        $manufacturers = Manufacturer::pluck('title', 'id')->all();
        $groups = Group::pluck('title', 'id')->all();

        return view('admin.cards.edit', compact('manufacturers', 'groups', 'card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'wight' => 'required',
            'manufacturer_id' => 'required|integer',
            'group_id' => 'required|integer',
            'thumbnail' => 'nullable|image',
        ]);

        $card = Card::find($id);
        $data = $request->all();
        if ($request->hasFile('thumbnail')) {
            Storage::delete($card->thumbnail);
            $folder = date('Y-m-d');
            $data['thumbnail'] = $request->file('thumbnail')->store("images/{$folder}");
        }

        $card->update($data);

        return redirect()->route('cards.index')->with('success', 'Изменение сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $card = Card::find($id);
        Storage::delete($card->thumbnail);
        $card->delete();
        return redirect()->route('cards.index')->with('success', 'Товар удален');
    }
}
