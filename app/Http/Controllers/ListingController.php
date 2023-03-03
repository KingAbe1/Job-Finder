<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Shows all job listing
    public function index()
    {
        return view('listings.index', [
            'job_list' => Listing::latest()->filter(request(['tags', 'search']))->simplePaginate(2)
        ]);
    }

    //Shows single job post
    public function show(Listing $id)
    {
        return view('listings.show', [
            'result' => $id
        ]);
    }

    //Show job application forn
    public function create()
    {
        return view('listings.create');
    }

    //Create job application
    public function store(Request $request)
    {
        $fromFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'logo' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $fromFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $fromFields['user_id'] = auth()->id();

        Listing::create($fromFields);

        return redirect('/')->with('message', 'Listing Created Successfully');
    }

    public function edit(Listing $id)
    {
        // dd($id);
        return view('listings.edit', ['listing' => $id]);
    }

    public function update(Request $request,Listing $id)
    {
        if($request->user_id != auth()->id()){
            abort('403','Unauthorized Action');
        }
        $fromFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $fromFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $id->update($fromFields);

        return back()->with('message', 'Listing Updated Successfully');
    }

    public function destroy(Listing $id){
        // if($id->user_id != auth()->id()){
        //     abort('403','Unauthorized Action');
        // }

        dd(auth()->user());

        $id->delete();

        return redirect('/')->with('message','Listing Deleted Successfully');
    }

    public function manage(){
        return view('listings.manage',['listings' => auth()->user()->listings()->get()]);
    }
}
