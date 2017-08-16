<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20170816110952 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE athletes (id INT AUTO_INCREMENT NOT NULL, gender_id INT DEFAULT NULL, team_id INT DEFAULT NULL, code CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(125) NOT NULL, date_of_birth DATE DEFAULT NULL, start_number BIGINT NOT NULL, time_at_gate DOUBLE PRECISION DEFAULT NULL, time_at_finish DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_57A7E4D677153098 (code), UNIQUE INDEX UNIQ_57A7E4D65C5F88C4 (start_number), INDEX IDX_57A7E4D6708A0E0 (gender_id), INDEX IDX_57A7E4D6296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genders (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(125) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(125) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE athletes ADD CONSTRAINT FK_57A7E4D6708A0E0 FOREIGN KEY (gender_id) REFERENCES genders (id)');
        $this->addSql('ALTER TABLE athletes ADD CONSTRAINT FK_57A7E4D6296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE athletes DROP FOREIGN KEY FK_57A7E4D6708A0E0');
        $this->addSql('ALTER TABLE athletes DROP FOREIGN KEY FK_57A7E4D6296CD8AE');
        $this->addSql('DROP TABLE athletes');
        $this->addSql('DROP TABLE genders');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE users');
    }
}
