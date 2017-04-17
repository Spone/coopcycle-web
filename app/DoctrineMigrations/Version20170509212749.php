<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170509212749 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE stripe_params_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE api_user_stripe_params (api_user_id INT NOT NULL, stripe_params_id INT NOT NULL, PRIMARY KEY(api_user_id, stripe_params_id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B16653364A50A7F2 ON api_user_stripe_params (api_user_id)');
        $this->addSql('CREATE INDEX IDX_B16653368C11ECC5 ON api_user_stripe_params (stripe_params_id)');
        $this->addSql('CREATE TABLE stripe_params (id INT NOT NULL, user_id VARCHAR(255) NOT NULL, publishable_key VARCHAR(255) DEFAULT NULL, refresh_token VARCHAR(255) DEFAULT NULL, access_token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE api_user_stripe_params ADD CONSTRAINT FK_B16653364A50A7F2 FOREIGN KEY (api_user_id) REFERENCES api_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE api_user_stripe_params ADD CONSTRAINT FK_B16653368C11ECC5 FOREIGN KEY (stripe_params_id) REFERENCES stripe_params (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE restaurant ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES api_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EB95123F7E3C61F9 ON restaurant (owner_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE api_user_stripe_params DROP CONSTRAINT FK_B16653368C11ECC5');
        $this->addSql('DROP SEQUENCE stripe_params_id_seq CASCADE');
        $this->addSql('DROP TABLE api_user_stripe_params');
        $this->addSql('DROP TABLE stripe_params');
        $this->addSql('ALTER TABLE restaurant DROP CONSTRAINT FK_EB95123F7E3C61F9');
        $this->addSql('DROP INDEX IDX_EB95123F7E3C61F9');
        $this->addSql('ALTER TABLE restaurant DROP owner_id');
    }
}
