<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210630111456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, race VARCHAR(255) DEFAULT NULL, couleur VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, date_naissance DATE DEFAULT NULL, poids DOUBLE PRECISION DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, membre_id_id INT DEFAULT NULL, vet_id_id INT DEFAULT NULL, date DATE NOT NULL, time VARCHAR(255) NOT NULL, approved VARCHAR(255) NOT NULL, INDEX IDX_964685A6C96291D6 (membre_id_id), INDEX IDX_964685A6A122277E (vet_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_vet (id INT AUTO_INCREMENT NOT NULL, membre_id_id INT NOT NULL, vet_id_id INT NOT NULL, note INT NOT NULL, INDEX IDX_902CC7D7C96291D6 (membre_id_id), INDEX IDX_902CC7D7A122277E (vet_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, id_animal_id INT DEFAULT NULL, membre_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AF3C6779EA39031 (id_animal_id), INDEX IDX_AF3C67796A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, ref_animal TINYINT(1) NOT NULL, image TINYINT(1) NOT NULL, lieu TINYINT(1) NOT NULL, file TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinaire (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, pwd VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, lundi VARCHAR(255) NOT NULL, mardi VARCHAR(255) NOT NULL, mercredi VARCHAR(255) NOT NULL, jeudi VARCHAR(255) NOT NULL, vendredi VARCHAR(255) NOT NULL, samedi VARCHAR(255) NOT NULL, adr_cabinet VARCHAR(255) NOT NULL, num_pro VARCHAR(255) NOT NULL, num_fixe VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6C96291D6 FOREIGN KEY (membre_id_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6A122277E FOREIGN KEY (vet_id_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D7C96291D6 FOREIGN KEY (membre_id_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D7A122277E FOREIGN KEY (vet_id_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779EA39031 FOREIGN KEY (id_animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67796A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779EA39031');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6C96291D6');
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D7C96291D6');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67796A99F74A');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6A122277E');
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D7A122277E');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE note_vet');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE veterinaire');
    }
}
