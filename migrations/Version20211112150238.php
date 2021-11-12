<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112150238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE staff (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, status VARCHAR(255) NOT NULL, telephone VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, modele VARCHAR(150) NOT NULL, km INT NOT NULL, prix DOUBLE PRECISION NOT NULL, nombres_proprietaires INT DEFAULT NULL, cylindree VARCHAR(100) NOT NULL, puissance VARCHAR(100) NOT NULL, mise_circulation DATE DEFAULT NULL, carburant VARCHAR(50) NOT NULL, transmission VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, options LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE voiture');
    }
}
