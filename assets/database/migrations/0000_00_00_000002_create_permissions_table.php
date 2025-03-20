<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Zahzah\LaravelPermission\Enums\Permission\Type;
use Zahzah\LaravelSupport\Concerns\NowYouSeeMe;
use Zahzah\LaravelPermission\Models\Permission\Permission;

return new class extends Migration
{
    use NowYouSeeMe;

    private $__table;

    public function __construct(){
        $this->__table = app(config('database.models.Permission', Permission::class));
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $table_name = $this->__table->getTableName();
        if (!$this->isTableExists()){
            Schema::create($table_name, function (Blueprint $table) {
                $table->id();
                $table->string('name',200)->nullable(false);
                $table->string('alias',100)->nullable(false);                
                $table->string('root',255)->nullable(true);
                $table->enum('type',array_column(Type::cases(),'value'))->default(Type::PERMISSION->value);
                $table->boolean('visibility')->default(1);
                $table->string('guard_name',50)->nullable()->index();
                $table->json('props')->nullable();
            });

            Schema::table($table_name, function (Blueprint $table) use ($table_name){
                $table->foreignIdFor($this->__table,'parent_id')
                      ->nullable()->after('id')
                      ->index()->constrained($table_name)
                      ->cascadeOnUpdate()->restrictOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->__table->getTableName());
    }
};
