<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250123123026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_64C19C1EA750E8 (label), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intern (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, birth_date DATE NOT NULL, genre VARCHAR(5) NOT NULL, city VARCHAR(200) NOT NULL, phone VARCHAR(25) NOT NULL, UNIQUE INDEX UNIQ_A5795F36E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intern_session (intern_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_A6D9BBE2525DD4B4 (intern_id), INDEX IDX_A6D9BBE2613FECDF (session_id), PRIMARY KEY(intern_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_C2426285E237E06 (name), INDEX IDX_C24262812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, module_id INT NOT NULL, total_days INT NOT NULL, INDEX IDX_92ED7784613FECDF (session_id), INDEX IDX_92ED7784AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, trainer_id INT DEFAULT NULL, training_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, places INT NOT NULL, begin_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_D044D5D4FB08EDF6 (trainer_id), INDEX IDX_D044D5D4BEFD98D1 (training_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trainer (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_C5150820E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intern_session ADD CONSTRAINT FK_A6D9BBE2525DD4B4 FOREIGN KEY (intern_id) REFERENCES intern (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intern_session ADD CONSTRAINT FK_A6D9BBE2613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4FB08EDF6 FOREIGN KEY (trainer_id) REFERENCES trainer (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intern_session DROP FOREIGN KEY FK_A6D9BBE2525DD4B4');
        $this->addSql('ALTER TABLE intern_session DROP FOREIGN KEY FK_A6D9BBE2613FECDF');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262812469DE2');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784613FECDF');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784AFC2B591');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4FB08EDF6');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4BEFD98D1');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE intern');
        $this->addSql('DROP TABLE intern_session');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE trainer');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
