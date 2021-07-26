<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726132029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, membre_id INT DEFAULT NULL, vet_id INT DEFAULT NULL, date DATE NOT NULL, time VARCHAR(255) NOT NULL, approved VARCHAR(255) NOT NULL, INDEX IDX_964685A66A99F74A (membre_id), INDEX IDX_964685A640369CAB (vet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_vet (id INT AUTO_INCREMENT NOT NULL, membre_id INT NOT NULL, vet_id INT NOT NULL, note INT NOT NULL, INDEX IDX_902CC7D76A99F74A (membre_id), INDEX IDX_902CC7D740369CAB (vet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinaire (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, pwd VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, lundi VARCHAR(255) NOT NULL, mardi VARCHAR(255) NOT NULL, mercredi VARCHAR(255) NOT NULL, jeudi VARCHAR(255) NOT NULL, vendredi VARCHAR(255) NOT NULL, samedi VARCHAR(255) NOT NULL, adrcabinet VARCHAR(255) NOT NULL, numpro VARCHAR(255) NOT NULL, numfixe VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A640369CAB FOREIGN KEY (vet_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D76A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D740369CAB FOREIGN KEY (vet_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE animal ADD vet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F40369CAB FOREIGN KEY (vet_id) REFERENCES veterinaire (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F40369CAB ON animal (vet_id)');
        $this->addSql('ALTER TABLE publication ADD titre VARCHAR(255) DEFAULT NULL, ADD views VARCHAR(255) DEFAULT NULL, ADD viewsno INT NOT NULL, CHANGE description description MEDIUMTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F40369CAB');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A640369CAB');
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D740369CAB');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE note_vet');
        $this->addSql('DROP TABLE veterinaire');
        $this->addSql('DROP INDEX IDX_6AAB231F40369CAB ON animal');
        $this->addSql('ALTER TABLE animal DROP vet_id');
        $this->addSql('ALTER TABLE publication DROP titre, DROP views, DROP viewsno, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
