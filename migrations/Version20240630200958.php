<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240630200958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE facture_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE devis_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ligne_devis_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ligne_facture_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE report_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE report (id INT NOT NULL, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, number_of_clients INT NOT NULL, number_of_invoices INT NOT NULL, number_of_quotes INT NOT NULL, total_earned NUMERIC(1, 2) NOT NULL, revenue NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN report.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT fk_29a5ec2712469de2');
        $this->addSql('ALTER TABLE devis DROP CONSTRAINT fk_8b27c52b19eb6921');
        $this->addSql('ALTER TABLE ligne_facture DROP CONSTRAINT fk_611f5a297f2dee08');
        $this->addSql('ALTER TABLE ligne_facture DROP CONSTRAINT fk_611f5a29f347efb');
        $this->addSql('ALTER TABLE facture DROP CONSTRAINT fk_fe86641041defada');
        $this->addSql('ALTER TABLE facture DROP CONSTRAINT fk_fe86641019eb6921');
        $this->addSql('ALTER TABLE ligne_devis DROP CONSTRAINT fk_888b2f1b41defada');
        $this->addSql('ALTER TABLE ligne_devis DROP CONSTRAINT fk_888b2f1bf347efb');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE ligne_facture');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE ligne_devis');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE report_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE facture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE devis_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ligne_devis_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ligne_facture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE produit (id INT NOT NULL, category_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_29a5ec2712469de2 ON produit (category_id)');
        $this->addSql('CREATE TABLE devis (id INT NOT NULL, client_id INT NOT NULL, date_devis TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, total_ht NUMERIC(10, 2) NOT NULL, total_ttc NUMERIC(10, 2) NOT NULL, total_tva NUMERIC(10, 2) NOT NULL, remise NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_8b27c52b19eb6921 ON devis (client_id)');
        $this->addSql('CREATE TABLE ligne_facture (id INT NOT NULL, facture_id INT NOT NULL, produit_id INT NOT NULL, quantite INT NOT NULL, prix_ht NUMERIC(10, 2) NOT NULL, prix_ttc NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_611f5a29f347efb ON ligne_facture (produit_id)');
        $this->addSql('CREATE INDEX idx_611f5a297f2dee08 ON ligne_facture (facture_id)');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, category VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE facture (id INT NOT NULL, devis_id INT NOT NULL, client_id INT NOT NULL, date_facture TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, total_ht NUMERIC(10, 2) NOT NULL, total_ttc NUMERIC(10, 2) NOT NULL, total_tva NUMERIC(10, 2) NOT NULL, remise NUMERIC(10, 2) NOT NULL, date_echeance TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, statut_paiement VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_fe86641019eb6921 ON facture (client_id)');
        $this->addSql('CREATE INDEX idx_fe86641041defada ON facture (devis_id)');
        $this->addSql('CREATE TABLE ligne_devis (id INT NOT NULL, devis_id INT NOT NULL, produit_id INT NOT NULL, quantite INT NOT NULL, prix_ht NUMERIC(10, 2) NOT NULL, prix_ttc NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_888b2f1bf347efb ON ligne_devis (produit_id)');
        $this->addSql('CREATE INDEX idx_888b2f1b41defada ON ligne_devis (devis_id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT fk_29a5ec2712469de2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT fk_8b27c52b19eb6921 FOREIGN KEY (client_id) REFERENCES clients (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ligne_facture ADD CONSTRAINT fk_611f5a297f2dee08 FOREIGN KEY (facture_id) REFERENCES facture (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ligne_facture ADD CONSTRAINT fk_611f5a29f347efb FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT fk_fe86641041defada FOREIGN KEY (devis_id) REFERENCES devis (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT fk_fe86641019eb6921 FOREIGN KEY (client_id) REFERENCES clients (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ligne_devis ADD CONSTRAINT fk_888b2f1b41defada FOREIGN KEY (devis_id) REFERENCES devis (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ligne_devis ADD CONSTRAINT fk_888b2f1bf347efb FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE report');
    }
}
