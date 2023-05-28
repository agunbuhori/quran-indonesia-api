<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\SurahDetailRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicAyahsResource;
use App\Http\Resources\TopicResource;
use App\Models\Topic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TopicResource::collection(Topic::all());
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
    public function store(StoreTopicRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SurahDetailRequest $request, Topic $topic)
    {
        return TopicAyahsResource::make($topic);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
