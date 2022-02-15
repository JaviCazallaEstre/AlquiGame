<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207110801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juego ADD desarrolladora_id INT NOT NULL');
        $this->addSql('ALTER TABLE juego ADD plataforma_id INT NOT NULL');
        $this->addSql('ALTER TABLE juego ADD rango_edad_id INT NOT NULL');
        $this->addSql('ALTER TABLE juego ADD CONSTRAINT FK_F0EC403D2F0267C4 FOREIGN KEY (desarrolladora_id) REFERENCES desarrolladora (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE juego ADD CONSTRAINT FK_F0EC403DEB90E430 FOREIGN KEY (plataforma_id) REFERENCES plataforma (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE juego ADD CONSTRAINT FK_F0EC403D9B93AE87 FOREIGN KEY (rango_edad_id) REFERENCES rango_edad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F0EC403D2F0267C4 ON juego (desarrolladora_id)');
        $this->addSql('CREATE INDEX IDX_F0EC403DEB90E430 ON juego (plataforma_id)');
        $this->addSql('CREATE INDEX IDX_F0EC403D9B93AE87 ON juego (rango_edad_id)');
        $this->addSql('ALTER TABLE reservas ADD juego_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservas ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservas ADD CONSTRAINT FK_AA1DAB0113375255 FOREIGN KEY (juego_id) REFERENCES juego (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservas ADD CONSTRAINT FK_AA1DAB01DB38439E FOREIGN KEY (usuario_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AA1DAB0113375255 ON reservas (juego_id)');
        $this->addSql('CREATE INDEX IDX_AA1DAB01DB38439E ON reservas (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE juego DROP CONSTRAINT FK_F0EC403D2F0267C4');
        $this->addSql('ALTER TABLE juego DROP CONSTRAINT FK_F0EC403DEB90E430');
        $this->addSql('ALTER TABLE juego DROP CONSTRAINT FK_F0EC403D9B93AE87');
        $this->addSql('DROP INDEX IDX_F0EC403D2F0267C4');
        $this->addSql('DROP INDEX IDX_F0EC403DEB90E430');
        $this->addSql('DROP INDEX IDX_F0EC403D9B93AE87');
        $this->addSql('ALTER TABLE juego DROP desarrolladora_id');
        $this->addSql('ALTER TABLE juego DROP plataforma_id');
        $this->addSql('ALTER TABLE juego DROP rango_edad_id');
        $this->addSql('ALTER TABLE reservas DROP CONSTRAINT FK_AA1DAB0113375255');
        $this->addSql('ALTER TABLE reservas DROP CONSTRAINT FK_AA1DAB01DB38439E');
        $this->addSql('DROP INDEX IDX_AA1DAB0113375255');
        $this->addSql('DROP INDEX IDX_AA1DAB01DB38439E');
        $this->addSql('ALTER TABLE reservas DROP juego_id');
        $this->addSql('ALTER TABLE reservas DROP usuario_id');
    }
}
