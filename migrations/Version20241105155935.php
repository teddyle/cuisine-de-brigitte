<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105155935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, measuring_unit_id INT DEFAULT NULL, ingredient_list_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_6BAF78704584665A (product_id), INDEX IDX_6BAF7870DCAFB353 (measuring_unit_id), INDEX IDX_6BAF78703C991D4D (ingredient_list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_list (id INT AUTO_INCREMENT NOT NULL, recipe_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_1A99488E59D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instruction_list (id INT AUTO_INCREMENT NOT NULL, recipe_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_C47F4FCE59D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measuring_unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, note LONGTEXT DEFAULT NULL, servings INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78704584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870DCAFB353 FOREIGN KEY (measuring_unit_id) REFERENCES measuring_unit (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78703C991D4D FOREIGN KEY (ingredient_list_id) REFERENCES ingredient_list (id)');
        $this->addSql('ALTER TABLE ingredient_list ADD CONSTRAINT FK_1A99488E59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE instruction_list ADD CONSTRAINT FK_C47F4FCE59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78704584665A');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870DCAFB353');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78703C991D4D');
        $this->addSql('ALTER TABLE ingredient_list DROP FOREIGN KEY FK_1A99488E59D8A214');
        $this->addSql('ALTER TABLE instruction_list DROP FOREIGN KEY FK_C47F4FCE59D8A214');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_list');
        $this->addSql('DROP TABLE instruction_list');
        $this->addSql('DROP TABLE measuring_unit');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
