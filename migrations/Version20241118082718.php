<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241118082718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458C83E5F65');
        $this->addSql('DROP INDEX IDX_D2294458C83E5F65 ON feedback');
        $this->addSql('ALTER TABLE feedback DROP receveur_passager_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback ADD receveur_passager_id INT NOT NULL');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458C83E5F65 FOREIGN KEY (receveur_passager_id) REFERENCES passager (id)');
        $this->addSql('CREATE INDEX IDX_D2294458C83E5F65 ON feedback (receveur_passager_id)');
    }
}
