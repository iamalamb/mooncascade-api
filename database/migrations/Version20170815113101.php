<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20170815113101 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE genders (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE athletes ADD gender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE athletes ADD CONSTRAINT FK_57A7E4D6708A0E0 FOREIGN KEY (gender_id) REFERENCES genders (id)');
        $this->addSql('CREATE INDEX IDX_57A7E4D6708A0E0 ON athletes (gender_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE athletes DROP FOREIGN KEY FK_57A7E4D6708A0E0');
        $this->addSql('DROP TABLE genders');
        $this->addSql('DROP INDEX IDX_57A7E4D6708A0E0 ON athletes');
        $this->addSql('ALTER TABLE athletes DROP gender_id');
    }
}
