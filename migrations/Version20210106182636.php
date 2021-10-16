<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210106182636 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE propriete_habitat');
        $this->addSql('ALTER TABLE activite ADD id_domaine_id INT NOT NULL');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515E7F87C48 FOREIGN KEY (id_domaine_id) REFERENCES domaine (id)');
        $this->addSql('CREATE INDEX IDX_B8755515E7F87C48 ON activite (id_domaine_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE propriete_habitat (id INT AUTO_INCREMENT NOT NULL, id_propriete_id INT DEFAULT NULL, id_habitat_id_propriete INT DEFAULT NULL, valeur_propriete VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_849F54563B9719DD (id_propriete_id), INDEX IDX_849F5456A74ADF1 (id_habitat_id_propriete), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE propriete_habitat ADD CONSTRAINT FK_849F54563B9719DD FOREIGN KEY (id_propriete_id) REFERENCES propriete (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE propriete_habitat ADD CONSTRAINT FK_849F5456583BB8B6 FOREIGN KEY (id_habitat_id_propriete) REFERENCES habitat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515E7F87C48');
        $this->addSql('DROP INDEX IDX_B8755515E7F87C48 ON activite');
        $this->addSql('ALTER TABLE activite DROP id_domaine_id');
    }
}
