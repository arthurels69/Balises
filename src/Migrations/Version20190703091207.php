<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190703091207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()
                ->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE show_rate DROP FOREIGN KEY FK_31BE9FADFC51B88');
        $this->addSql('DROP INDEX UNIQ_31BE9FADFC51B88 ON show_rate');
        $this->addSql('ALTER TABLE show_rate DROP show_date_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()
                ->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE show_rate ADD show_date_id INT NOT NULL');
        $this->addSql('ALTER TABLE show_rate ADD CONSTRAINT FK_31BE9FADFC51B88 
                        FOREIGN KEY (show_date_id) REFERENCES show_date (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_31BE9FADFC51B88 ON show_rate (show_date_id)');
    }
}
