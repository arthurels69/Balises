<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605092201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection
                ->getDatabasePlatform()
                ->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE show_date DROP FOREIGN KEY FK_7669E1B97DF5FA8B');
        $this->addSql('ALTER TABLE show_rate DROP FOREIGN KEY FK_31BE9FADFC51B88');
        $this->addSql('ALTER TABLE `show` DROP FOREIGN KEY FK_320ED901D70E4479');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495CB2E05D');
        $this->addSql('DROP TABLE param');
        $this->addSql('DROP TABLE `show`');
        $this->addSql('DROP TABLE show_date');
        $this->addSql('DROP TABLE show_rate');
        $this->addSql('DROP TABLE theater');
        $this->addSql('DROP INDEX UNIQ_8D93D6495CB2E05D ON user');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(180) NOT NULL, 
DROP login_id, CHANGE role roles JSON 
NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection
                ->getDatabasePlatform()
                ->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE param (id INT AUTO_INCREMENT 
NOT NULL, resale_coeff DOUBLE PRECISION NOT NULL, redistributed_coeff DOUBLE PRECISION 
NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE `show` (id INT AUTO_INCREMENT 
NOT NULL, theater_id INT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT 
NOT NULL COLLATE utf8mb4_unicode_ci, distribution LONGTEXT 
NOT NULL COLLATE utf8mb4_unicode_ci, mandatory_infos LONGTEXT 
DEFAULT NULL COLLATE utf8mb4_unicode_ci, image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, photo_credits 
VARCHAR(255) DEFAULT NULL 
COLLATE utf8mb4_unicode_ci, additional_infos LONGTEXT 
DEFAULT NULL COLLATE utf8mb4_unicode_ci, is_balise TINYINT(1) 
NOT NULL, offer_type SMALLINT DEFAULT NULL, mapado_link VARCHAR(255) 
DEFAULT NULL COLLATE utf8mb4_unicode_ci, base_rate 
DOUBLE PRECISION DEFAULT NULL, INDEX IDX_320ED901D70E4479 (theater_id), 
PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE show_date (id 
INT AUTO_INCREMENT NOT NULL, show_id_id INT NOT NULL, date DATETIME NOT 
NULL, INDEX IDX_7669E1B97DF5FA8B (show_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE show_rate (id INT AUTO_INCREMENT 
NOT NULL, show_date_id INT DEFAULT NULL, free_places_number INT DEFAULT NULL, discounted_rate INT DEFAULT 
NULL, INDEX IDX_31BE9FADFC51B88 (show_date_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE theater (id INT AUTO_INCREMENT 
NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(255) NOT NULL 
COLLATE utf8mb4_unicode_ci, address1 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, address2 
VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, zip_code INT NOT NULL, city VARCHAR(255) 
NOT NULL COLLATE utf8mb4_unicode_ci, phone_number VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, logo 
VARCHAR(255) NOT 
NULL COLLATE utf8mb4_unicode_ci, website VARCHAR(255) DEFAULT NULL 
COLLATE utf8mb4_unicode_ci, base_rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `show` ADD 
CONSTRAINT FK_320ED901D70E4479 FOREIGN KEY (theater_id) REFERENCES theater (id)');
        $this->addSql('ALTER TABLE show_date ADD 
CONSTRAINT FK_7669E1B97DF5FA8B FOREIGN KEY (show_id_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE show_rate ADD 
CONSTRAINT FK_31BE9FADFC51B88 FOREIGN KEY (show_date_id) REFERENCES show_date (id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD login_id INT NOT NULL, DROP email, CHANGE roles role JSON 
NOT NULL');
        $this->addSql('ALTER TABLE user ADD 
CONSTRAINT FK_8D93D6495CB2E05D FOREIGN KEY (login_id) REFERENCES theater (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495CB2E05D ON user (login_id)');
    }
}
