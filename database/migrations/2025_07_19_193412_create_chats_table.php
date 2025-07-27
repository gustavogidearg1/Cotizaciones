<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('Nombre o alias del chat');
            $table->string('whatsapp_name')->nullable()->comment('Nombre mostrado en WhatsApp');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
