<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209153144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE famille CHANGE id id VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE medicament CHANGE id id VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE visiteur ADD role TINYINT(1) NOT NULL, CHANGE id id CHAR(4) NOT NULL, CHANGE mdp mdp CHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE famille CHANGE id id VARCHAR(10) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE medicament CHANGE id id VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE visiteur DROP role, CHANGE id id CHAR(4) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE mdp mdp CHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
    }
}
