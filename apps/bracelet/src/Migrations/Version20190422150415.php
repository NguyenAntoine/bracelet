<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422150415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE disease (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, chronically TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drug (id INT AUTO_INCREMENT NOT NULL, patents_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, no_drug VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, injection_type VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_43EB7A3E7169BF54 (patents_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patent (id INT AUTO_INCREMENT NOT NULL, medication_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_18E53F932C4DE6DA (medication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patent_disease (patent_id INT NOT NULL, disease_id INT NOT NULL, INDEX IDX_924EBB6711AAFF4A (patent_id), INDEX IDX_924EBB67D8355341 (disease_id), PRIMARY KEY(patent_id, disease_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patent_medication (id INT AUTO_INCREMENT NOT NULL, schedule VARCHAR(255) DEFAULT NULL, meal_period VARCHAR(255) DEFAULT NULL, number INT NOT NULL, weeks_duration INT DEFAULT NULL, months_duration INT DEFAULT NULL, per_day INT DEFAULT NULL, per_week INT DEFAULT NULL, per_month INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE drug ADD CONSTRAINT FK_43EB7A3E7169BF54 FOREIGN KEY (patents_id) REFERENCES patent_medication (id)');
        $this->addSql('ALTER TABLE patent ADD CONSTRAINT FK_18E53F932C4DE6DA FOREIGN KEY (medication_id) REFERENCES patent_medication (id)');
        $this->addSql('ALTER TABLE patent_disease ADD CONSTRAINT FK_924EBB6711AAFF4A FOREIGN KEY (patent_id) REFERENCES patent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patent_disease ADD CONSTRAINT FK_924EBB67D8355341 FOREIGN KEY (disease_id) REFERENCES disease (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patent_disease DROP FOREIGN KEY FK_924EBB67D8355341');
        $this->addSql('ALTER TABLE patent_disease DROP FOREIGN KEY FK_924EBB6711AAFF4A');
        $this->addSql('ALTER TABLE drug DROP FOREIGN KEY FK_43EB7A3E7169BF54');
        $this->addSql('ALTER TABLE patent DROP FOREIGN KEY FK_18E53F932C4DE6DA');
        $this->addSql('DROP TABLE disease');
        $this->addSql('DROP TABLE drug');
        $this->addSql('DROP TABLE patent');
        $this->addSql('DROP TABLE patent_disease');
        $this->addSql('DROP TABLE patent_medication');
        $this->addSql('DROP TABLE user');
    }
}
