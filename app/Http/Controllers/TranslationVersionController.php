<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTranslationVersionRequest;
use App\Http\Requests\UpdateTranslationVersionRequest;
use App\Http\Resources\TranslationVersionResource;
use App\Models\TranslationVersion;

class TranslationVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TranslationVersionResource::collection(TranslationVersion::all());
    }
}
