<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $query = "DROP PROCEDURE IF EXISTS `sp_syst_log`;

        CREATE PROCEDURE `sp_syst_log`(
            IN p_action CHAR(1),
            IN p_country_id SMALLINT,
            IN p_company_id SMALLINT,
            IN p_module_id SMALLINT,
            IN p_type_log_id SMALLINT,
            IN p_user_id SMALLINT,
            IN p_route VARCHAR(100),
            IN p_process VARCHAR(100),
            IN p_message VARCHAR(1000)
        )
        BEGIN
            DECLARE v_next_id BIGINT DEFAULT 0;
            DECLARE v_track_no INT DEFAULT 0;
            DECLARE v_full_error VARCHAR(255);
            DECLARE EXIT HANDLER  FOR SQLEXCEPTION,  NOT FOUND,  SQLWARNING

            BEGIN
                GET DIAGNOSTICS CONDITION 1 @errno = MYSQL_ERRNO, @sqlstate = RETURNED_SQLSTATE, @text = MESSAGE_TEXT;
                SET v_full_error = CONCAT('Error No: ', @errno, ' | State: ', @sqlstate, ' | Message: ', @text, ' | Track No: ', v_track_no);
                SELECT v_full_error;
                ROLLBACK;
            END;

            START TRANSACTION;
                CASE p_action
                    WHEN 'I' THEN
                        SET v_track_no = 1;
                        SET v_next_id = (
                            SELECT IFNULL(MAX(syst_log.id), 0) + 1 as next_id
                            FROM syst_log
                            WHERE syst_log.country_id = p_country_id
                            AND syst_log.company_id = p_company_id
                            AND syst_log.module_id = p_module_id
                        );

                        SET v_track_no = 2;
                        INSERT INTO syst_log (
                            syst_log.country_id,
                            syst_log.company_id,
                            syst_log.module_id,
                            syst_log.id,
                            syst_log.type_log_id,
                            syst_log.user_id,
                            syst_log.route,
                            syst_log.process,
                            syst_log.message,
                            syst_log.created_at,
                            syst_log.updated_at
                        ) VALUES (
                            p_country_id,
                            p_company_id,
                            p_module_id,
                            v_next_id,
                            p_type_log_id,
                            p_user_id,
                            p_route,
                            p_process,
                            p_message,
                            now(),
                            now()
                        );
                END CASE;
            COMMIT;
        END;";
        DB::unprepared($query);

        $query = "DROP PROCEDURE IF EXISTS `sp_buss_companies`;

        CREATE PROCEDURE `sp_buss_companies`(
          IN p_action CHAR(1),
          IN p_country_id SMALLINT,
          IN p_id SMALLINT,
          IN p_name VARCHAR(100),
          IN p_businessName VARCHAR(60),
          IN p_identification_type_id VARCHAR(1000),
          IN p_identification VARCHAR(30),
          IN p_email VARCHAR(100),
          IN p_address VARCHAR(120),
          IN p_telephone VARCHAR(20),
          IN p_cellphone VARCHAR(20),
          IN p_website VARCHAR(100),
          IN p_status TINYINT
        )
        BEGIN
            DECLARE v_next_id BIGINT DEFAULT 0;
            DECLARE v_track_no INT DEFAULT 0;
            DECLARE v_full_error VARCHAR(255);
            DECLARE EXIT HANDLER  FOR SQLEXCEPTION,  NOT FOUND,  SQLWARNING

            BEGIN
                GET DIAGNOSTICS CONDITION 1 @errno = MYSQL_ERRNO, @sqlstate = RETURNED_SQLSTATE, @text = MESSAGE_TEXT;
                SET v_full_error = CONCAT('Error No: ', @errno, ' | State: ', @sqlstate, ' | Message: ', @text, ' | Track No: ', v_track_no);
                SELECT v_full_error;
                ROLLBACK;
            END;

            START TRANSACTION;
                CASE p_action
                    WHEN 'S' THEN
                        SET v_track_no = 1;
                        SELECT
                            buss_companies.country_id,
                            buss_companies.id,
                            buss_companies.name,
                            buss_companies.businessName,
                            buss_companies.identification_type_id,
                            buss_companies.identification,
                            buss_companies.email,
                            buss_companies.address,
                            buss_companies.telephone,
                            buss_companies.cellphone,
                            buss_companies.website,
                            buss_companies.image,
                            buss_companies.imageExt,
                            buss_companies.status,
                            buss_companies.created_at,
                            buss_companies.updated_at
                        FROM buss_companies
                        WHERE
                            buss_companies.country_id = p_country_id;
                    WHEN 'I' THEN
                        SET v_track_no = 1;
                        SET v_next_id = (
                            SELECT IFNULL(MAX(buss_companies.id), 0) + 1 as next_id
                            FROM buss_companies
                            WHERE buss_companies.country_id = p_country_id
                        );

                        SET v_track_no = 2;
                        INSERT INTO buss_companies (
                            buss_companies.country_id,
                            buss_companies.id,
                            buss_companies.name,
                            buss_companies.businessName,
                            buss_companies.identification_type_id,
                            buss_companies.identification,
                            buss_companies.email,
                            buss_companies.address,
                            buss_companies.telephone,
                            buss_companies.cellphone,
                            buss_companies.website,
                            buss_companies.image,
                            buss_companies.imageExt,
                            buss_companies.status,
                            buss_companies.created_at,
                            buss_companies.updated_at
                        ) VALUES (
                            p_country_id,
                            v_next_id,
                            p_name,
                            p_businessName,
                            p_identification_type_id,
                            p_identification,
                            p_email,
                            p_address,
                            p_telephone,
                            p_cellphone,
                            p_website,
                            null,
                            null,
                            p_status,
                            now(),
                            now()
                        );
                    WHEN 'U' THEN
                        SET v_track_no = 1;
                        UPDATE buss_companies
                        SET
                            buss_companies.name = p_name,
                            buss_companies.businessName = p_businessName,
                            buss_companies.identification_type_id = p_identification_type_id,
                            buss_companies.identification = p_identification,
                            buss_companies.email = p_email,
                            buss_companies.address = p_address,
                            buss_companies.telephone = p_telephone,
                            buss_companies.cellphone = p_cellphone,
                            buss_companies.website = p_website,
                            buss_companies.status = p_status,
                            buss_companies.updated_at = now()
                        WHERE
                            buss_companies.country_id = p_country_id AND
                            buss_companies.id = p_id;
                    WHEN 'L' THEN
                        SET v_track_no = 1;
                        SELECT
                            buss_companies.country_id,
                            buss_companies.id,
                            buss_companies.name,
                            buss_companies.businessName,
                            buss_companies.identification_type_id,
                            buss_companies.identification,
                            buss_companies.email,
                            buss_companies.address,
                            buss_companies.telephone,
                            buss_companies.cellphone,
                            buss_companies.website,
                            buss_companies.image,
                            buss_companies.imageExt,
                            buss_companies.status,
                            buss_companies.created_at,
                            buss_companies.updated_at
                        FROM buss_companies
                        WHERE
                            buss_companies.country_id = p_country_id AND
                            buss_companies.id = p_id;
                END CASE;
            COMMIT;
        END;";
        DB::unprepared($query);

        $query = "DROP PROCEDURE IF EXISTS `sp_syst_branch_offices`;

        CREATE PROCEDURE `sp_syst_branch_offices`(
          IN p_action CHAR(1),
          IN p_country_id SMALLINT,
          IN p_company_id SMALLINT,
          IN p_id SMALLINT,
          IN p_name VARCHAR(100),
          IN p_email VARCHAR(100),
          IN p_address VARCHAR(120),
          IN p_telephone VARCHAR(20),
          IN p_cellphone VARCHAR(20),
          IN p_status TINYINT
        )
        BEGIN
            DECLARE v_next_id BIGINT DEFAULT 0;
            DECLARE v_track_no INT DEFAULT 0;
            DECLARE v_full_error VARCHAR(255);
            DECLARE EXIT HANDLER  FOR SQLEXCEPTION,  NOT FOUND,  SQLWARNING

            BEGIN
                GET DIAGNOSTICS CONDITION 1 @errno = MYSQL_ERRNO, @sqlstate = RETURNED_SQLSTATE, @text = MESSAGE_TEXT;
                SET v_full_error = CONCAT('Error No: ', @errno, ' | State: ', @sqlstate, ' | Message: ', @text, ' | Track No: ', v_track_no);
                SELECT v_full_error;
                ROLLBACK;
            END;

            START TRANSACTION;
                CASE p_action
                    WHEN 'S' THEN
                        SET v_track_no = 1;
                        SELECT
                            syst_branch_offices.country_id,
                            syst_branch_offices.company_id,
                            syst_branch_offices.id,
                            syst_branch_offices.name,
                            syst_branch_offices.email,
                            syst_branch_offices.address,
                            syst_branch_offices.telephone,
                            syst_branch_offices.cellphone,
                            syst_branch_offices.status,
                            syst_branch_offices.created_at,
                            syst_branch_offices.updated_at
                        FROM syst_branch_offices
                        WHERE
                            syst_branch_offices.country_id = p_country_id AND
                            syst_branch_offices.company_id = p_company_id;
                    WHEN 'I' THEN
                        SET v_track_no = 1;
                        SET v_next_id = (
                            SELECT IFNULL(MAX(syst_branch_offices.id), 0) + 1 as next_id
                            FROM syst_branch_offices
                            WHERE syst_branch_offices.country_id = p_country_id AND
                                  syst_branch_offices.company_id = p_company_id
                        );

                        SET v_track_no = 2;
                        INSERT INTO syst_branch_offices (
                            syst_branch_offices.country_id,
                            syst_branch_offices.company_id,
                            syst_branch_offices.id,
                            syst_branch_offices.name,
                            syst_branch_offices.email,
                            syst_branch_offices.address,
                            syst_branch_offices.telephone,
                            syst_branch_offices.cellphone,
                            syst_branch_offices.status,
                            syst_branch_offices.created_at,
                            syst_branch_offices.updated_at
                        ) VALUES (
                            p_country_id,
                            p_company_id,
                            v_next_id,
                            p_name,
                            p_email,
                            p_address,
                            p_telephone,
                            p_cellphone,
                            p_status,
                            now(),
                            now()
                        );
                    WHEN 'U' THEN
                        SET v_track_no = 1;
                        UPDATE syst_branch_offices
                        SET
                            syst_branch_offices.name = p_name,
                            syst_branch_offices.email = p_email,
                            syst_branch_offices.address = p_address,
                            syst_branch_offices.telephone = p_telephone,
                            syst_branch_offices.cellphone = p_cellphone,
                            syst_branch_offices.status = p_status,
                            syst_branch_offices.updated_at = now()
                        WHERE
                            syst_branch_offices.country_id = p_country_id AND
                            syst_branch_offices.company_id = p_company_id AND
                            syst_branch_offices.id = p_id;
                    WHEN 'L' THEN
                        SET v_track_no = 1;
                        SELECT
                            syst_branch_offices.country_id,
                            syst_branch_offices.company_id,
                            syst_branch_offices.id,
                            syst_branch_offices.name,
                            syst_branch_offices.email,
                            syst_branch_offices.address,
                            syst_branch_offices.telephone,
                            syst_branch_offices.cellphone,
                            syst_branch_offices.status,
                            syst_branch_offices.created_at,
                            syst_branch_offices.updated_at
                        FROM syst_branch_offices
                        WHERE
                            syst_branch_offices.country_id = p_country_id AND
                            syst_branch_offices.company_id = p_company_id AND
                            syst_branch_offices.id = p_id;
                END CASE;
            COMMIT;
        END;";
        DB::unprepared($query);

        $query = "DROP PROCEDURE IF EXISTS `sp_syst_cellars`;

        CREATE PROCEDURE `sp_syst_cellars`(
            IN p_action CHAR(1),
            IN p_country_id SMALLINT,
            IN p_company_id SMALLINT,
            IN p_branch_office_id SMALLINT,
            IN p_id SMALLINT,
            IN p_name VARCHAR(100),
            IN p_status TINYINT
        )
        BEGIN
            DECLARE v_next_id BIGINT DEFAULT 0;
            DECLARE v_track_no INT DEFAULT 0;
            DECLARE v_full_error VARCHAR(255);
            DECLARE EXIT HANDLER  FOR SQLEXCEPTION,  NOT FOUND,  SQLWARNING

            BEGIN
                GET DIAGNOSTICS CONDITION 1 @errno = MYSQL_ERRNO, @sqlstate = RETURNED_SQLSTATE, @text = MESSAGE_TEXT;
                SET v_full_error = CONCAT('Error No: ', @errno, ' | State: ', @sqlstate, ' | Message: ', @text, ' | Track No: ', v_track_no);
                SELECT v_full_error;
                ROLLBACK;
            END;

            START TRANSACTION;
                CASE p_action
                    WHEN 'S' THEN
                        SET v_track_no = 1;
                        SELECT
                            syst_cellars.country_id,
                            syst_cellars.company_id,
                            syst_cellars.branch_office_id,
                            syst_cellars.id,
                            syst_cellars.name,
                            syst_cellars.status,
                            syst_cellars.created_at,
                            syst_cellars.updated_at
                        FROM syst_cellars
                        WHERE syst_cellars.country_id = p_country_id AND
                              syst_cellars.company_id = p_company_id AND
                              syst_cellars.branch_office_id = p_branch_office_id;
                    WHEN 'I' THEN
                        SET v_track_no = 1;
                        SET v_next_id = (
                            SELECT IFNULL(MAX(syst_cellars.id), 0) + 1 as next_id
                            FROM syst_cellars
                            WHERE syst_cellars.country_id = p_country_id AND
                                  syst_cellars.company_id = p_company_id AND
                                  syst_cellars.branch_office_id = p_branch_office_id
                        );

                        SET v_track_no = 2;
                        INSERT INTO syst_cellars (
                            syst_cellars.country_id,
                            syst_cellars.company_id,
                            syst_cellars.branch_office_id,
                            syst_cellars.id,
                            syst_cellars.name,
                            syst_cellars.status,
                            syst_cellars.created_at,
                            syst_cellars.updated_at
                        ) VALUES (
                            p_country_id,
                            p_company_id,
                            p_branch_office_id,
                            v_next_id,
                            p_name,
                            p_status,
                            now(),
                            now()
                        );
                    WHEN 'U' THEN
                        SET v_track_no = 1;
                        UPDATE syst_cellars
                        SET
                            syst_cellars.name = p_name,
                            syst_cellars.status = p_status,
                            syst_cellars.updated_at = now()
                        WHERE
                            syst_cellars.country_id = p_country_id AND
                            syst_cellars.company_id = p_company_id AND
                            syst_cellars.branch_office_id = p_branch_office_id AND
                            syst_cellars.id = p_id;
                    WHEN 'L' THEN
                        SET v_track_no = 1;
                        SELECT
                            syst_cellars.country_id,
                            syst_cellars.company_id,
                            syst_cellars.branch_office_id,
                            syst_cellars.id,
                            syst_cellars.name,
                            syst_cellars.status,
                            syst_cellars.created_at,
                            syst_cellars.updated_at
                        FROM syst_cellars
                        WHERE
                            syst_cellars.country_id = p_country_id AND
                            syst_cellars.company_id = p_company_id AND
                            syst_cellars.branch_office_id = p_branch_office_id AND
                            syst_cellars.id = p_id;
                END CASE;
            COMMIT;
        END;";
        DB::unprepared($query);

        $query = "DROP PROCEDURE IF EXISTS `sp_inv_categories`;

        CREATE PROCEDURE `sp_inv_categories`(
            IN p_action CHAR(1),
            IN p_country_id SMALLINT,
            IN p_company_id SMALLINT,
            IN p_id SMALLINT,
            IN p_name VARCHAR(100),
            IN p_description VARCHAR(120),
            IN p_status TINYINT
        )
        BEGIN

            DECLARE v_next_id BIGINT DEFAULT 0;
            DECLARE v_track_no INT DEFAULT 0;
            DECLARE v_full_error VARCHAR(255);
            DECLARE EXIT HANDLER  FOR SQLEXCEPTION,  NOT FOUND,  SQLWARNING

            BEGIN
                GET DIAGNOSTICS CONDITION 1 @errno = MYSQL_ERRNO, @sqlstate = RETURNED_SQLSTATE, @text = MESSAGE_TEXT;
                SET v_full_error = CONCAT('Error No: ', @errno, ' | State: ', @sqlstate, ' | Message: ', @text, ' | Track No: ', v_track_no);
                SELECT v_full_error;
                ROLLBACK;
            END;

            START TRANSACTION;
                CASE p_action
                    WHEN 'S' THEN
                        SET v_track_no = 1;
                        SELECT
                            inv_categories.country_id,
                            inv_categories.company_id,
                            inv_categories.id,
                            inv_categories.name,
                            inv_categories.description,
                            inv_categories.status,
                            inv_categories.created_at,
                            inv_categories.updated_at
                        FROM
                            inv_categories
                        WHERE inv_categories.country_id = p_country_id
                            AND inv_categories.company_id = p_company_id;

                    WHEN 'I' THEN
                        SET v_track_no = 1;
                        SET v_next_id = (
                            SELECT
                            IFNULL(MAX(inv_categories.id), 0) + 1 as next_id
                            FROM inv_categories
                            WHERE inv_categories.country_id = p_country_id
                            AND inv_categories.company_id = p_company_id
                        );

                        SET v_track_no = 2;
                        INSERT INTO inv_categories (
                            inv_categories.country_id,
                            inv_categories.company_id,
                            inv_categories.id,
                            inv_categories.name,
                            inv_categories.description,
                            inv_categories.status,
                            inv_categories.created_at,
                            inv_categories.updated_at
                        )
                        VALUES
                        (
                            p_country_id,
                            p_company_id,
                            v_next_id,
                            p_name,
                            p_description,
                            p_status,
                            now(),
                            now()
                        );

                    WHEN 'U' THEN
                        SET v_track_no = 1;
                        UPDATE inv_categories
                        SET
                            inv_categories.name = p_name,
                            inv_categories.status = p_status,
                            inv_categories.updated_at = now()
                        WHERE inv_categories.country_id = p_country_id
                        AND inv_categories.company_id = p_company_id
                        AND inv_categories.id = p_id;

                    WHEN 'L' THEN
                    SET v_track_no = 1;
                    SELECT
                        inv_categories.country_id,
                        inv_categories.company_id,
                        inv_categories.id,
                        inv_categories.name,
                        inv_categories.description,
                        inv_categories.status,
                        inv_categories.created_at,
                        inv_categories.updated_at
                    FROM inv_categories
                    WHERE inv_categories.country_id = p_country_id
                    AND inv_categories.company_id = p_company_id
                    AND inv_categories.id = p_id;

                END CASE;
            COMMIT;
        END;";
        DB::unprepared($query);

        $query = "DROP PROCEDURE IF EXISTS `sp_inv_subcategories`;

        CREATE PROCEDURE `sp_inv_subcategories`(
            IN p_action CHAR(1),
            IN p_country_id SMALLINT,
            IN p_company_id SMALLINT,
            IN p_category_id SMALLINT,
            IN p_id SMALLINT,
            IN p_name VARCHAR(100),
            IN p_description VARCHAR(120),
            IN p_status TINYINT
          )

        BEGIN

            DECLARE v_next_id BIGINT DEFAULT 0;
            DECLARE v_track_no INT DEFAULT 0;
            DECLARE v_full_error VARCHAR(255);
            DECLARE EXIT HANDLER  FOR SQLEXCEPTION,  NOT FOUND,  SQLWARNING

            BEGIN
                GET DIAGNOSTICS CONDITION 1 @errno = MYSQL_ERRNO, @sqlstate = RETURNED_SQLSTATE, @text = MESSAGE_TEXT;
                SET v_full_error = CONCAT('Error No: ', @errno, ' | State: ', @sqlstate, ' | Message: ', @text, ' | Track No: ', v_track_no);
                SELECT v_full_error;
                ROLLBACK;
            END;

            START TRANSACTION;
                CASE p_action
                    WHEN 'S' THEN
                        SET v_track_no = 1;
                        SELECT
                            inv_subcategories.country_id,
                            inv_subcategories.company_id,
                            inv_subcategories.category_id,
                            inv_subcategories.id,
                            inv_subcategories.name,
                            inv_subcategories.description,
                            inv_subcategories.status,
                            inv_subcategories.created_at,
                            inv_subcategories.updated_at
                        FROM
                            inv_subcategories
                        WHERE inv_subcategories.country_id = p_country_id
                            AND inv_subcategories.company_id = p_company_id
                            AND inv_subcategories.category_id = p_category_id;

                    WHEN 'I' THEN
                        SET v_track_no = 1;
                        SET v_next_id = (
                            SELECT
                            IFNULL(MAX(inv_subcategories.id), 0) + 1 as next_id
                            FROM inv_subcategories
                            WHERE inv_subcategories.country_id = p_country_id
                            AND inv_subcategories.company_id = p_company_id
                            AND inv_subcategories.category_id = p_category_id
                        );

                        SET v_track_no = 2;
                        INSERT INTO inv_subcategories (
                            inv_subcategories.country_id,
                            inv_subcategories.company_id,
                            inv_subcategories.category_id,
                            inv_subcategories.id,
                            inv_subcategories.name,
                            inv_subcategories.description,
                            inv_subcategories.status,
                            inv_subcategories.created_at,
                            inv_subcategories.updated_at
                        )
                        VALUES
                        (
                            p_country_id,
                            p_company_id,
                            v_next_id,
                            p_name,
                            p_description,
                            p_status,
                            now(),
                            now()
                        );

                    WHEN 'U' THEN
                        SET v_track_no = 1;
                        UPDATE inv_subcategories
                        SET
                            inv_subcategories.name = p_name,
                            inv_subcategories.status = p_status,
                            inv_subcategories.updated_at = now()
                        WHERE inv_subcategories.country_id = p_country_id
                        AND inv_subcategories.company_id = p_company_id
                        AND inv_subcategories.category_id = p_category_id
                        AND inv_subcategories.id = p_id;

                    WHEN 'L' THEN
                    SET v_track_no = 1;
                    SELECT
                        inv_subcategories.country_id,
                        inv_subcategories.company_id,
                        inv_subcategories.category_id,
                        inv_subcategories.id,
                        inv_subcategories.name,
                        inv_subcategories.description,
                        inv_subcategories.status,
                        inv_subcategories.created_at,
                        inv_subcategories.updated_at
                    FROM inv_subcategories
                    WHERE inv_subcategories.country_id = p_country_id
                    AND inv_subcategories.company_id = p_company_id
                    AND inv_subcategories.category_id = p_category_id
                    AND inv_subcategories.id = p_id;

                END CASE;
            COMMIT;
        END;";
        DB::unprepared($query);

        $query = "DROP PROCEDURE IF EXISTS `sp_secu_users_has_buss_companies`;

        CREATE PROCEDURE `sp_secu_users_has_buss_companies`(
            IN p_action CHAR(1),
            IN p_country_id SMALLINT,
            IN p_company_id SMALLINT,
            IN p_user_id SMALLINT,
            IN p_main TINYINT
        )
        BEGIN
            DECLARE v_track_no INT DEFAULT 0;
            DECLARE v_full_error VARCHAR(255);
            DECLARE EXIT HANDLER  FOR SQLEXCEPTION,  NOT FOUND,  SQLWARNING

            BEGIN
                GET DIAGNOSTICS CONDITION 1 @errno = MYSQL_ERRNO, @sqlstate = RETURNED_SQLSTATE, @text = MESSAGE_TEXT;
                SET v_full_error = CONCAT('Error No: ', @errno, ' | State: ', @sqlstate, ' | Message: ', @text, ' | Track No: ', v_track_no);
                SELECT v_full_error;
                ROLLBACK;
            END;

            START TRANSACTION;
                CASE p_action
                    WHEN 'S' THEN
                        SET v_track_no = 1;
                        SELECT
                            secu_users_has_buss_companies.country_id,
                            secu_users_has_buss_companies.company_id,
                            secu_users_has_buss_companies.user_id,
                            secu_users_has_buss_companies.main
                        FROM secu_users_has_buss_companies
                        WHERE secu_users_has_buss_companies.country_id = p_country_id
                        AND secu_users_has_buss_companies.user_id = p_user_id;
                    WHEN 'I' THEN
                        SET v_track_no = 1;
                        INSERT INTO secu_users_has_buss_companies (
                            secu_users_has_buss_companies.country_id,
                            secu_users_has_buss_companies.company_id,
                            secu_users_has_buss_companies.user_id,
                            secu_users_has_buss_companies.main,
                            secu_users_has_buss_companies.created_at,
                            secu_users_has_buss_companies.updated_at
                        ) VALUES (
                            p_country_id,
                            p_company_id,
                            p_user_id,
                            p_main,
                            now(),
                            now()
                        );
                    WHEN 'U' THEN
                        SET v_track_no = 1;
                        UPDATE secu_users_has_buss_companies
                        SET secu_users_has_buss_companies.main = p_main
                        WHERE country_id = p_country_id
                        AND company_id = p_company_id
                        AND users_id = p_user_id;
                    WHEN 'D' THEN
                        SET v_track_no = 1;
                        DELETE FROM secu_users_has_buss_companies
                        WHERE country_id = p_country_id
                        AND users_id = p_user_id;
                END CASE;
            COMMIT;
        END;";
        DB::unprepared($query);


        $query = "DROP PROCEDURE IF EXISTS `sp_secu_users`;

        CREATE PROCEDURE `sp_secu_users`(
            IN p_action CHAR(1),
            IN p_id SMALLINT,
            IN p_name VARCHAR(100),
            IN p_email VARCHAR(100),
            IN p_password VARCHAR(100),
            IN p_language CHAR(2),
            IN p_status TINYINT
            )

        BEGIN

            DECLARE v_next_id BIGINT DEFAULT 0;
            DECLARE v_track_no INT DEFAULT 0;
            DECLARE v_full_error VARCHAR(255);
            DECLARE EXIT HANDLER  FOR SQLEXCEPTION,  NOT FOUND,  SQLWARNING

            BEGIN
                GET DIAGNOSTICS CONDITION 1 @errno = MYSQL_ERRNO, @sqlstate = RETURNED_SQLSTATE, @text = MESSAGE_TEXT;
                SET v_full_error = CONCAT('Error No: ', @errno, ' | State: ', @sqlstate, ' | Message: ', @text, ' | Track No: ', v_track_no);
                SELECT v_full_error;
                ROLLBACK;
            END;

            START TRANSACTION;
                CASE p_action
                    WHEN 'S' THEN
                        SET v_track_no = 1;
                        SELECT
                            users.id,
                            users.name,
                            users.email,
                            users.password,
                            users.language,
                            users.status,
                            users.created_at,
                            users.updated_at
                        FROM
                            users;

                    WHEN 'I' THEN
                        SET v_track_no = 1;
                        SET v_next_id = (
                            SELECT
                            IFNULL(MAX(users.id), 0) + 1 as next_id
                            FROM users
                            WHERE users.id = p_id
                        );

                        SET v_track_no = 2;
                        INSERT INTO users (
                            users.id,
                            users.name,
                            users.email,
                            users.password,
                            users.language,
                            users.status,
                            users.created_at,
                            users.updated_at
                        )
                        VALUES
                        (
                            v_next_id,
                            p_name,
                            p_email,
                            p_name,
                            p_password,
                            p_language,
                            p_status,
                            now(),
                            now()
                        );

                    WHEN 'U' THEN
                        SET v_track_no = 1;
                        UPDATE users
                        SET
                            users.name = p_name,
                            users.email = p_email,
                            users.password = p_password,
                            users.language = p_language,
                            users.status = p_status,
                            users.updated_at = now()
                        WHERE users.id = p_id;

                    WHEN 'L' THEN
                    SET v_track_no = 1;
                    SELECT
                        users.id,
                        users.name,
                        users.email,
                        users.password,
                        users.language,
                        users.status,
                        users.created_at,
                        users.updated_at
                    FROM users
                    WHERE users.id = p_id;

                END CASE;
            COMMIT;
        END;";
        DB::unprepared($query);

        $query = "DROP PROCEDURE IF EXISTS `sp_secu_users_change_language`;

        CREATE PROCEDURE `sp_secu_users_change_language`(
            IN p_action CHAR(1),
            IN p_id SMALLINT,
            IN p_language CHAR(2)
            )

        BEGIN
            DECLARE v_track_no INT DEFAULT 0;
            DECLARE v_full_error VARCHAR(255);
            DECLARE EXIT HANDLER  FOR SQLEXCEPTION,  NOT FOUND,  SQLWARNING

            BEGIN
                GET DIAGNOSTICS CONDITION 1 @errno = MYSQL_ERRNO, @sqlstate = RETURNED_SQLSTATE, @text = MESSAGE_TEXT;
                SET v_full_error = CONCAT('Error No: ', @errno, ' | State: ', @sqlstate, ' | Message: ', @text, ' | Track No: ', v_track_no);
                SELECT v_full_error;
                ROLLBACK;
            END;

            START TRANSACTION;
                CASE p_action
                    WHEN 'S' THEN
                        SET v_track_no = 1;
                        SELECT
                            users.id,
                            users.name,
                            users.language
                        FROM
                            users;
                    WHEN 'U' THEN
                        SET v_track_no = 1;
                        UPDATE users
                        SET
                            users.language = p_language,
                            users.updated_at = now()
                        WHERE users.id = p_id;

                    WHEN 'L' THEN
                    SET v_track_no = 1;
                    SELECT
                        users.id,
                        users.name,
                        users.language
                    FROM users
                    WHERE users.id = p_id;

                END CASE;
            COMMIT;
        END;";

        DB::unprepared($query);

        //$query = "";
        //DB::unprepared($query);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secu_users_has_buss_companies');
    }
};
