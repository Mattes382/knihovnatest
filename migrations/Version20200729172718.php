<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200729172718 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author CHANGE popis info VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE knihy ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE knihy ADD CONSTRAINT FK_30C2E9E9F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_30C2E9E9F675F31B ON knihy (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author CHANGE info popis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE knihy DROP FOREIGN KEY FK_30C2E9E9F675F31B');
        $this->addSql('DROP INDEX IDX_30C2E9E9F675F31B ON knihy');
        $this->addSql('ALTER TABLE knihy DROP author_id');
    }
}
