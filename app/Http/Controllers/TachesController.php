<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\saveTacheRequest;
use App\Models\Taches;

class TachesController extends Controller
{
    public function index(){
        // recupere les taches
        $taches = Taches::latest()->paginate(1);
        return view('taches.index' , compact('taches'));
    }

    public function create(){
        return view('taches.create');
    }

    public function store(saveTacheRequest $request){
        $taches = new Taches();
        $taches->titre = $request->titre;
        $taches->description =$request->description;
        $taches->priorite = $request->priorite;
        $taches->save();
        return redirect()->route('taches.index')->with('success' , 'Tache Enregistrée avec succes');
    }


    public function destroy(Taches $tache)
     {
       $tache -> delete();
       return redirect()->route('taches.index')->with('success' , 'Tache Supprimée avec succes');
     }

     public function edit(Taches $tache){
       return view('taches.edit' , compact('tache'));
     }

     public function update(saveTacheRequest $request , Taches $tache){
         $tache->titre = $request->titre;
         $tache->description =$request->description;
         $tache->priorite = $request->priorite;
         $tache->update();
         return redirect()->route('taches.index')->with('success' , 'Tache Modifier avec succes');
     }


}
