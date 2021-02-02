<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210202181017 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_triks (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, groupe_id INT NOT NULL, nom_art_triks VARCHAR(255) NOT NULL, contenu_art_triks VARCHAR(255) NOT NULL, date_creation_art_triks DATE NOT NULL, date_derniere_modification_art_triks DATE NOT NULL, INDEX IDX_74F2C951FB88E14F (utilisateur_id), INDEX IDX_74F2C9517A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, article_id INT DEFAULT NULL, contenu_commentaire VARCHAR(255) NOT NULL, date_commentaire DATE NOT NULL, INDEX IDX_67F068BCFB88E14F (utilisateur_id), INDEX IDX_67F068BC7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_triks (id INT AUTO_INCREMENT NOT NULL, nom_grp_triks VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_triks (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, lien_img_triks VARCHAR(255) NOT NULL, INDEX IDX_14003FE97294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, photo_utilisateur VARCHAR(255) NOT NULL, mail_utilisateur VARCHAR(255) NOT NULL, verif_mail_utilisateur TINYINT(1) NOT NULL, pseudo_utilisateur VARCHAR(30) NOT NULL, mdp_utilisateur VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_triks (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, lien_vid_triks VARCHAR(255) NOT NULL, INDEX IDX_8C27B2E27294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_triks ADD CONSTRAINT FK_74F2C951FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE article_triks ADD CONSTRAINT FK_74F2C9517A45358C FOREIGN KEY (groupe_id) REFERENCES groupe_triks (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article_triks (id)');
        $this->addSql('ALTER TABLE image_triks ADD CONSTRAINT FK_14003FE97294869C FOREIGN KEY (article_id) REFERENCES article_triks (id)');
        $this->addSql('ALTER TABLE video_triks ADD CONSTRAINT FK_8C27B2E27294869C FOREIGN KEY (article_id) REFERENCES article_triks (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC7294869C');
        $this->addSql('ALTER TABLE image_triks DROP FOREIGN KEY FK_14003FE97294869C');
        $this->addSql('ALTER TABLE video_triks DROP FOREIGN KEY FK_8C27B2E27294869C');
        $this->addSql('ALTER TABLE article_triks DROP FOREIGN KEY FK_74F2C9517A45358C');
        $this->addSql('ALTER TABLE article_triks DROP FOREIGN KEY FK_74F2C951FB88E14F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFB88E14F');
        $this->addSql('DROP TABLE article_triks');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE groupe_triks');
        $this->addSql('DROP TABLE image_triks');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE video_triks');
    }
}
