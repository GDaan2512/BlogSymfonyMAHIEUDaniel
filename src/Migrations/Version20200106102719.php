<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106102719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE topic DROP FOREIGN KEY FK_9D40DE1BFB88E14F');
        $this->addSql('DROP INDEX IDX_9D40DE1BFB88E14F ON topic');
        $this->addSql('ALTER TABLE topic ADD categorie_id INT DEFAULT NULL, DROP utilisateur_id, DROP type, DROP created_at, CHANGE titre titre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1BBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_9D40DE1BBCF5E72D ON topic (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE topic DROP FOREIGN KEY FK_9D40DE1BBCF5E72D');
        $this->addSql('DROP INDEX IDX_9D40DE1BBCF5E72D ON topic');
        $this->addSql('ALTER TABLE topic ADD utilisateur_id INT NOT NULL, ADD type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD created_at VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP categorie_id, CHANGE titre titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1BFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_9D40DE1BFB88E14F ON topic (utilisateur_id)');
    }
}
