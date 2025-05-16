<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AboutUsService;
use App\Http\Requests\AboutUsRequest;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    

    protected $aboutUsService;

    public function __construct(AboutUsService $aboutUsService)
    {
        $this->aboutUsService = $aboutUsService;
    }


    public function index()
    {

        $aboutUsEntries = AboutUs::all(); 
        // dd($aboutUsEntries);
        $aboutUsEntries->transform(function ($entry) {
            $entry->content = json_decode($entry->content, true); 
            return $entry;
        });

        // dd($aboutUsEntries);
        return view('admin.about-us.index', compact('aboutUsEntries'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   

     public function store(AboutUsRequest $request)
    {

        $content = $request->input('content');
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imagePath = $image->move(public_path('images/about-us'), $image->getClientOriginalName());
            // dd($imagePath);
            $imagePath = 'images/about-us/' . $image->getClientOriginalName();
        } else {
            $imagePath = null;
        }
// dd($imagePath);
        AboutUs::create([
            'title' => $request->title,
            'content' => json_encode($content),  // Encode content as JSON
            'image' => $imagePath,  // Store the image path in the database
        ]);

        // Redirect to the 'About Us' index page with a success message
        return redirect()->route('about-us.index')->with('success', 'About Us section created successfully.');
    }

        










    public function edit($id){
        // dd($id);
        $aboutUs = AboutUs::where('uuid', $id)->first(); 
        $aboutUs->content = json_decode($aboutUs->content, true); 

        // dd($aboutUs);
        return view('admin.about-us.edit', compact('aboutUs'));
    }

    /**
     * Display the specified resource.
     */
    public function showAboutUs()
    {
       
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
