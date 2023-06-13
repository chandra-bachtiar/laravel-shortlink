<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;
use App\Http\Requests\StoreShortlinkRequest;
use App\Http\Requests\UpdateShortlinkRequest;

class ShortlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreShortlinkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shortlink $shortlink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shortlink $shortlink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShortlinkRequest $request, Shortlink $shortlink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shortlink $shortlink)
    {
        //
    }
}
