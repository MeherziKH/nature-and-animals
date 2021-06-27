<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622110808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, id_vet_id INT NOT NULL, date DATE NOT NULL, time VARCHAR(255) NOT NULL, aprouved VARCHAR(255) NOT NULL, INDEX IDX_964685A6EAAC4B6D (id_membre_id), INDEX IDX_964685A666012946 (id_vet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_vet (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, id_vet_id INT NOT NULL, note INT NOT NULL, INDEX IDX_902CC7D7EAAC4B6D (id_membre_id), INDEX IDX_902CC7D766012946 (id_vet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinaire (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, pwd VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, lundi VARCHAR(255) NOT NULL, mardi VARCHAR(255) NOT NULL, mercredi VARCHAR(255) NOT NULL, jeudi VARCHAR(255) NOT NULL, vendredi VARCHAR(255) NOT NULL, samedi VARCHAR(255) NOT NULL, adr_cabinet VARCHAR(255) NOT NULL, num_pro VARCHAR(255) NOT NULL, num_fixe VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A666012946 FOREIGN KEY (id_vet_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D7EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D766012946 FOREIGN KEY (id_vet_id) REFERENCES veterinaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A666012946');
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D766012946');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE note_vet');
        $this->addSql('DROP TABLE veterinaire');
    }
}
