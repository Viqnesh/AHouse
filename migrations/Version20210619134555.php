<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619134555 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter ADD region_id INT NOT NULL, ADD hebergement_id INT NOT NULL, DROP hebergement_prefere, DROP region');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C898260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE newsletter ADD CONSTRAINT FK_7E8585C823BB0F66 FOREIGN KEY (hebergement_id) REFERENCES type_habitat (id)');
        $this->addSql('CREATE INDEX IDX_7E8585C898260155 ON newsletter (region_id)');
        $this->addSql('CREATE INDEX IDX_7E8585C823BB0F66 ON newsletter (hebergement_id)');
        $this->addSql('ALTER TABLE user CHANGE url url VARCHAR(65535) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C898260155');
        $this->addSql('ALTER TABLE newsletter DROP FOREIGN KEY FK_7E8585C823BB0F66');
        $this->addSql('DROP INDEX IDX_7E8585C898260155 ON newsletter');
        $this->addSql('DROP INDEX IDX_7E8585C823BB0F66 ON newsletter');
        $this->addSql('ALTER TABLE newsletter ADD hebergement_prefere VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD region VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP region_id, DROP hebergement_id');
        $this->addSql('ALTER TABLE user CHANGE url url MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
