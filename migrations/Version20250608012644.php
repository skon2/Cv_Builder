<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250608012644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE computer_skill (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, name VARCHAR(100) NOT NULL, level VARCHAR(50) NOT NULL, INDEX IDX_7B4FF9DBCFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE computer_skill ADD CONSTRAINT FK_7B4FF9DBCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE computer_skill DROP FOREIGN KEY FK_7B4FF9DBCFE419E2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE computer_skill
        SQL);
    }
}
