<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\property;

class PostController extends Controller
{
    public function Storeproperty(Request $request){

        $fileNametostore = "noimage.jpg";

        $product = new property();
        $product->title = $request->input('ptitle');
        $product->location = $request->input('plocation');
        $product->city = $request->input('pcity');
        $request->input('pbedroom') == "" ?$product ->bedroom = 0 :$product->bedroom = $request->input('pbedroom');
        $request->input('pbathroom') == "" ?$product ->bathroom = 0 :$product->bathroom = $request->input('pbathroom');
        $request->input('ptoilet') == "" ?$product ->toilet = 0 :$product->toilet = $request->input('ptoilet');
        $product->protype = $request->input('ptype');
        $product->price = $request->input('pPrice');
        $product->picture = $fileNametostore;
        $product->description = $request->input('pdetail');
        $product->save();

        return response("success", 200);
    }

    public function Getproperties(Request $request){
        $content = $request->input('status');

        if($content == "null"){
            $product = property::paginate(6);
            return response($product, 200);
        }
        else{
            $product = property::where('title', 'LIKE','%'.$content.'%')
                ->orWhere('location', 'LIKE','%'.$content.'%')
                ->orWhere('city', 'LIKE','%'.$content.'%')
                ->paginate(6);
            return response($product, 200);
        }

    }

    public function Viewproperty($id){
        $product = property::where('title', $id)->first();
        return response($product, 201);
    }

    public function Findproperty($keyword){

        $searched = property::where('title', 'LIKE','%'.$keyword.'%')
            ->orWhere('location', 'LIKE','%'.$keyword.'%')
            ->orWhere('city', 'LIKE','%'.$keyword.'%')
            ->get();

        if(count($searched) < 1)$searched = 0;

        return response($searched, 200);

    }

    public function Deleteproperty($id){
        $product = property::find($id);
        $product -> delete();
        return response(['message' => 'Property deleted successfully'], 200);
    }
}
