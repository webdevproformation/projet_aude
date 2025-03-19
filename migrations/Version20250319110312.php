<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250319110312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('
            CREATE TABLE genre_requete (
            genre_id INTEGER NOT NULL, 
            requete_id INTEGER NOT NULL, 
            PRIMARY KEY(genre_id, requete_id), 
            CONSTRAINT FK_25E3AA524296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
            CONSTRAINT FK_25E3AA5218FB544F FOREIGN KEY (requete_id) REFERENCES requete (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_25E3AA524296D31F ON genre_requete (genre_id)');
        $this->addSql('CREATE INDEX IDX_25E3AA5218FB544F ON genre_requete (requete_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE genre_requete');
    }
}
