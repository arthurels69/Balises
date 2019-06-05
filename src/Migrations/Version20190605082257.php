<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605082257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD login_id INT NOT NULL, DROP login, DROP password, DROP role');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495CB2E05D FOREIGN KEY (login_id) REFERENCES theater (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495CB2E05D ON user (login_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495CB2E05D');
        $this->addSql('DROP INDEX UNIQ_8D93D6495CB2E05D ON user');
        $this->addSql('ALTER TABLE user ADD login VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD role SMALLINT NOT NULL, DROP login_id');
    }
}
