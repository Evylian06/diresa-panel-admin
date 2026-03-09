<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migración: gestantes
     * Incluye ubigeo peruano (región, provincia, distrito),
     * coordenadas GPS y campos clínicos.
     * Preparado para futura integración con SQL Server.
     */
    public function up(): void
    {
        Schema::create('gestantes', function (Blueprint $table) {

            $table->id();

            // ── Identificación ──────────────────────────────
            $table->string('tipo_documento', 10)->default('DNI')
                  ->comment('DNI, CE, PAS, etc.');
            $table->string('numero_documento', 20)->unique()
                  ->comment('Número de documento de identidad');

            // ── Datos personales ────────────────────────────
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 80);
            $table->string('apellido_materno', 80)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono', 15)->nullable();

            // ── Ubigeo peruano ──────────────────────────────
            // Código INEI de 6 dígitos (departamento + provincia + distrito)
            $table->string('ubigeo', 6)->nullable()
                  ->comment('Código INEI: 2 dpto + 2 prov + 2 dist, ej: 250101');
            $table->string('region', 60)->nullable()
                  ->comment('Departamento / Región, ej: Ucayali');
            $table->string('provincia', 60)->nullable()
                  ->comment('Provincia, ej: Coronel Portillo');
            $table->string('distrito', 60)->nullable()
                  ->comment('Distrito, ej: Callería');
            $table->string('direccion', 200)->nullable()
                  ->comment('Dirección exacta o referencia');

            // ── Coordenadas GPS ─────────────────────────────
            $table->decimal('latitud',  10, 7)->nullable()
                  ->comment('Latitud GPS, ej: -8.3791');
            $table->decimal('longitud', 10, 7)->nullable()
                  ->comment('Longitud GPS, ej: -74.5539');

            // ── Estado clínico ──────────────────────────────
            $table->enum('estado', ['Pendiente', 'Atendida', 'Emergencia', 'Finalizada'])
                  ->default('Pendiente');
            $table->enum('nivel_gravedad', ['Leve', 'Normal', 'Grave'])->default('Normal');

            // ── Semanas de gestación ────────────────────────
            $table->unsignedTinyInteger('semanas_gestacion')->nullable()
                  ->comment('Semanas de embarazo al momento del registro');

            // ── Fechas de gestión ───────────────────────────
            $table->dateTime('fecha_registro')->nullable()
                  ->comment('Fecha y hora en que se registró la alerta');
            $table->dateTime('fecha_atendido')->nullable()
                  ->comment('Fecha y hora en que fue atendida');
            $table->dateTime('fecha_finalizado')->nullable()
                  ->comment('Fecha y hora de cierre del caso');

            // ── Información clínica ─────────────────────────
            $table->text('reporte')->nullable()
                  ->comment('Reporte del personal de salud');
            $table->text('informacion_declarada')->nullable()
                  ->comment('Información declarada por la gestante o familiar');

            $table->timestamps();

            // ── Índices para consultas frecuentes ───────────
            $table->index('estado');
            $table->index('nivel_gravedad');
            $table->index('ubigeo');
            $table->index(['region', 'provincia', 'distrito']);
            $table->index('fecha_registro');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gestantes');
    }
};