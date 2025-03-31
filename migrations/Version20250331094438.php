<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331094438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE requete 
            ADD COLUMN prix DOUBLE PRECISION DEFAULT NULL
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__requete AS SELECT id, created_at, type, deadline, title, description FROM requete');
        $this->addSql('DROP TABLE requete');
        $this->addSql('CREATE TABLE requete (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, type VARCHAR(255) NOT NULL, deadline DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO requete (id, created_at, type, deadline, title, description) SELECT id, created_at, type, deadline, title, description FROM __temp__requete');
        $this->addSql('DROP TABLE __temp__requete');
    }
}
