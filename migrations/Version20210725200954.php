<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210725200954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D76A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D740369CAB FOREIGN KEY (vet_id) REFERENCES veterinaire (id)');
        $this->addSql('CREATE INDEX IDX_902CC7D76A99F74A ON note_vet (membre_id)');
        $this->addSql('CREATE INDEX IDX_902CC7D740369CAB ON note_vet (vet_id)');
        $this->addSql('ALTER TABLE publication ADD type_id INT DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD file VARCHAR(255) DEFAULT NULL, ADD location VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME NOT NULL, ADD titre VARCHAR(255) DEFAULT NULL, CHANGE description description MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_AF3C6779C54C8C93 ON publication (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D76A99F74A');
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D740369CAB');
        $this->addSql('DROP INDEX IDX_902CC7D76A99F74A ON note_vet');
        $this->addSql('DROP INDEX IDX_902CC7D740369CAB ON note_vet');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779C54C8C93');
        $this->addSql('DROP INDEX IDX_AF3C6779C54C8C93 ON publication');
        $this->addSql('ALTER TABLE publication DROP type_id, DROP image, DROP file, DROP location, DROP updated_at, DROP titre, CHANGE description description MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
