<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Zahzah\ModuleRegional\Models\Citizenship\Country;
use Zahzah\ModuleRegional\ModuleRegional;

return new class extends Migration
{
   use Zahzah\LaravelSupport\Concerns\NowYouSeeMe;

    private $__table;

    public function __construct(){
        $this->__table = app(config('database.models.Country', Country::class));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $table_name = $this->__table->getTable();
        if (!$this->isTableExists()){
            Schema::create($table_name, function (Blueprint $table) {
                $table->id();
                $table->string('country_code',20)->nullable(false);
                $table->string('name')->nullable(false);
            });

            $countries = include_once(__DIR__.'/data/countries.php');
            ModuleRegional::useCountry()->adds($countries);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->__table->getTable());
    }
};
