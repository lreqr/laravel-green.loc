<?php

namespace App\Http\Controllers;

use App\Models\GreenListing;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GreenController extends Controller
{
    //Show All Listings
    public function index(): View
    {
        return view('listings.index', [
            'listings' => GreenListing::latest()->filter(request(['votes', 'tag', 'search']))->simplePaginate(6),
        ]);



    }
    //Show Single Listing
    public function show(GreenListing $listing): View
    {
        return view('listings.show', [
           'listing' => $listing,
        ]);

    }

    //Show Create Listing
    public function create(): View
    {
        return view('listings.create');
    }

    //Store Post
    public function store(Request $request): RedirectResponse
    {

        $formFields = $request->validate([
           'company' => ['required', Rule::unique('green_listings', 'company'), 'max:30'],
           'title' => ['required', 'max:30'],
           'location' => ['required', 'max:40'],
           'email' => ['required', 'email', Rule::unique('green_listings', 'email')],
           'website' => 'required',
           'tags' => 'required',
           'logo' => ['image', 'max:1024'],
           'description' => ['required', 'max:255'],
        ]);

        if ($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        GreenListing::create($formFields);

        return redirect('/')->with('message', 'Listings successfully created!');
    }

    //Show Edit Form
    public function edit(GreenListing $listing): View
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    //Update Listing
    public function update(Request $request, GreenListing $listing): RedirectResponse
    {
        //Make sure logged-in user is owner
        if ($listing->user_id != auth()->id()){
            abort('403', 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'company' => ['required', 'max:30'],
            'title' => ['required', 'max:30'],
            'location' => ['required', 'max:40'],
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'logo' => ['image', 'max:1024'],
            'description' => ['required', 'max:255'],
        ]);

        if ($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return redirect(route('listings.show', $listing->id))->with('message', 'Listings successfully updated!');
    }

    //Delete Listing
    public function destroy(GreenListing $listing)
    {
        //Make sure user is owner
        if ($listing->user_id != auth()->id()){
            abort('403', 'Unauthorized Action');
        }

        $listing->delete();
        return redirect(route('listings.manage'))->with('message', 'Listing deleted successfully');
    }

    public function manage(): View
    {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->get(),
        ]);
    }
}

