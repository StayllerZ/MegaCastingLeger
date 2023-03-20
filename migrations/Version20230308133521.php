<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308133521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Civilite (Identifiant INT IDENTITY NOT NULL, libelle NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE TABLE CiviliteOffre (IdentifiantCivilite INT NOT NULL, IdentifiantOffre INT NOT NULL, PRIMARY KEY (IdentifiantCivilite, IdentifiantOffre))');
        $this->addSql('CREATE INDEX IDX_1C25A7F3CDCDB2D5 ON CiviliteOffre (IdentifiantCivilite)');
        $this->addSql('CREATE INDEX IDX_1C25A7F3F4657399 ON CiviliteOffre (IdentifiantOffre)');
        $this->addSql('CREATE TABLE Client (Identifiant INT IDENTITY NOT NULL, nom NVARCHAR(255) NOT NULL, telephone NVARCHAR(255) NOT NULL, mail NVARCHAR(255) NOT NULL, password NVARCHAR(255) NOT NULL, url NVARCHAR(255) NOT NULL, siret NVARCHAR(255) NOT NULL, login NVARCHAR(255) NOT NULL, ville NVARCHAR(255) NOT NULL, IdentifiantPackCasting INT NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE INDEX IDX_C0E801632719DBC1 ON Client (IdentifiantPackCasting)');
        $this->addSql('CREATE TABLE Conseil (Identifiant INT IDENTITY NOT NULL, libelle NVARCHAR(255) NOT NULL, description NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE TABLE DomaineMetier (Identifiant INT IDENTITY NOT NULL, libelle NVARCHAR(255) NOT NULL, description NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE TABLE FicheMetier (Identifiant INT IDENTITY NOT NULL, libelle NVARCHAR(255) NOT NULL, description NVARCHAR(255) NOT NULL, IdentifiantMetier INT NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE INDEX IDX_202881CE525B950 ON FicheMetier (IdentifiantMetier)');
        $this->addSql('CREATE TABLE Interview (Identifiant INT IDENTITY NOT NULL, libelle NVARCHAR(255) NOT NULL, url NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE TABLE Metier (Identifiant INT IDENTITY NOT NULL, libelle NVARCHAR(255) NOT NULL, description NVARCHAR(255) NOT NULL, IdentifiantDomaineMetier INT NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE INDEX IDX_560C08BAE52D612A ON Metier (IdentifiantDomaineMetier)');
        $this->addSql('CREATE TABLE MetierConseil (IdentifiantMetier INT NOT NULL, IdentifiantConseil INT NOT NULL, PRIMARY KEY (IdentifiantMetier, IdentifiantConseil))');
        $this->addSql('CREATE INDEX IDX_B34210E1525B950 ON MetierConseil (IdentifiantMetier)');
        $this->addSql('CREATE INDEX IDX_B34210E1B00E1DCA ON MetierConseil (IdentifiantConseil)');
        $this->addSql('CREATE TABLE Offre (Identifiant INT IDENTITY NOT NULL, libelle NVARCHAR(255) NOT NULL, date_debut_casting DATETIME2(6) NOT NULL, date_fin_casting DATETIME2(6) NOT NULL, reference NVARCHAR(255) NOT NULL, localisation NVARCHAR(255) NOT NULL, age_minimum INT NOT NULL, age_maximum INT NOT NULL, description NVARCHAR(255) NOT NULL, IdentifiantTypeContrat INT NOT NULL, IdentifiantClient INT NOT NULL, IdentifiantMetier INT NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE INDEX IDX_6E47A96B9251261A ON Offre (IdentifiantTypeContrat)');
        $this->addSql('CREATE INDEX IDX_6E47A96B93C1B089 ON Offre (IdentifiantClient)');
        $this->addSql('CREATE INDEX IDX_6E47A96B525B950 ON Offre (IdentifiantMetier)');
        $this->addSql('CREATE TABLE PackCasting (Identifiant INT IDENTITY NOT NULL, libelle NVARCHAR(255) NOT NULL, nombre_offre INT NOT NULL, prix INT NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE TABLE PartenaireDiffusion (Identifiant INT IDENTITY NOT NULL, telephone NVARCHAR(255) NOT NULL, mail NVARCHAR(255) NOT NULL, nom NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('CREATE TABLE PartenaireDiffusionOffre (IdentifiantPartenaireDiffusion INT NOT NULL, IdentifiantOffre INT NOT NULL, PRIMARY KEY (IdentifiantPartenaireDiffusion, IdentifiantOffre))');
        $this->addSql('CREATE INDEX IDX_E50AB741F5A46F8 ON PartenaireDiffusionOffre (IdentifiantPartenaireDiffusion)');
        $this->addSql('CREATE INDEX IDX_E50AB74F4657399 ON PartenaireDiffusionOffre (IdentifiantOffre)');
        $this->addSql('CREATE TABLE TypeContrat (Identifiant INT IDENTITY NOT NULL, libelle NVARCHAR(255) NOT NULL, PRIMARY KEY (Identifiant))');
        $this->addSql('ALTER TABLE CiviliteOffre ADD CONSTRAINT FK_1C25A7F3CDCDB2D5 FOREIGN KEY (IdentifiantCivilite) REFERENCES Civilite (Identifiant)');
        $this->addSql('ALTER TABLE CiviliteOffre ADD CONSTRAINT FK_1C25A7F3F4657399 FOREIGN KEY (IdentifiantOffre) REFERENCES Offre (Identifiant)');
        $this->addSql('ALTER TABLE Client ADD CONSTRAINT FK_C0E801632719DBC1 FOREIGN KEY (IdentifiantPackCasting) REFERENCES PackCasting (Identifiant)');
        $this->addSql('ALTER TABLE FicheMetier ADD CONSTRAINT FK_202881CE525B950 FOREIGN KEY (IdentifiantMetier) REFERENCES Metier (Identifiant)');
        $this->addSql('ALTER TABLE Metier ADD CONSTRAINT FK_560C08BAE52D612A FOREIGN KEY (IdentifiantDomaineMetier) REFERENCES DomaineMetier (Identifiant)');
        $this->addSql('ALTER TABLE MetierConseil ADD CONSTRAINT FK_B34210E1525B950 FOREIGN KEY (IdentifiantMetier) REFERENCES Metier (Identifiant)');
        $this->addSql('ALTER TABLE MetierConseil ADD CONSTRAINT FK_B34210E1B00E1DCA FOREIGN KEY (IdentifiantConseil) REFERENCES Conseil (Identifiant)');
        $this->addSql('ALTER TABLE Offre ADD CONSTRAINT FK_6E47A96B9251261A FOREIGN KEY (IdentifiantTypeContrat) REFERENCES TypeContrat (Identifiant)');
        $this->addSql('ALTER TABLE Offre ADD CONSTRAINT FK_6E47A96B93C1B089 FOREIGN KEY (IdentifiantClient) REFERENCES Client (Identifiant)');
        $this->addSql('ALTER TABLE Offre ADD CONSTRAINT FK_6E47A96B525B950 FOREIGN KEY (IdentifiantMetier) REFERENCES Metier (Identifiant)');
        $this->addSql('ALTER TABLE PartenaireDiffusionOffre ADD CONSTRAINT FK_E50AB741F5A46F8 FOREIGN KEY (IdentifiantPartenaireDiffusion) REFERENCES PartenaireDiffusion (Identifiant)');
        $this->addSql('ALTER TABLE PartenaireDiffusionOffre ADD CONSTRAINT FK_E50AB74F4657399 FOREIGN KEY (IdentifiantOffre) REFERENCES Offre (Identifiant)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('ALTER TABLE CiviliteOffre DROP CONSTRAINT FK_1C25A7F3CDCDB2D5');
        $this->addSql('ALTER TABLE CiviliteOffre DROP CONSTRAINT FK_1C25A7F3F4657399');
        $this->addSql('ALTER TABLE Client DROP CONSTRAINT FK_C0E801632719DBC1');
        $this->addSql('ALTER TABLE FicheMetier DROP CONSTRAINT FK_202881CE525B950');
        $this->addSql('ALTER TABLE Metier DROP CONSTRAINT FK_560C08BAE52D612A');
        $this->addSql('ALTER TABLE MetierConseil DROP CONSTRAINT FK_B34210E1525B950');
        $this->addSql('ALTER TABLE MetierConseil DROP CONSTRAINT FK_B34210E1B00E1DCA');
        $this->addSql('ALTER TABLE Offre DROP CONSTRAINT FK_6E47A96B9251261A');
        $this->addSql('ALTER TABLE Offre DROP CONSTRAINT FK_6E47A96B93C1B089');
        $this->addSql('ALTER TABLE Offre DROP CONSTRAINT FK_6E47A96B525B950');
        $this->addSql('ALTER TABLE PartenaireDiffusionOffre DROP CONSTRAINT FK_E50AB741F5A46F8');
        $this->addSql('ALTER TABLE PartenaireDiffusionOffre DROP CONSTRAINT FK_E50AB74F4657399');
        $this->addSql('DROP TABLE Civilite');
        $this->addSql('DROP TABLE CiviliteOffre');
        $this->addSql('DROP TABLE Client');
        $this->addSql('DROP TABLE Conseil');
        $this->addSql('DROP TABLE DomaineMetier');
        $this->addSql('DROP TABLE FicheMetier');
        $this->addSql('DROP TABLE Interview');
        $this->addSql('DROP TABLE Metier');
        $this->addSql('DROP TABLE MetierConseil');
        $this->addSql('DROP TABLE Offre');
        $this->addSql('DROP TABLE PackCasting');
        $this->addSql('DROP TABLE PartenaireDiffusion');
        $this->addSql('DROP TABLE PartenaireDiffusionOffre');
        $this->addSql('DROP TABLE TypeContrat');
    }
}
