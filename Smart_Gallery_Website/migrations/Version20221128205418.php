<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221128205418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artwork_category (artwork_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_FA06D53FDB8FFA4 (artwork_id), INDEX IDX_FA06D53F12469DE2 (category_id), PRIMARY KEY(artwork_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artwork_category ADD CONSTRAINT FK_FA06D53FDB8FFA4 FOREIGN KEY (artwork_id) REFERENCES artwork (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artwork_category ADD CONSTRAINT FK_FA06D53F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artwork_category DROP FOREIGN KEY FK_FA06D53FDB8FFA4');
        $this->addSql('ALTER TABLE artwork_category DROP FOREIGN KEY FK_FA06D53F12469DE2');
        $this->addSql('DROP TABLE artwork_category');
        $this->addSql('DROP TABLE category');
    }
}
