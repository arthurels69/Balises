<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190531115829 extends AbstractMigration
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

        $this->addSql('CREATE TABLE `show` (id INT AUTO_INCREMENT NOT NULL,
            theater_id INT NOT NULL, title VARCHAR(255) NOT NULL,
            description LONGTEXT NOT NULL, distribution LONGTEXT NOT NULL,
            mandatory_infos LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL,
            photo_credits VARCHAR(255) DEFAULT NULL,
            additional_infos LONGTEXT DEFAULT NULL, is_balise TINYINT(1) NOT NULL,
            offer_type SMALLINT DEFAULT NULL,
            mapado_link VARCHAR(255) DEFAULT NULL, base_rate DOUBLE PRECISION DEFAULT NULL,
            INDEX IDX_320ED901D70E4479 (theater_id),
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL,
            login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL,
            role SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER
            SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE show_rate (id INT AUTO_INCREMENT NOT NULL,
         free_places_number INT DEFAULT NULL,
         discounted_rate INT DEFAULT NULL, PRIMARY KEY(id))
         DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE param (id INT AUTO_INCREMENT NOT NULL,
            resale_coeff DOUBLE PRECISION NOT NULL, redistributed_coeff DOUBLE PRECISION NOT NULL,
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theater (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL, address1 VARCHAR(255) NOT NULL,
            address2 VARCHAR(255) DEFAULT NULL, zip_code INT NOT NULL, city VARCHAR(255) NOT NULL,
            phone_number VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL,
            base_rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER
            SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE show_date (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL,
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `show` ADD
            CONSTRAINT FK_320ED901D70E4479 FOREIGN KEY (theater_id) REFERENCES theater (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection
            ->getDatabasePlatform()
            ->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `show` DROP FOREIGN KEY FK_320ED901D70E4479');
        $this->addSql('DROP TABLE `show`');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE show_rate');
        $this->addSql('DROP TABLE param');
        $this->addSql('DROP TABLE theater');
        $this->addSql('DROP TABLE show_date');
    }
}
