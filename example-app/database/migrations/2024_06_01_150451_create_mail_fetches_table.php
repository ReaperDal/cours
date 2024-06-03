<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailFetchesTable extends Migration
{
    public function up()
    {
        Schema::create('mail_fetches', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('mail_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mail_fetches');
    }
}

