<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619104501 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(150) NOT NULL, prenom VARCHAR(150) NOT NULL, anniversaire DATE DEFAULT NULL, hebergement_prefere VARCHAR(100) NOT NULL, region VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE propriete_habitat ADD CONSTRAINT FK_849F5456B3F033AD FOREIGN KEY (id_habitat_propriete_id) REFERENCES habitat (id)');
        $this->addSql('CREATE INDEX IDX_849F5456B3F033AD ON propriete_habitat (id_habitat_propriete_id)');
        $this->addSql('ALTER TABLE user CHANGE url url VARCHAR(65535) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('ALTER TABLE propriete_habitat DROP FOREIGN KEY FK_849F5456B3F033AD');
        $this->addSql('DROP INDEX IDX_849F5456B3F033AD ON propriete_habitat');
        $this->addSql('ALTER TABLE user CHANGE url url TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
