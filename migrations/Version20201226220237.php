<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201226220237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activite_habitat (id INT AUTO_INCREMENT NOT NULL, type_activite_id INT DEFAULT NULL, id_habitat_id INT NOT NULL, adresse VARCHAR(30) NOT NULL, distance DOUBLE PRECISION NOT NULL, prix DOUBLE PRECISION NOT NULL, url VARCHAR(50) NOT NULL, INDEX IDX_7191756DA74ADF1 (id_habitat_id), INDEX IDX_7191756DD0165F20 (type_activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, begin_at DATETIME NOT NULL, end_at DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE braintree (id INT AUTO_INCREMENT NOT NULL, merchant_id VARCHAR(40) NOT NULL, public_key VARCHAR(30) NOT NULL, private_key VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_habitat_id_commentaire INT DEFAULT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_67F068BCA74ADF1 (id_habitat_id_commentaire), UNIQUE INDEX UNIQ_67F068BC79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domaine (id INT AUTO_INCREMENT NOT NULL, id_proprietaire_id INT NOT NULL, nom VARCHAR(4) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_78AF0ACC9F9BCDC2 (id_proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitat (id INT AUTO_INCREMENT NOT NULL, id_type_habitat_id INT DEFAULT NULL, id_domaine_id INT NOT NULL, nom VARCHAR(30) NOT NULL, nb_couchages VARCHAR(25) NOT NULL, capacite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, pays VARCHAR(30) NOT NULL, ville VARCHAR(40) NOT NULL, description LONGTEXT NOT NULL, date_publication DATE NOT NULL, url TEXT NOT NULL, INDEX IDX_3B37B2E8E7F87C48 (id_domaine_id), INDEX IDX_3B37B2E85BA3388B (id_type_habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home_controller (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, id_user_locataire INT DEFAULT NULL, id_habitat_id_location INT DEFAULT NULL, date_reservation DATETIME NOT NULL, dateDebut DATETIME NOT NULL, dateFin DATETIME NOT NULL, statut VARCHAR(25) NOT NULL, INDEX IDX_5E9E89CB79F37AE5 (id_user_locataire), INDEX IDX_5E9E89CBA74ADF1 (id_habitat_id_location), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, id_type_habitat INT DEFAULT NULL, titre VARCHAR(50) NOT NULL, contenu VARCHAR(255) NOT NULL, INDEX fk_typehabitat (id_type_habitat), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification_habitat (notification_id INT NOT NULL, habitat_id INT NOT NULL, INDEX IDX_2E29385FEF1A9D84 (notification_id), INDEX IDX_2E29385FAFFE2D26 (habitat_id), PRIMARY KEY(notification_id, habitat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paypal (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prise_de_vue (id INT AUTO_INCREMENT NOT NULL, id_habitat_id_prisedevue INT DEFAULT NULL, id_activite_habitat_id INT DEFAULT NULL, url VARCHAR(25) NOT NULL, INDEX IDX_3EAEED81B5E42F98 (id_activite_habitat_id), INDEX IDX_3EAEED81A74ADF1 (id_habitat_id_prisedevue), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE propriete (id INT AUTO_INCREMENT NOT NULL, id_type_habitat_id INT DEFAULT NULL, nom VARCHAR(40) NOT NULL, type VARCHAR(30) NOT NULL, obligatoire TINYINT(1) NOT NULL, INDEX IDX_73A85B935BA3388B (id_type_habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE propriete_habitat (id INT AUTO_INCREMENT NOT NULL, id_propriete_id INT DEFAULT NULL, id_habitat_id_propriete INT DEFAULT NULL, valeur_propriete VARCHAR(30) DEFAULT NULL, INDEX IDX_849F5456A74ADF1 (id_habitat_id_propriete), INDEX IDX_849F54563B9719DD (id_propriete_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stripe (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_habitat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(150) NOT NULL, ville VARCHAR(40) NOT NULL, cp INT NOT NULL, url TEXT NOT NULL, email VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite_habitat ADD CONSTRAINT FK_7191756DD0165F20 FOREIGN KEY (type_activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE activite_habitat ADD CONSTRAINT FK_7191756DA74ADF1 FOREIGN KEY (id_habitat_id) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB600200A FOREIGN KEY (id_habitat_id_commentaire) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE domaine ADD CONSTRAINT FK_78AF0ACC9F9BCDC2 FOREIGN KEY (id_proprietaire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E85BA3388B FOREIGN KEY (id_type_habitat_id) REFERENCES type_habitat (id)');
        $this->addSql('ALTER TABLE habitat ADD CONSTRAINT FK_3B37B2E8E7F87C48 FOREIGN KEY (id_domaine_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CBF9FAC609 FOREIGN KEY (id_user_locataire) REFERENCES user (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB79273E71 FOREIGN KEY (id_habitat_id_location) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA30D7A86F FOREIGN KEY (id_type_habitat) REFERENCES type_habitat (id)');
        $this->addSql('ALTER TABLE notification_habitat ADD CONSTRAINT FK_2E29385FEF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notification_habitat ADD CONSTRAINT FK_2E29385FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prise_de_vue ADD CONSTRAINT FK_3EAEED81950274EC FOREIGN KEY (id_habitat_id_prisedevue) REFERENCES habitat (id)');
        $this->addSql('ALTER TABLE prise_de_vue ADD CONSTRAINT FK_3EAEED81B5E42F98 FOREIGN KEY (id_activite_habitat_id) REFERENCES activite_habitat (id)');
        $this->addSql('ALTER TABLE propriete ADD CONSTRAINT FK_73A85B935BA3388B FOREIGN KEY (id_type_habitat_id) REFERENCES type_habitat (id)');
        $this->addSql('ALTER TABLE propriete_habitat ADD CONSTRAINT FK_849F54563B9719DD FOREIGN KEY (id_propriete_id) REFERENCES propriete (id)');
        $this->addSql('ALTER TABLE propriete_habitat ADD CONSTRAINT FK_849F5456583BB8B6 FOREIGN KEY (id_habitat_id_propriete) REFERENCES habitat (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_habitat DROP FOREIGN KEY FK_7191756DD0165F20');
        $this->addSql('ALTER TABLE prise_de_vue DROP FOREIGN KEY FK_3EAEED81B5E42F98');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E8E7F87C48');
        $this->addSql('ALTER TABLE activite_habitat DROP FOREIGN KEY FK_7191756DA74ADF1');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB600200A');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB79273E71');
        $this->addSql('ALTER TABLE notification_habitat DROP FOREIGN KEY FK_2E29385FAFFE2D26');
        $this->addSql('ALTER TABLE prise_de_vue DROP FOREIGN KEY FK_3EAEED81950274EC');
        $this->addSql('ALTER TABLE propriete_habitat DROP FOREIGN KEY FK_849F5456583BB8B6');
        $this->addSql('ALTER TABLE notification_habitat DROP FOREIGN KEY FK_2E29385FEF1A9D84');
        $this->addSql('ALTER TABLE propriete_habitat DROP FOREIGN KEY FK_849F54563B9719DD');
        $this->addSql('ALTER TABLE habitat DROP FOREIGN KEY FK_3B37B2E85BA3388B');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA30D7A86F');
        $this->addSql('ALTER TABLE propriete DROP FOREIGN KEY FK_73A85B935BA3388B');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC79F37AE5');
        $this->addSql('ALTER TABLE domaine DROP FOREIGN KEY FK_78AF0ACC9F9BCDC2');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CBF9FAC609');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE activite_habitat');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE braintree');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE habitat');
        $this->addSql('DROP TABLE home_controller');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE notification_habitat');
        $this->addSql('DROP TABLE paypal');
        $this->addSql('DROP TABLE prise_de_vue');
        $this->addSql('DROP TABLE propriete');
        $this->addSql('DROP TABLE propriete_habitat');
        $this->addSql('DROP TABLE stripe');
        $this->addSql('DROP TABLE type_habitat');
        $this->addSql('DROP TABLE user');
    }
}
