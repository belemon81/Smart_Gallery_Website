<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221127174153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artwork (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, name VARCHAR(100) NOT NULL, completion_date DATETIME NOT NULL, description LONGTEXT NOT NULL, total_views INT NOT NULL, approved TINYINT(1) NOT NULL, artwork_url LONGTEXT DEFAULT NULL, INDEX IDX_881FC576B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT FK_881FC576B7970CF8 FOREIGN KEY (artist_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY FK_881FC576B7970CF8');
        $this->addSql('DROP TABLE artwork');
        $this->addSql('ALTER TABLE user DROP name');
    }
}
