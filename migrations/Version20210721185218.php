<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721185218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD vet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F40369CAB FOREIGN KEY (vet_id) REFERENCES veterinaire (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F40369CAB ON animal (vet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F40369CAB');
        $this->addSql('DROP INDEX IDX_6AAB231F40369CAB ON animal');
        $this->addSql('ALTER TABLE animal DROP vet_id');
    }
}
