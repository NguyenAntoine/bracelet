<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524201429 extends AbstractMigration
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
        $this->addSql('CREATE TABLE drug (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, no_drug VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, injection_type VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medication_taken (id INT AUTO_INCREMENT NOT NULL, taken TINYINT(1) NOT NULL, taken_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patent (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patent_disease (patent_id INT NOT NULL, disease_id INT NOT NULL, INDEX IDX_924EBB6711AAFF4A (patent_id), INDEX IDX_924EBB67D8355341 (disease_id), PRIMARY KEY(patent_id, disease_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patent_medication (id INT AUTO_INCREMENT NOT NULL, drug_id INT DEFAULT NULL, schedule VARCHAR(255) DEFAULT NULL, meal_period VARCHAR(255) DEFAULT NULL, number INT NOT NULL, weeks_duration INT DEFAULT NULL, months_duration INT DEFAULT NULL, per_day INT DEFAULT NULL, per_week INT DEFAULT NULL, per_month INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_3F570BD2AABCA765 (drug_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patents_with_medications (id INT AUTO_INCREMENT NOT NULL, patent_id INT NOT NULL, patent_medication_id INT NOT NULL, INDEX IDX_1689504F11AAFF4A (patent_id), INDEX IDX_1689504FFEB739CD (patent_medication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patents_with_medications_medication_taken (patents_with_medications_id INT NOT NULL, medication_taken_id INT NOT NULL, INDEX IDX_7A632F1D3358690B (patents_with_medications_id), INDEX IDX_7A632F1D3944031A (medication_taken_id), PRIMARY KEY(patents_with_medications_id, medication_taken_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patent_disease ADD CONSTRAINT FK_924EBB6711AAFF4A FOREIGN KEY (patent_id) REFERENCES patent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patent_disease ADD CONSTRAINT FK_924EBB67D8355341 FOREIGN KEY (disease_id) REFERENCES disease (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patent_medication ADD CONSTRAINT FK_3F570BD2AABCA765 FOREIGN KEY (drug_id) REFERENCES drug (id)');
        $this->addSql('ALTER TABLE patents_with_medications ADD CONSTRAINT FK_1689504F11AAFF4A FOREIGN KEY (patent_id) REFERENCES patent (id)');
        $this->addSql('ALTER TABLE patents_with_medications ADD CONSTRAINT FK_1689504FFEB739CD FOREIGN KEY (patent_medication_id) REFERENCES patent_medication (id)');
        $this->addSql('ALTER TABLE patents_with_medications_medication_taken ADD CONSTRAINT FK_7A632F1D3358690B FOREIGN KEY (patents_with_medications_id) REFERENCES patents_with_medications (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patents_with_medications_medication_taken ADD CONSTRAINT FK_7A632F1D3944031A FOREIGN KEY (medication_taken_id) REFERENCES medication_taken (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patent_disease DROP FOREIGN KEY FK_924EBB67D8355341');
        $this->addSql('ALTER TABLE patent_medication DROP FOREIGN KEY FK_3F570BD2AABCA765');
        $this->addSql('ALTER TABLE patents_with_medications_medication_taken DROP FOREIGN KEY FK_7A632F1D3944031A');
        $this->addSql('ALTER TABLE patent_disease DROP FOREIGN KEY FK_924EBB6711AAFF4A');
        $this->addSql('ALTER TABLE patents_with_medications DROP FOREIGN KEY FK_1689504F11AAFF4A');
        $this->addSql('ALTER TABLE patents_with_medications DROP FOREIGN KEY FK_1689504FFEB739CD');
        $this->addSql('ALTER TABLE patents_with_medications_medication_taken DROP FOREIGN KEY FK_7A632F1D3358690B');
        $this->addSql('DROP TABLE disease');
        $this->addSql('DROP TABLE drug');
        $this->addSql('DROP TABLE medication_taken');
        $this->addSql('DROP TABLE patent');
        $this->addSql('DROP TABLE patent_disease');
        $this->addSql('DROP TABLE patent_medication');
        $this->addSql('DROP TABLE patents_with_medications');
        $this->addSql('DROP TABLE patents_with_medications_medication_taken');
        $this->addSql('DROP TABLE user');
    }
}
