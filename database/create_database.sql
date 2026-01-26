-- Script para crear la base de datos del Hostal Real La Molina
-- Ejecutar este script en MySQL Workbench o línea de comandos

-- Crear la base de datos con codificación UTF-8
CREATE DATABASE IF NOT EXISTS hostal_real_la_molina 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

-- Usar la base de datos
USE hostal_real_la_molina;

-- Verificar que se creó correctamente
SHOW DATABASES LIKE 'hostal_real_la_molina';

