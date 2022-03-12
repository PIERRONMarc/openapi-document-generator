<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220312192248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE http_response (id INT AUTO_INCREMENT NOT NULL, path_item_id INT NOT NULL, http_status_code INT NOT NULL, description LONGTEXT DEFAULT NULL, content JSON DEFAULT NULL, INDEX IDX_32C80BE6D5D96477 (path_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE open_api_document (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, version VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parameter (id INT AUTO_INCREMENT NOT NULL, path_id INT DEFAULT NULL, path_item_id INT NOT NULL, description LONGTEXT DEFAULT NULL, required TINYINT(1) NOT NULL, location VARCHAR(6) NOT NULL, name VARCHAR(255) NOT NULL, parameter_schema JSON NOT NULL, INDEX IDX_2A979110D96C566B (path_id), INDEX IDX_2A979110D5D96477 (path_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE path (id INT AUTO_INCREMENT NOT NULL, open_api_document_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', endpoint VARCHAR(255) NOT NULL, INDEX IDX_B548B0F2D58E2A8 (open_api_document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE path_item (id INT AUTO_INCREMENT NOT NULL, path_id INT NOT NULL, request_body_id INT DEFAULT NULL, summary LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, http_method VARCHAR(7) NOT NULL, INDEX IDX_7277AC49D96C566B (path_id), UNIQUE INDEX UNIQ_7277AC49B1466FD3 (request_body_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE path_item_tag (path_item_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_A6E9E2EBD5D96477 (path_item_id), INDEX IDX_A6E9E2EBBAD26311 (tag_id), PRIMARY KEY(path_item_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request_body (id INT AUTO_INCREMENT NOT NULL, content JSON NOT NULL, required TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `schema` (id INT AUTO_INCREMENT NOT NULL, content JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, open_api_document_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_389B7832D58E2A8 (open_api_document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE http_response ADD CONSTRAINT FK_32C80BE6D5D96477 FOREIGN KEY (path_item_id) REFERENCES path_item (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A979110D96C566B FOREIGN KEY (path_id) REFERENCES path (id)');
        $this->addSql('ALTER TABLE parameter ADD CONSTRAINT FK_2A979110D5D96477 FOREIGN KEY (path_item_id) REFERENCES path_item (id)');
        $this->addSql('ALTER TABLE path ADD CONSTRAINT FK_B548B0F2D58E2A8 FOREIGN KEY (open_api_document_id) REFERENCES open_api_document (id)');
        $this->addSql('ALTER TABLE path_item ADD CONSTRAINT FK_7277AC49D96C566B FOREIGN KEY (path_id) REFERENCES path (id)');
        $this->addSql('ALTER TABLE path_item ADD CONSTRAINT FK_7277AC49B1466FD3 FOREIGN KEY (request_body_id) REFERENCES request_body (id)');
        $this->addSql('ALTER TABLE path_item_tag ADD CONSTRAINT FK_A6E9E2EBD5D96477 FOREIGN KEY (path_item_id) REFERENCES path_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE path_item_tag ADD CONSTRAINT FK_A6E9E2EBBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B7832D58E2A8 FOREIGN KEY (open_api_document_id) REFERENCES open_api_document (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE path DROP FOREIGN KEY FK_B548B0F2D58E2A8');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B7832D58E2A8');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A979110D96C566B');
        $this->addSql('ALTER TABLE path_item DROP FOREIGN KEY FK_7277AC49D96C566B');
        $this->addSql('ALTER TABLE http_response DROP FOREIGN KEY FK_32C80BE6D5D96477');
        $this->addSql('ALTER TABLE parameter DROP FOREIGN KEY FK_2A979110D5D96477');
        $this->addSql('ALTER TABLE path_item_tag DROP FOREIGN KEY FK_A6E9E2EBD5D96477');
        $this->addSql('ALTER TABLE path_item DROP FOREIGN KEY FK_7277AC49B1466FD3');
        $this->addSql('ALTER TABLE path_item_tag DROP FOREIGN KEY FK_A6E9E2EBBAD26311');
        $this->addSql('DROP TABLE http_response');
        $this->addSql('DROP TABLE open_api_document');
        $this->addSql('DROP TABLE parameter');
        $this->addSql('DROP TABLE path');
        $this->addSql('DROP TABLE path_item');
        $this->addSql('DROP TABLE path_item_tag');
        $this->addSql('DROP TABLE request_body');
        $this->addSql('DROP TABLE `schema`');
        $this->addSql('DROP TABLE tag');
    }
}
