<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('computers', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
        });

        // Les catégories saisies en texte libre deviennent des lignes de la table categories.
        $names = DB::table('computers')->distinct()->pluck('category');

        foreach ($names as $name) {
            $categoryName = mb_substr(trim($name), 0, 100);

            DB::table('categories')->insertOrIgnore([
                'name' => $categoryName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('computers')
                ->where('category', $name)
                ->update([
                    'category_id' => DB::table('categories')->where('name', $categoryName)->value('id'),
                ]);
        }

        Schema::table('computers', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable(false)->change();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->dropColumn('category');
            $table->decimal('price', 8, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('computers', function (Blueprint $table) {
            $table->string('category')->default('')->after('name');
        });

        foreach (DB::table('categories')->get() as $category) {
            DB::table('computers')
                ->where('category_id', $category->id)
                ->update(['category' => $category->name]);
        }

        Schema::table('computers', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->string('category')->default(null)->change();
            $table->float('price')->change();
        });
    }
};
