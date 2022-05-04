<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function show(Request $request)
    {
        
        
        if(!$request->page) return redirect('/');

        if(view()->exists("{$request->page}")){

           
             return view("{$request->page}");
            

        }else{
           

            return view('errors.404',[], [404]);



        }
        
        

        
       
    }

}
