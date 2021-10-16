<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201227091538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE domaine_equipement (id INT AUTO_INCREMENT NOT NULL, id_domaine_equip_id INT NOT NULL, id_equipement_id INT NOT NULL, INDEX IDX_23C6DFEDDE2F4FD7 (id_domaine_equip_id), INDEX IDX_23C6DFED3E47DE39 (id_equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE domaine_equipement ADD CONSTRAINT FK_23C6DFEDDE2F4FD7 FOREIGN KEY (id_domaine_equip_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE domaine_equipement ADD CONSTRAINT FK_23C6DFED3E47DE39 FOREIGN KEY (id_equipement_id) REFERENCES equipement (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE domaine_equipement');
    }
}
