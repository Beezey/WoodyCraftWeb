<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Page d'une catégorie : uniquement ses ordinateurs.
     * Une catégorie inexistante renvoie une erreur 404 (liaison de modèle de la route).
     */
    public function show(Category $category)
    {
        $computers = $category->computers()->orderBy('name')->get();
        return view('categories.show', compact('category', 'computers'));
    }
}
