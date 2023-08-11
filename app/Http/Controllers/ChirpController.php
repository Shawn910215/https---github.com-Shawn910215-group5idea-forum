<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminat\Http\RedirectResponse;
use Illuminate\Http\RedirectResponse as HttpRedirectResponse;
use App\Models\Chirp;
use App\Models\ChirpComment;
use App\Models\ChirpUpvote;
use Illuminate\Support\Facades\Http;


class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): HttpRedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->chirps()->create($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        // dd($chirp); // Add this line for debugging
        return view('chirps.show-chirp-details', ['chirp' => $chirp]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp): View
    {
        $this->authorize('update', $chirp);

        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): HttpRedirectResponse
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): HttpRedirectResponse
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }

    public function upvote(Request $request, Chirp $chirp)
    {
        $user = auth()->user();

        if (!$chirp->upvotes()->where('user_id', $user->id)->exists()) {
            $upvote = new ChirpUpvote();

            // Associate the upvote with the chirp and the authenticated user
            $upvote->user()->associate($user);
            $chirp->upvotes()->save($upvote);
        }

        return redirect()->back()->with('success', 'Chirp upvoted successfully.');
    }


    public function comment(Request $request, Chirp $chirp)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new ChirpComment([
            'content' => $validated['content'],
        ]);

        // Associate the comment with the chirp and the authenticated user
        $comment->user()->associate(auth()->user());
        $chirp->comments()->save($comment);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function storeComment(Request $request, Chirp $chirp)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new ChirpComment([
            'content' => $validated['content'],
        ]);

        // Associate the comment with the chirp and the authenticated user
        $comment->user()->associate(auth()->user());
        $chirp->comments()->save($comment);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }


    
}
