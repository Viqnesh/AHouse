<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624181031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E898260155 ON habitat (region_id)');
        $this->addSql('ALTER TABLE occupant DROP FOREIGN KEY FK_E7D9DBCAAFFE2D26');
        $this->addSql('DROP INDEX IDX_E7D9DBCAAFFE2D26 ON occupant');
        $this->addSql('ALTER TABLE occupant CHANGE habitat_id id_location_id INT NOT NULL');
        $this->addSql('ALTER TABLE occupant ADD CONSTRAINT FK_E7D9DBCA1E5FEC79 FOREIGN KEY (id_location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_E7D9DBCA1E5FEC79 ON occupant (id_location_id)');
        $this->addSql('ALTER TABLE user CHANGE url url VARCHAR(65535) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E898260155');
        $this->addSql('DROP INDEX IDX_3B37B2E898260155 ON habitat');
        $this->addSql('ALTER TABLE occupant DROP FOREIGN KEY FK_E7D9DBCA1E5FEC79');
        $this->addSql('DROP INDEX IDX_E7D9DBCA1E5FEC79 ON occupant');
        $this->addSql('ALTER TABLE occupant CHANGE id_location_id habitat_id INT NOT NULL');
        $this->addSql('ALTER TABLE occupant ADD CONSTRAINT FK_E7D9DBCAAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E7D9DBCAAFFE2D26 ON occupant (habitat_id)');
        $this->addSql('ALTER TABLE user CHANGE url url MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
