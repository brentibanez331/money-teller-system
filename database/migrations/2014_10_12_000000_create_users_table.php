<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_user_types', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
        });

        Schema::create('tbl_branch_profile', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name');
            $table->string('branch_code');
            $table->string('country_iso_code');
            $table->string('currency');
        });

        Schema::create('tbl_transaction_fees', function (Blueprint $table) {
            $table->id();
            $table->float('min_amt');
            $table->float('max_amt');
            $table->float('rates');
        });

        Schema::create('tbl_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_contact')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_contact')->nullable();
            $table->string('transaction_type')->nullable();
            $table->float('amount_local_currency')->nullable();
            $table->string('original_currency')->nullable();
            $table->string('currency_conversion_code')->nullable();
            $table->float('amount_converted')->nullable();
            $table->string('transaction_status')->nullable()->default("PENDING");
            $table->unsignedBigInteger('branch_sent')->nullable();
            $table->unsignedBigInteger('branch_received')->nullable();
            $table->unsignedBigInteger('transfer_fee_id')->nullable();
            $table->dateTime('datetime_transaction')->nullable();

            $table->foreign('branch_sent')->references('id')->on('tbl_branch_profile')->onDelete('cascade');
            $table->foreign('branch_received')->references('id')->on('tbl_branch_profile')->onDelete('cascade');
            $table->foreign('transfer_fee_id')->references('id')->on('tbl_transaction_fees')->onDelete('cascade');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthdate')->nullable();
            $table->string('full_address')->nullable();
            $table->float('balance')->nullable()->default(10000);
            $table->unsignedBigInteger('user_type_id')->default(2);
            $table->unsignedBigInteger('branch_assigned')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_type_id')->references('id')->on('tbl_user_types')->onDelete('cascade');
            $table->foreign('branch_assigned')->references('id')->on('tbl_branch_profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_user_type_id_foreign');
            $table->dropForeign('users_branch_assigned_foreign');
        });
    
        Schema::table('tbl_transactions', function (Blueprint $table) {
            $table->dropForeign('tbl_transactions_branch_sent_foreign');
            $table->dropForeign('tbl_transactions_branch_received_foreign');
            $table->dropForeign('tbl_transactions_transfer_fee_id_foreign');
        });

        Schema::dropIfExists('users');
        Schema::dropIfExists('tbl_user_types');
        Schema::dropIfExists('tbl_branch_profile');
        Schema::dropIfExists('tbl_transaction_fees');
        Schema::dropIfExists('tbl_transactions');
    }
};
