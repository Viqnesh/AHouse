<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201227090857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE domaine_equipement (domaine_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_23C6DFED4272FC9F (domaine_id), INDEX IDX_23C6DFED806F0F5C (equipement_id), PRIMARY KEY(domaine_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE domaine_equipement ADD CONSTRAINT FK_23C6DFED4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domaine_equipement ADD CONSTRAINT FK_23C6DFED806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domaine ADD arrive TIME NOT NULL, ADD depart TIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE domaine_equipement DROP FOREIGN KEY FK_23C6DFED806F0F5C');
        $this->addSql('DROP TABLE domaine_equipement');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('ALTER TABLE domaine DROP arrive, DROP depart');
    }
}
