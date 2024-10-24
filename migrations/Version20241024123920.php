<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024123920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__project AS SELECT id, name, deadline, created_at, updated_at FROM project');
        $this->addSql('DROP TABLE project');
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, deadline DATETIME DEFAULT NULL, created_at VARCHAR(255) NOT NULL, updated_at VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO project (id, name, deadline, created_at, updated_at) SELECT id, name, deadline, created_at, updated_at FROM __temp__project');
        $this->addSql('DROP TABLE __temp__project');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, assign_user_id, project_id, title, description, status, priority, dead_line, created_at, updated_at FROM ticket');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, assign_user_id INTEGER DEFAULT NULL, project_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, priority VARCHAR(255) NOT NULL, dead_line DATETIME DEFAULT NULL, created_at VARCHAR(255) NOT NULL, updated_at VARCHAR(255) NOT NULL, CONSTRAINT FK_97A0ADA3AE8454D5 FOREIGN KEY (assign_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_97A0ADA3166D1F9C FOREIGN KEY (project_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticket (id, assign_user_id, project_id, title, description, status, priority, dead_line, created_at, updated_at) SELECT id, assign_user_id, project_id, title, description, status, priority, dead_line, created_at, updated_at FROM __temp__ticket');
        $this->addSql('DROP TABLE __temp__ticket');
        $this->addSql('CREATE INDEX IDX_97A0ADA3166D1F9C ON ticket (project_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3AE8454D5 ON ticket (assign_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket_status_history AS SELECT id, ticket_id, changed_user_id, status, change_at, created_at, updated_at FROM ticket_status_history');
        $this->addSql('DROP TABLE ticket_status_history');
        $this->addSql('CREATE TABLE ticket_status_history (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ticket_id INTEGER DEFAULT NULL, changed_user_id INTEGER DEFAULT NULL, status VARCHAR(255) NOT NULL, change_at DATETIME NOT NULL, created_at VARCHAR(255) NOT NULL, updated_at VARCHAR(255) NOT NULL, CONSTRAINT FK_D6921C0D700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D6921C0DD0B87009 FOREIGN KEY (changed_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticket_status_history (id, ticket_id, changed_user_id, status, change_at, created_at, updated_at) SELECT id, ticket_id, changed_user_id, status, change_at, created_at, updated_at FROM __temp__ticket_status_history');
        $this->addSql('DROP TABLE __temp__ticket_status_history');
        $this->addSql('CREATE INDEX IDX_D6921C0DD0B87009 ON ticket_status_history (changed_user_id)');
        $this->addSql('CREATE INDEX IDX_D6921C0D700047D2 ON ticket_status_history (ticket_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, password, roles, created_at, updated_at, is_verified FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , created_at VARCHAR(255) NOT NULL, updated_at VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, password, roles, created_at, updated_at, is_verified) SELECT id, email, password, roles, created_at, updated_at, is_verified FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__project AS SELECT id, name, deadline, created_at, updated_at FROM project');
        $this->addSql('DROP TABLE project');
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, deadline DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO project (id, name, deadline, created_at, updated_at) SELECT id, name, deadline, created_at, updated_at FROM __temp__project');
        $this->addSql('DROP TABLE __temp__project');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket AS SELECT id, assign_user_id, project_id, title, description, status, priority, dead_line, created_at, updated_at FROM ticket');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('CREATE TABLE ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, assign_user_id INTEGER DEFAULT NULL, project_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, priority VARCHAR(255) NOT NULL, dead_line DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_97A0ADA3AE8454D5 FOREIGN KEY (assign_user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_97A0ADA3166D1F9C FOREIGN KEY (project_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticket (id, assign_user_id, project_id, title, description, status, priority, dead_line, created_at, updated_at) SELECT id, assign_user_id, project_id, title, description, status, priority, dead_line, created_at, updated_at FROM __temp__ticket');
        $this->addSql('DROP TABLE __temp__ticket');
        $this->addSql('CREATE INDEX IDX_97A0ADA3AE8454D5 ON ticket (assign_user_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3166D1F9C ON ticket (project_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticket_status_history AS SELECT id, ticket_id, changed_user_id, status, change_at, created_at, updated_at FROM ticket_status_history');
        $this->addSql('DROP TABLE ticket_status_history');
        $this->addSql('CREATE TABLE ticket_status_history (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ticket_id INTEGER DEFAULT NULL, changed_user_id INTEGER DEFAULT NULL, status VARCHAR(255) NOT NULL, change_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_D6921C0D700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D6921C0DD0B87009 FOREIGN KEY (changed_user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticket_status_history (id, ticket_id, changed_user_id, status, change_at, created_at, updated_at) SELECT id, ticket_id, changed_user_id, status, change_at, created_at, updated_at FROM __temp__ticket_status_history');
        $this->addSql('DROP TABLE __temp__ticket_status_history');
        $this->addSql('CREATE INDEX IDX_D6921C0D700047D2 ON ticket_status_history (ticket_id)');
        $this->addSql('CREATE INDEX IDX_D6921C0DD0B87009 ON ticket_status_history (changed_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, password, roles, is_verified, created_at, updated_at FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , is_verified BOOLEAN NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, password, roles, is_verified, created_at, updated_at) SELECT id, email, password, roles, is_verified, created_at, updated_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
