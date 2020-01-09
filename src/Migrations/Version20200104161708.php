<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200104161708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reponse ADD auteur_id INT NOT NULL, ADD topic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC760BB6FE6 FOREIGN KEY (auteur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71F55203D FOREIGN KEY (topic_id) REFERENCES topic (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC760BB6FE6 ON reponse (auteur_id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC71F55203D ON reponse (topic_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC760BB6FE6');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71F55203D');
        $this->addSql('DROP INDEX IDX_5FB6DEC760BB6FE6 ON reponse');
        $this->addSql('DROP INDEX IDX_5FB6DEC71F55203D ON reponse');
        $this->addSql('ALTER TABLE reponse DROP auteur_id, DROP topic_id');
    }
}
