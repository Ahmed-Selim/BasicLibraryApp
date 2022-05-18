<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('title')->unique();
            $table->unsignedInteger('price')->default(0);
            $table->boolean('available')->default(true);
            $table->foreignId('author_id')->constrained('authors','author_id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories','category_id')->onDelete('cascade');
            $table->foreignId('language_id')->constrained('languages','language_id')->onDelete('cascade');
            $table->year('publication_year')->default( Carbon::now()->year );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
