<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624191943 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, id_user_locataire INT DEFAULT NULL, id_habitat_id_location INT DEFAULT NULL, date_reservation DATETIME NOT NULL, dateDebut DATETIME NOT NULL, dateFin DATETIME NOT NULL, statut VARCHAR(25) NOT NULL, appreciation TINYINT(1) DEFAULT NULL, nb_personnes INT NOT NULL, INDEX IDX_5E9E89CB79F37AE5 (id_user_locataire), INDEX IDX_5E9E89CBA74ADF1 (id_habitat_id_location), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE occupant (id INT AUTO_INCREMENT NOT NULL, id_location_id INT NOT NULL, type VARCHAR(200) NOT NULL, INDEX IDX_E7D9DBCA1E5FEC79 (id_location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBF9FAC609 FOREIGN KEY (id_user_locataire) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB79273E71 FOREIGN KEY (id_habitat_id_location) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE occupant ADD CONSTRAINT FK_E7D9DBCA1E5FEC79 FOREIGN KEY (id_location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E898260155 ON habitat (region_id)');
        $this->addSql('ALTER TABLE user CHANGE url url VARCHAR(65535) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE occupant DROP FOREIGN KEY FK_E7D9DBCA1E5FEC79');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE occupant');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E898260155');
        $this->addSql('DROP INDEX IDX_3B37B2E898260155 ON habitat');
        $this->addSql('ALTER TABLE user CHANGE url url MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
