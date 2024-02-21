<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221022757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pack_personnaliser ADD pack_id INT DEFAULT NULL, ADD programme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pack_personnaliser ADD CONSTRAINT FK_A299BCFB1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id_pack)');
        $this->addSql('ALTER TABLE pack_personnaliser ADD CONSTRAINT FK_A299BCFB62BB7AEE FOREIGN KEY (programme_id) REFERENCES programme (id_prog)');
        $this->addSql('CREATE INDEX IDX_A299BCFB1919B217 ON pack_personnaliser (pack_id)');
        $this->addSql('CREATE INDEX IDX_A299BCFB62BB7AEE ON pack_personnaliser (programme_id)');
        $this->addSql('ALTER TABLE programme CHANGE discription_programme description_programme VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pack_personnaliser DROP FOREIGN KEY FK_A299BCFB1919B217');
        $this->addSql('ALTER TABLE pack_personnaliser DROP FOREIGN KEY FK_A299BCFB62BB7AEE');
        $this->addSql('DROP INDEX IDX_A299BCFB1919B217 ON pack_personnaliser');
        $this->addSql('DROP INDEX IDX_A299BCFB62BB7AEE ON pack_personnaliser');
        $this->addSql('ALTER TABLE pack_personnaliser DROP pack_id, DROP programme_id');
        $this->addSql('ALTER TABLE programme CHANGE description_programme discription_programme VARCHAR(255) NOT NULL');
    }
}
