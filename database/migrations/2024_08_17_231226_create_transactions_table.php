<?php

use App\Models\Transactions;
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
        Schema::create(Transactions::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(Transactions::CUSTOMER_ID)->nullable();
            $table->string(Transactions::ZOHO_SUBSCRIPTION_ID)->nullable();
            $table->string(Transactions::HOSTED_PAGE_ID)->nullable();
            $table->string(Transactions::PLAN_CODE)->nullable();
            $table->decimal(Transactions::PRICE)->nullable();
            $table->integer(Transactions::STATUS)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Transactions::TABLE);
    }
};
