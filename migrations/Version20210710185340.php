<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210710185340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dispo_domaine (id INT AUTO_INCREMENT NOT NULL, id_domaine_id INT NOT NULL, date_dispo DATE NOT NULL, INDEX IDX_F536B14E7F87C48 (id_domaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dispo_domaine ADD CONSTRAINT FK_F536B14E7F87C48 FOREIGN KEY (id_domaine_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_3B37B2E898260155 ON habitat (region_id)');
        $this->addSql('ALTER TABLE user CHANGE url url VARCHAR(65535) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE dispo_domaine');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E898260155');
        $this->addSql('DROP INDEX IDX_3B37B2E898260155 ON habitat');
        $this->addSql('ALTER TABLE user CHANGE url url MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
