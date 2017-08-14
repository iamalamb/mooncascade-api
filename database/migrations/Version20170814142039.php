<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20170814142039 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE athletes (id INT AUTO_INCREMENT NOT NULL, code CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(125) NOT NULL, start_number BIGINT NOT NULL, UNIQUE INDEX UNIQ_57A7E4D677153098 (code), UNIQUE INDEX UNIQ_57A7E4D65C5F88C4 (start_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users CHANGE name name VARCHAR(125) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE athletes');
        $this->addSql('ALTER TABLE users CHANGE name name VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci');
    }
}
