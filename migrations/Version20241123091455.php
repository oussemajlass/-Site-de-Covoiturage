<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241123091455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conducteur (id INT NOT NULL, vehicule VARCHAR(255) NOT NULL, historique_trajets LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_notification (user_id INT NOT NULL, notification_id INT NOT NULL, INDEX IDX_3F980AC8A76ED395 (user_id), INDEX IDX_3F980AC8EF1A9D84 (notification_id), PRIMARY KEY(user_id, notification_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conducteur ADD CONSTRAINT FK_23677143BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_notification ADD CONSTRAINT FK_3F980AC8A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_notification ADD CONSTRAINT FK_3F980AC8EF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE conduite');
        $this->addSql('ALTER TABLE feedback ADD emetteur_passager_id INT NOT NULL, ADD emetteur VARCHAR(255) NOT NULL, ADD receveur VARCHAR(255) NOT NULL, ADD note INT NOT NULL, ADD commentaire VARCHAR(255) NOT NULL, ADD datefeedback DATETIME NOT NULL');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458D936848E FOREIGN KEY (emetteur_passager_id) REFERENCES passager (id)');
        $this->addSql('CREATE INDEX IDX_D2294458D936848E ON feedback (emetteur_passager_id)');
        $this->addSql('ALTER TABLE notification ADD message VARCHAR(255) NOT NULL, ADD date_notification DATETIME NOT NULL, ADD statut TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE paiement ADD reservation_ref VARCHAR(255) NOT NULL, ADD montant DOUBLE PRECISION NOT NULL, ADD date_paiement DATETIME NOT NULL, ADD methode VARCHAR(255) NOT NULL, ADD statut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE passager ADD historique_reservations LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE passager ADD CONSTRAINT FK_BFF42EE9BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD passager_id INT NOT NULL, ADD trajet_id INT NOT NULL, ADD paiement_id INT NOT NULL, ADD trajet_description VARCHAR(255) NOT NULL, ADD date_reservation DATETIME NOT NULL, ADD statut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495571A51189 FOREIGN KEY (passager_id) REFERENCES passager (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849552A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id)');
        $this->addSql('CREATE INDEX IDX_42C8495571A51189 ON reservation (passager_id)');
        $this->addSql('CREATE INDEX IDX_42C84955D12A823 ON reservation (trajet_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849552A4C4478 ON reservation (paiement_id)');
        $this->addSql('ALTER TABLE trajet ADD voiture_id INT NOT NULL, ADD conducteur VARCHAR(255) NOT NULL, ADD point_depart VARCHAR(255) NOT NULL, ADD point_arrivee VARCHAR(255) NOT NULL, ADD date_heure_depart DATETIME NOT NULL');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98C181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98C181A8BA ON trajet (voiture_id)');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD telephone VARCHAR(255) NOT NULL, ADD date_inscription DATE NOT NULL, ADD avis LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD conducteurr_id INT NOT NULL, ADD marque VARCHAR(255) NOT NULL, ADD modele VARCHAR(255) NOT NULL, ADD couleur VARCHAR(255) NOT NULL, ADD immatriculation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F2D3BD28F FOREIGN KEY (conducteurr_id) REFERENCES conducteur (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F2D3BD28F ON voiture (conducteurr_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F2D3BD28F');
        $this->addSql('CREATE TABLE conduite (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE conducteur DROP FOREIGN KEY FK_23677143BF396750');
        $this->addSql('ALTER TABLE user_notification DROP FOREIGN KEY FK_3F980AC8A76ED395');
        $this->addSql('ALTER TABLE user_notification DROP FOREIGN KEY FK_3F980AC8EF1A9D84');
        $this->addSql('DROP TABLE conducteur');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user_notification');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458D936848E');
        $this->addSql('DROP INDEX IDX_D2294458D936848E ON feedback');
        $this->addSql('ALTER TABLE feedback DROP emetteur_passager_id, DROP emetteur, DROP receveur, DROP note, DROP commentaire, DROP datefeedback');
        $this->addSql('ALTER TABLE notification DROP message, DROP date_notification, DROP statut');
        $this->addSql('ALTER TABLE paiement DROP reservation_ref, DROP montant, DROP date_paiement, DROP methode, DROP statut');
        $this->addSql('ALTER TABLE passager DROP FOREIGN KEY FK_BFF42EE9BF396750');
        $this->addSql('ALTER TABLE passager DROP historique_reservations, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495571A51189');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955D12A823');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849552A4C4478');
        $this->addSql('DROP INDEX IDX_42C8495571A51189 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955D12A823 ON reservation');
        $this->addSql('DROP INDEX UNIQ_42C849552A4C4478 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP passager_id, DROP trajet_id, DROP paiement_id, DROP trajet_description, DROP date_reservation, DROP statut');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C181A8BA');
        $this->addSql('DROP INDEX IDX_2B5BA98C181A8BA ON trajet');
        $this->addSql('ALTER TABLE trajet DROP voiture_id, DROP conducteur, DROP point_depart, DROP point_arrivee, DROP date_heure_depart');
        $this->addSql('ALTER TABLE `user` DROP name, DROP adresse, DROP prenom, DROP telephone, DROP date_inscription, DROP avis, DROP type');
        $this->addSql('DROP INDEX IDX_E9E2810F2D3BD28F ON voiture');
        $this->addSql('ALTER TABLE voiture DROP conducteurr_id, DROP marque, DROP modele, DROP couleur, DROP immatriculation');
    }
}
