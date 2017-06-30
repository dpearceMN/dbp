<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::connection('geo_data')->create('countries', function (Blueprint $table) {
            $table->char('id', 2)->unique();
            $table->char('iso_a3', 3)->unique();
            $table->char('fips', 2);
            $table->char('continent', 2);
            $table->string('name');
        });

        Schema::connection('geo_data')->create('languages', function (Blueprint $table) {
            $table->char('id',8)->primary();
            $table->char('iso',3)->nullable()->unique();
            $table->string('name');
            $table->string('level')->nullable();
            $table->string('maps')->nullable();
            $table->text('development')->nullable();
            $table->text('use')->nullable();
            $table->text('location')->nullable();
            $table->text('area')->nullable();
            $table->integer('population')->unsigned()->nullable();
            $table->text('population_notes')->nullable();
            $table->text('notes')->nullable();
            $table->text('typology')->nullable();
            $table->text('writing')->nullable();
            $table->text('description')->nullable();
            $table->integer('family_pk')->unsigned()->default(0)->nullable();
            $table->integer('father_pk')->unsigned()->default(0)->nullable();
            $table->integer('child_dialect_count')->unsigned()->default(0);
            $table->integer('child_family_count')->unsigned()->default(0);
            $table->integer('child_language_count')->unsigned()->default(0);
            $table->float('latitude',11,7)->nullable();
            $table->float('longitude',11,7)->nullable();
            $table->integer('pk')->unsigned()->default(0);
            $table->text('status')->nullable();
            $table->char('country_id',2)->nullable();
            $table->string('scope')->nullable();
        });

        Schema::connection('geo_data')->create('languages_translations', function (Blueprint $table) {
            $table->char('glotto_language', 8)->index();
            $table->foreign('glotto_language')->references('id')->on('languages')->onUpdate('cascade');
            $table->char('glotto_translation', 8)->index();
            $table->foreign('glotto_translation')->references('id')->on('languages')->onUpdate('cascade');
            $table->string('name');
        });

        Schema::connection('geo_data')->create('languages_altNames', function (Blueprint $table) {
            $table->char('glotto_id', 8)->index();
            $table->foreign('glotto_id')->references('id')->on('languages')->onUpdate('cascade');
            $table->string('name');
        });

        Schema::connection('geo_data')->create('languages_dialects', function (Blueprint $table) {
            $table->char('glotto_id', 8)->index();
            $table->foreign('glotto_id')->references('id')->on('languages')->onUpdate('cascade');
            $table->char('dialect_id', 8)->index()->nullable()->default(NULL);
            $table->text('name');
        });

        Schema::connection('geo_data')->create('languages_classifications', function (Blueprint $table) {
            $table->char('glotto_id', 8);
            $table->foreign('glotto_id')->references('id')->on('languages')->onUpdate('cascade');
            $table->char('classification_id', 8);
            $table->tinyInteger('order')->unsigned();
            $table->string('name');
        });

        Schema::connection('geo_data')->create('languages_codes', function (Blueprint $table) {
            $table->char('glotto_id', 8);
            $table->foreign('glotto_id')->references('id')->on('languages')->onUpdate('cascade');
            $table->string('source');
            $table->string('code');
        });

        Schema::connection('geo_data')->create('alphabets', function (Blueprint $table) {
            $table->char('script', 4)->unique()->index(); // ScriptSource/Iso ID
            $table->string('name');
            $table->boolean('requiresFont')->default(0);
	        $table->boolean('unicode')->default(1);
	        $table->string('unicodePDF')->nullable();
            $table->string('family');
            $table->string('type');
            $table->char('direction', 3); // rtl, ltr, ttb
            $table->string('directionNotes');
            $table->text('sample');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::connection('geo_data')->create('alphabet_language', function (Blueprint $table) {
            $table->char('script', 4)->index();
            $table->foreign('script')->references('script')->on('alphabets')->onUpdate('cascade');
            $table->char('glotto_id', 8)->index();
            $table->foreign('glotto_id')->references('id')->on('languages')->onUpdate('cascade');
        });

        Schema::connection('geo_data')->create('alphabet_fonts', function (Blueprint $table) {
            $table->char('script_id', 4);
            $table->foreign('script_id')->references('script')->on('alphabets')->onUpdate('cascade');
            $table->string('fontName');
            $table->string('fontFileName');
            $table->string('fontWeight');
            $table->boolean('italic')->default(0);
        });

        Schema::connection('geo_data')->create('country_translations', function (Blueprint $table) {
            $table->char('country_id', 2);
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
            $table->char('glotto_id', 8);
            $table->foreign('glotto_id')->references('id')->on('languages')->onUpdate('cascade');
            $table->string('name');
        });

        Schema::connection('geo_data')->create('country_regions', function (Blueprint $table) {
            $table->char('country_id', 2);
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
            $table->char('glotto_id', 8);
            $table->foreign('glotto_id')->references('id')->on('languages')->onUpdate('cascade');
            $table->string('name');
        });

        Schema::connection('geo_data')->create('country_language', function (Blueprint $table) {
            $table->char('country_id', 2);
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
            $table->char('glotto_id', 8);
            $table->foreign('glotto_id')->references('id')->on('languages')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('geo_data')->dropIfExists('alphabet_language');
        Schema::connection('geo_data')->dropIfExists('alphabet_fonts');
        Schema::connection('geo_data')->dropIfExists('alphabets');
        Schema::connection('geo_data')->dropIfExists('languages_translations');
        Schema::connection('geo_data')->dropIfExists('languages_codes');
        Schema::connection('geo_data')->dropIfExists('languages_classifications');
        Schema::connection('geo_data')->dropIfExists('languages_altNames');
        Schema::connection('geo_data')->dropIfExists('languages_dialects');
        Schema::connection('geo_data')->dropIfExists('country_regions');
        Schema::connection('geo_data')->dropIfExists('country_translations');
        Schema::connection('geo_data')->dropIfExists('country_language');
        Schema::connection('geo_data')->dropIfExists('languages');
        Schema::connection('geo_data')->dropIfExists('countries');
    }
}
