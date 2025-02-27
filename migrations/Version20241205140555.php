<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205140555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande ADD user_id INT NOT NULL, ADD entretien_id INT NOT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5548DCEA2 FOREIGN KEY (entretien_id) REFERENCES entretien (id)');
        $this->addSql('CREATE INDEX IDX_2694D7A5A76ED395 ON demande (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2694D7A5548DCEA2 ON demande (entretien_id)');
        $this->addSql('ALTER TABLE offre ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AF86866FA76ED395 ON offre (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5A76ED395');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5548DCEA2');
        $this->addSql('DROP INDEX IDX_2694D7A5A76ED395 ON demande');
        $this->addSql('DROP INDEX UNIQ_2694D7A5548DCEA2 ON demande');
        $this->addSql('ALTER TABLE demande DROP user_id, DROP entretien_id');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FA76ED395');
        $this->addSql('DROP INDEX IDX_AF86866FA76ED395 ON offre');
        $this->addSql('ALTER TABLE offre DROP user_id');
    }
}
