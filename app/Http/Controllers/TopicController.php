<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Topic;

use Validator;


use Illuminate\Http\Request;

class TopicController extends Controller
{


    public function index()
    {
        $topic = Topic::orderBy('id','desc')->get();
        return view('index', ['topic' => $topic]);
    }

    public function create()
    {  
        return view('create');
    }

    public function store(Request $request)
    {
    	 $validator = Validator::make($request->all(), [
            'titre' => 'required|max:75',
            'message' => 'required|min:10',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $topic = new Topic;
        $topic->titre = $request->titre;
        $topic->message = $request->message;
        $topic->save();
        return redirect()->route('home');
    }

    public function show($id)
    {
        $topic = Topic::find($id);
        return view('edit', ['topic' => $topic]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|max:75',
            'message' => 'required|min:10',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $topic = Topic::find($id);
        $topic->titre = $request->titre;
        $topic->message = $request->message;

        $topic->save();
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        $topic = Topic::find($id);
        $topic->delete();
   
        return redirect()->route('home');
 	}
    
    public function comment(Request $request,$id) {

    	 $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $commentaire = new Commentaire;
        $commentaire->message = $request->message;
        $topic->message = $request->message;
        $commentaire->save();
        return redirect()->route('index');

        //dd($specificVoyage);
        return view('index', ['specific_voyage' => $specificVoyage]);
    }

    public function search(Request $request) {
        $search = $request->search;
        $searched_topic = Topic::where('titre','LIKE','%'.$search."%")->get();
        return view('index', ['searched_topic' => $searched_voyages]);
    }

}
