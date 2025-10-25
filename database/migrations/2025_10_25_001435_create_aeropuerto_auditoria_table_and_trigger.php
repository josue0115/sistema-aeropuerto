<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Migración para crear la tabla aeropuerto_auditoria y sus triggers.
 */
return new class extends Migration
{

    public function up(): void
    {
        // Crear tabla de auditoría para aeropuerto si no existe
        DB::statement('
            CREATE TABLE IF NOT EXISTS aeropuerto_auditoria (
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                IdAeropuerto VARCHAR(20) NOT NULL,
                NombreAeropuerto VARCHAR(50) NOT NULL,
                Pais VARCHAR(10) NULL,
                Ciudad VARCHAR(50) NULL,
                Estado VARCHAR(10) NULL,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL,
                deleted_at TIMESTAMP NULL,
                deleted_by VARCHAR(255) NULL,
                action VARCHAR(10) NOT NULL
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
        ');

        // Trigger para INSERT en aeropuerto
        DB::unprepared('
            CREATE TRIGGER IF NOT EXISTS aeropuerto_after_insert
            AFTER INSERT ON aeropuerto
            FOR EACH ROW
            BEGIN
                INSERT INTO aeropuerto_auditoria (
                    IdAeropuerto,
                    NombreAeropuerto,
                    Pais,
                    Ciudad,
                    Estado,
                    created_at,
                    action
                ) VALUES (
                    NEW.IdAeropuerto,
                    NEW.NombreAeropuerto,
                    NEW.Pais,
                    NEW.Ciudad,
                    NEW.Estado,
                    NOW(),
                    "INSERT"
                );
            END
        ');

        // Trigger para UPDATE en aeropuerto
        DB::unprepared('
            CREATE TRIGGER IF NOT EXISTS aeropuerto_after_update
            AFTER UPDATE ON aeropuerto
            FOR EACH ROW
            BEGIN
                INSERT INTO aeropuerto_auditoria (
                    IdAeropuerto,
                    NombreAeropuerto,
                    Pais,
                    Ciudad,
                    Estado,
                    created_at,
                    updated_at,
                    action
                ) VALUES (
                    OLD.IdAeropuerto,
                    OLD.NombreAeropuerto,
                    OLD.Pais,
                    OLD.Ciudad,
                    OLD.Estado,
                    OLD.created_at,
                    NOW(),
                    "UPDATE"
                );
            END
        ');

        // Trigger para DELETE en aeropuerto
        DB::unprepared('
            CREATE TRIGGER IF NOT EXISTS aeropuerto_after_delete
            AFTER DELETE ON aeropuerto
            FOR EACH ROW
            BEGIN
                INSERT INTO aeropuerto_auditoria (
                    IdAeropuerto,
                    NombreAeropuerto,
                    Pais,
                    Ciudad,
                    Estado,
                    created_at,
                    updated_at,
                    deleted_at,
                    deleted_by,
                    action
                ) VALUES (
                    OLD.IdAeropuerto,
                    OLD.NombreAeropuerto,
                    OLD.Pais,
                    OLD.Ciudad,
                    OLD.Estado,
                    OLD.created_at,
                    OLD.updated_at,
                    NOW(),
                    @current_user,
                    "DELETE"
                );
            END
        ');
    }

    public function down(): void
    {
        
     
    }
};
