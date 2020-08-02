<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contracts');
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->boolean('sale');
            $table->boolean('rent');
            $table->foreignId('owner_id')->constrained("users")->onDelete("cascade");
            $table->boolean('owner_spouse')->default(false);
            $table->foreignId('owner_company_id')->constrained("companies")->nullable();
            $table->foreignId('acquirer_id')->constrained("users")->onDelete("cascade");
            $table->boolean('acquirer_spouse')->default(false);
            $table->foreignId('acquirer_company_id')->nullable()->constrained("companies")->onDelete("cascade");
            $table->foreignId('property_id')->constrained("properties")->onDelete("cascade");
            $table->double('price');
            $table->double('tribute');
            $table->double('condominium');
            $table->unsignedInteger('due_date');
            $table->unsignedInteger('deadline');
            $table->date('start_at');
            $table->string('status')->default('pending');
            
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
        Schema::dropIfExists('contracts');
    }
}
