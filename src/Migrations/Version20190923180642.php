<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190923180642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client ADD is_actice TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE visitation_task ADD status VARCHAR(255) NOT NULL, ADD specialist_id INT NOT NULL, ADD is_actice TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE specialist ADD is_actice TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP is_actice');
        $this->addSql('ALTER TABLE specialist DROP is_actice');
        $this->addSql('ALTER TABLE visitation_task DROP status, DROP specialist_id, DROP is_actice');
    }
}
