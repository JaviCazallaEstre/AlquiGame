<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220206165921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE desarrolladora_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE genero_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE juego_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rango_edad_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE desarrolladora (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE genero (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE juego (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, precio DOUBLE PRECISION NOT NULL, foto VARCHAR(255) NOT NULL, video VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rango_edad (id INT NOT NULL, edad VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reservas (id INT NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE NOT NULL, precio DOUBLE PRECISION NOT NULL, fecha_devolucion DATE DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE desarrolladora_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE genero_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE juego_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rango_edad_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservas_id_seq CASCADE');
        $this->addSql('DROP TABLE desarrolladora');
        $this->addSql('DROP TABLE genero');
        $this->addSql('DROP TABLE juego');
        $this->addSql('DROP TABLE rango_edad');
        $this->addSql('DROP TABLE reservas');
    }
}
