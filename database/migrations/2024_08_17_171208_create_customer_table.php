<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Customer::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Customer::EMAIL)->unique();
            $table->string(Customer::FIRSTNAME)->nullable();
            $table->string(Customer::LASTNAME)->nullable();
            $table->string(Customer::PHONE)->nullable();
            $table->string(Customer::MOBILE)->nullable();
            $table->string(Customer::ADDRESS)->nullable();
            $table->string(Customer::ZIP)->nullable();
            $table->string(Customer::COUNTRY)->nullable();
            $table->integer(Customer::STATUS)->default(Customer::STATUS_UNSUBSCRIBED);
            $table->string(Customer::ZOHO_CUSTOMER_ID)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Customer::TABLE);
    }
};
