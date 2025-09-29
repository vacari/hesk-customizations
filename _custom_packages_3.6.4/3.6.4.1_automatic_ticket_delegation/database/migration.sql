-- HESK Plus 3.6.4.1 - Customer Category Assignment
-- Migration Script with Dynamic Table Prefix Detection
-- Data: Janeiro 2025

-- Detectar prefixo automaticamente consultando tabela users (sempre existe no HESK)
SET @table_prefix = (
    SELECT SUBSTRING(TABLE_NAME, 1, LOCATE('users', TABLE_NAME) - 1)
    FROM information_schema.TABLES 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME LIKE '%users'
    LIMIT 1
);

-- Verificar se encontrou o prefixo
SET @sql = CONCAT('ALTER TABLE `', @table_prefix, 'customers` ADD `customer_category` INT NULL AFTER `id`');

-- Executar o comando dinamicamente
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Comentário: Este campo será usado para associar automaticamente
-- a categoria do cliente ao ticket criado via e-mail