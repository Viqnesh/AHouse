<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402110703 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE propriete_habitat DROP FOREIGN KEY FK_849F5456583BB8B6');
        $this->addSql('DROP INDEX IDX_849F5456A74ADF1 ON propriete_habitat');
        $this->addSql('ALTER TABLE propriete_habitat ADD id_habitat_propriete_id INT NOT NULL, DROP id_habitat_id_propriete, CHANGE id_propriete_id id_propriete_id INT NOT NULL, CHANGE valeur_propriete valeur_propriete VARCHAR(120) DEFAULT NULL');
        $this->addSql('ALTER TABLE propriete_habitat ADD CONSTRAINT FK_849F5456B3F033AD FOREIGN KEY (id_habitat_propriete_id) REFERENCES habitat (id)');
        $this->addSql('CREATE INDEX IDX_849F5456B3F033AD ON propriete_habitat (id_habitat_propriete_id)');
        $this->addSql('ALTER TABLE user CHANGE url url VARCHAR(65535) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE propriete_habitat DROP FOREIGN KEY FK_849F5456B3F033AD');
        $this->addSql('DROP INDEX IDX_849F5456B3F033AD ON propriete_habitat');
        $this->addSql('ALTER TABLE propriete_habitat ADD id_habitat_id_propriete INT DEFAULT NULL, DROP id_habitat_propriete_id, CHANGE id_propriete_id id_propriete_id INT DEFAULT NULL, CHANGE valeur_propriete valeur_propriete VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE propriete_habitat ADD CONSTRAINT FK_849F5456583BB8B6 FOREIGN KEY (id_habitat_id_propriete) REFERENCES habitat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_849F5456A74ADF1 ON propriete_habitat (id_habitat_id_propriete)');
        $this->addSql('ALTER TABLE user CHANGE url url TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
