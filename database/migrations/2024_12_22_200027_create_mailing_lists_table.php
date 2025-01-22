<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailingListsTable extends Migration
{
    public function up()
    {
        Schema::create('mailing_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('emails'); // JSON formatında e-posta listesi saklar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mailing_lists');
    }
}
