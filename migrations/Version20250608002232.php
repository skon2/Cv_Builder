<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250608002232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE education (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, institution VARCHAR(255) NOT NULL, degree VARCHAR(255) NOT NULL, field_of_study VARCHAR(255) DEFAULT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_DB0A5ED2CFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, position VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_590C103CFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE language_skill (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, language VARCHAR(100) NOT NULL, level VARCHAR(50) NOT NULL, INDEX IDX_2165E026CFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, name VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, description LONGTEXT NOT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_2FB3D0EECFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE social_activity (id INT AUTO_INCREMENT NOT NULL, cv_id INT NOT NULL, title VARCHAR(255) NOT NULL, organization VARCHAR(255) DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_22459D76CFE419E2 (cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE experience ADD CONSTRAINT FK_590C103CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE language_skill ADD CONSTRAINT FK_2165E026CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EECFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE social_activity ADD CONSTRAINT FK_22459D76CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cv ADD photo_name VARCHAR(255) DEFAULT NULL, ADD template VARCHAR(50) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2CFE419E2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE experience DROP FOREIGN KEY FK_590C103CFE419E2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE language_skill DROP FOREIGN KEY FK_2165E026CFE419E2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EECFE419E2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE social_activity DROP FOREIGN KEY FK_22459D76CFE419E2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE education
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE experience
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE language_skill
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE project
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE social_activity
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cv DROP photo_name, DROP template
        SQL);
    }
}
