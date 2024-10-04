<?php

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
        Schema::create('task_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // recordemos que el función constrained nos permite guardar y correlación e integridad en las relaciones de los datos
            // acontinuación crearemos los permisos de las tareas compartidas
            $table->enum('permision', ['view', 'edit'])->default('view'); // en esta línea creamos en la tabla un campo permiso que solo 
            // podrá tomar los valores dados view y edit, y posteriormente asignamos por defecto que solo se pueda ver
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_user');
    }
};
