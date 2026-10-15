<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Page d'accueil : liste de toutes les catégories.
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('home', compact('categories'));
    }
}
