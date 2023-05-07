<?php

declare(strict_types=1);

namespace Liox\B2B\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230507104001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Users table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE "users" (user_id UUID NOT NULL, username VARCHAR(255) NOT NULL, hashed_password VARCHAR(255) NOT NULL, PRIMARY KEY(user_id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "users" (username)');
        $this->addSql('COMMENT ON COLUMN "users".user_id IS \'(DC2Type:user_id)\'');
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException();
    }
}
