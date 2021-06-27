<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622135026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, membre_id_id INT NOT NULL, vet_id_id INT NOT NULL, date DATE NOT NULL, time VARCHAR(255) NOT NULL, approved VARCHAR(255) NOT NULL, INDEX IDX_964685A6C96291D6 (membre_id_id), INDEX IDX_964685A6A122277E (vet_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6C96291D6 FOREIGN KEY (membre_id_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6A122277E FOREIGN KEY (vet_id_id) REFERENCES veterinaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE consultation');
    }
}
