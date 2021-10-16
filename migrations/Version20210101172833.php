<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210101172833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE domaine_equipement MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE domaine_equipement DROP FOREIGN KEY FK_23C6DFED3E47DE39');
        $this->addSql('ALTER TABLE domaine_equipement DROP FOREIGN KEY FK_23C6DFEDDE2F4FD7');
        $this->addSql('DROP INDEX IDX_23C6DFED3E47DE39 ON domaine_equipement');
        $this->addSql('DROP INDEX IDX_23C6DFEDDE2F4FD7 ON domaine_equipement');
        $this->addSql('ALTER TABLE domaine_equipement DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE domaine_equipement ADD domaine_id INT NOT NULL, ADD equipement_id INT NOT NULL, DROP id, DROP id_domaine_equip_id, DROP id_equipement_id');
        $this->addSql('ALTER TABLE domaine_equipement ADD CONSTRAINT FK_23C6DFED4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domaine_equipement ADD CONSTRAINT FK_23C6DFED806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_23C6DFED4272FC9F ON domaine_equipement (domaine_id)');
        $this->addSql('CREATE INDEX IDX_23C6DFED806F0F5C ON domaine_equipement (equipement_id)');
        $this->addSql('ALTER TABLE domaine_equipement ADD PRIMARY KEY (domaine_id, equipement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE domaine_equipement DROP FOREIGN KEY FK_23C6DFED4272FC9F');
        $this->addSql('ALTER TABLE domaine_equipement DROP FOREIGN KEY FK_23C6DFED806F0F5C');
        $this->addSql('DROP INDEX IDX_23C6DFED4272FC9F ON domaine_equipement');
        $this->addSql('DROP INDEX IDX_23C6DFED806F0F5C ON domaine_equipement');
        $this->addSql('ALTER TABLE domaine_equipement ADD id INT AUTO_INCREMENT NOT NULL, ADD id_domaine_equip_id INT NOT NULL, ADD id_equipement_id INT NOT NULL, DROP domaine_id, DROP equipement_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE domaine_equipement ADD CONSTRAINT FK_23C6DFED3E47DE39 FOREIGN KEY (id_equipement_id) REFERENCES equipement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE domaine_equipement ADD CONSTRAINT FK_23C6DFEDDE2F4FD7 FOREIGN KEY (id_domaine_equip_id) REFERENCES domaine (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_23C6DFED3E47DE39 ON domaine_equipement (id_equipement_id)');
        $this->addSql('CREATE INDEX IDX_23C6DFEDDE2F4FD7 ON domaine_equipement (id_domaine_equip_id)');
    }
}
