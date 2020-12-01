<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130172807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_triks (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, lien_img_triks VARCHAR(255) NOT NULL, INDEX IDX_14003FE97294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_triks (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, lien_vid_triks VARCHAR(255) NOT NULL, INDEX IDX_8C27B2E27294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_triks ADD CONSTRAINT FK_14003FE97294869C FOREIGN KEY (article_id) REFERENCES article_triks (id)');
        $this->addSql('ALTER TABLE video_triks ADD CONSTRAINT FK_8C27B2E27294869C FOREIGN KEY (article_id) REFERENCES article_triks (id)');
        $this->addSql('ALTER TABLE commentaire CHANGE article_id article_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image_triks');
        $this->addSql('DROP TABLE video_triks');
        $this->addSql('ALTER TABLE commentaire CHANGE article_id article_id INT NOT NULL');
    }
}
