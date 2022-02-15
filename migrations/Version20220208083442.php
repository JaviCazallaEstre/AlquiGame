<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220208083442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juego_genero (juego_id INT NOT NULL, genero_id INT NOT NULL, PRIMARY KEY(juego_id, genero_id))');
        $this->addSql('CREATE INDEX IDX_F49D9D3E13375255 ON juego_genero (juego_id)');
        $this->addSql('CREATE INDEX IDX_F49D9D3EBCE7B795 ON juego_genero (genero_id)');
        $this->addSql('ALTER TABLE juego_genero ADD CONSTRAINT FK_F49D9D3E13375255 FOREIGN KEY (juego_id) REFERENCES juego (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE juego_genero ADD CONSTRAINT FK_F49D9D3EBCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE juego_genero');
    }
}
