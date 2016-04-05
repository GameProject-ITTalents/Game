<?php

namespace App\Http\Controllers;

use App\Object;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Validator;
use App\Bundle;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $objects = DB::table('objects')->get();
        return view('shop.products', compact('objects'));
    }
    
    public function newObject()
    {
        return view('shop.newObject');
    }

    public function addObject(Request $request)
    {
        $name = str_random(30) . '-' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move('img', $name);
        $object  = new Object;
        $object->name = $request->name;
        $object->description = $request->description;
        $object->price = $request->price;
        $object->image = 'img/' . $name;

        $object->save();

        return redirect('/shop')->with('status', 'Object create successfully');
    }
    
    public function destroyObject($id)
    {
        Object::destroy($id);
        return redirect('/shop')->with('status', 'Object deleted successfully');
    }

    public function buyCoins()
    {
        $bundles = DB::table('bundles')->get();
        return view('shop.coins', compact('bundles'));
    }

    public function editObject($id)
    {
        $object = DB::table('objects')->where('id', $id)->first();
        return view('admin.editObject', compact('object'));
    }

    public function updateObject(Request $request, $id)
    {
        $rules = [
            'price' => 'integer'
        ];
        $messages = [
            'price.integer' => 'Must be integer'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect('editProduct/' . $id)->withErrors($validator);
        } else {

            Object::where('id', '=', $id)
                ->where('id', $id)
                ->update([
                    'price' => $request->price,
                ]);
            return redirect('/shop')->with('status', 'Your profile picture has been changed');
        }
    }

    public function newBundle()
    {
        return view('shop.newBundle');
    }

    public function addBundle(Request $request)
    {
        $bundle  = new Bundle;
        $bundle->name = $request->name;
        $bundle->coins = $request->coins;
        $bundle->price = $request->price;

        $bundle->save();

        return redirect('/buyCoins')->with('status', 'Object create successfully');
    }

    public function destroyBundle($id)
    {
        Bundle::destroy($id);
        return redirect('/buyCoins')->with('status', 'Object deleted successfully');
    }

    public function editBundle($id)
    {
        $bundle = DB::table('bundles')->where('id', $id)->first();
        return view('admin.editBundle', compact('bundle'));
    }

    public function updateBundle(Request $request, $id)
    {
        Bundle::where('id', '=', $id)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'coins' => $request->coins,
                'price' => $request->price,
            ]);
        return redirect('/buyCoins')->with('status', 'Your profile picture has been changed');
    }

    
}
