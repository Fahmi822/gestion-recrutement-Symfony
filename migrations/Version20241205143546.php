<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205143546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5A76ED395');
        $this->addSql('DROP INDEX IDX_2694D7A5A76ED395 ON demande');
        $this->addSql('ALTER TABLE demande ADD recruteur_id INT DEFAULT NULL, ADD candidat_id INT DEFAULT NULL, ADD offre_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5BB0859F1 FOREIGN KEY (recruteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A58D0EB82 FOREIGN KEY (candidat_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A54CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_2694D7A5BB0859F1 ON demande (recruteur_id)');
        $this->addSql('CREATE INDEX IDX_2694D7A58D0EB82 ON demande (candidat_id)');
        $this->addSql('CREATE INDEX IDX_2694D7A54CC8505A ON demande (offre_id)');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FA76ED395');
        $this->addSql('DROP INDEX IDX_AF86866FA76ED395 ON offre');
        $this->addSql('ALTER TABLE offre DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5BB0859F1');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A58D0EB82');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A54CC8505A');
        $this->addSql('DROP INDEX IDX_2694D7A5BB0859F1 ON demande');
        $this->addSql('DROP INDEX IDX_2694D7A58D0EB82 ON demande');
        $this->addSql('DROP INDEX IDX_2694D7A54CC8505A ON demande');
        $this->addSql('ALTER TABLE demande ADD user_id INT NOT NULL, DROP recruteur_id, DROP candidat_id, DROP offre_id');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2694D7A5A76ED395 ON demande (user_id)');
        $this->addSql('ALTER TABLE offre ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AF86866FA76ED395 ON offre (user_id)');
    }
}
