<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210725112144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D7A122277E');
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D7C96291D6');
        $this->addSql('DROP INDEX IDX_902CC7D7C96291D6 ON note_vet');
        $this->addSql('DROP INDEX IDX_902CC7D7A122277E ON note_vet');
        $this->addSql('ALTER TABLE note_vet ADD membre_id INT NOT NULL, ADD vet_id INT NOT NULL, DROP membre_id_id, DROP vet_id_id');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D76A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D740369CAB FOREIGN KEY (vet_id) REFERENCES veterinaire (id)');
        $this->addSql('CREATE INDEX IDX_902CC7D76A99F74A ON note_vet (membre_id)');
        $this->addSql('CREATE INDEX IDX_902CC7D740369CAB ON note_vet (vet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D76A99F74A');
        $this->addSql('ALTER TABLE note_vet DROP FOREIGN KEY FK_902CC7D740369CAB');
        $this->addSql('DROP INDEX IDX_902CC7D76A99F74A ON note_vet');
        $this->addSql('DROP INDEX IDX_902CC7D740369CAB ON note_vet');
        $this->addSql('ALTER TABLE note_vet ADD membre_id_id INT NOT NULL, ADD vet_id_id INT NOT NULL, DROP membre_id, DROP vet_id');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D7A122277E FOREIGN KEY (vet_id_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE note_vet ADD CONSTRAINT FK_902CC7D7C96291D6 FOREIGN KEY (membre_id_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_902CC7D7C96291D6 ON note_vet (membre_id_id)');
        $this->addSql('CREATE INDEX IDX_902CC7D7A122277E ON note_vet (vet_id_id)');
    }
}
