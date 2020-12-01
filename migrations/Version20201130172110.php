<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130172110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_triks (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, groupe_id INT NOT NULL, nom_art_triks VARCHAR(255) NOT NULL, contenu_art_triks VARCHAR(255) NOT NULL, date_creation_art_triks DATE NOT NULL, date_derniere_modification_art_triks DATE NOT NULL, INDEX IDX_74F2C951FB88E14F (utilisateur_id), INDEX IDX_74F2C9517A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_triks ADD CONSTRAINT FK_74F2C951FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE article_triks ADD CONSTRAINT FK_74F2C9517A45358C FOREIGN KEY (groupe_id) REFERENCES groupe_triks (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article_triks');
    }
}
