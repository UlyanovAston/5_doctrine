<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230325172518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE book_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE series_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE author (id INT NOT NULL, fio VARCHAR(255) NOT NULL, birthday DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE book (id INT NOT NULL, series_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, page_count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CBE5A3315278319C ON book (series_id)');
        $this->addSql('CREATE TABLE book_author (book_id INT NOT NULL, author_id INT NOT NULL, PRIMARY KEY(book_id, author_id))');
        $this->addSql('CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)');
        $this->addSql('CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)');
        $this->addSql('CREATE TABLE series (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3315278319C FOREIGN KEY (series_id) REFERENCES series (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql("
            INSERT INTO author(id, fio, birthday) VALUES
            (nextval('author_id_seq'), 'Юревич Порфирий', '2011-01-03'::DATE),
            (nextval('author_id_seq'), 'Щербатов Агафодор', '2000-05-17'::DATE),
            (nextval('author_id_seq'), 'Дуров Арес', '1777-12-12'::DATE)
        ");
        $this->addSql("INSERT INTO series(id, name) VALUES (nextval('series_id_seq'), 'Властелин браслетов'), (nextval('series_id_seq'), 'Звёздные переговоры')");
        $this->addSql("
            INSERT INTO book(id, series_id, name, page_count) VALUES
            (nextval('book_id_seq'), null, 'Победить дорогу', 123),
            (nextval('book_id_seq'), 2, 'Созидая ненависть', 100),
            (nextval('book_id_seq'), null, 'Песня ветра', 428),
            (nextval('book_id_seq'), 1, 'Книга тьмы', 345),
            (nextval('book_id_seq'), 1, 'Мастер фантазий', 543),
            (nextval('book_id_seq'), 2, 'Мир без котов', 999),
            (nextval('book_id_seq'), null, 'Свет одинокого фонаря', 10),
            (nextval('book_id_seq'), null, 'Парень с нашего кладбища', 450),
            (nextval('book_id_seq'), 2, 'И сделать шаг', 300),
            (nextval('book_id_seq'), 1, 'Дом вечных фантазий', 585)
        ");
        $this->addSql("
            INSERT INTO book_author(book_id, author_id) VALUES
            (1, 1),
            (2, 2), (2, 3),
            (3, 2),
            (4, 1), (4, 2), (4, 3),
            (5, 2),
            (6, 3),
            (7, 1), (7, 2),
            (8, 3),
            (9, 1), (9, 2),
            (10, 1)
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA IF NOT EXISTS public');
        $this->addSql('DROP SEQUENCE author_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE book_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE series_id_seq CASCADE');
        $this->addSql('ALTER TABLE book DROP CONSTRAINT FK_CBE5A3315278319C');
        $this->addSql('ALTER TABLE book_author DROP CONSTRAINT FK_9478D34516A2B381');
        $this->addSql('ALTER TABLE book_author DROP CONSTRAINT FK_9478D345F675F31B');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('DROP TABLE series');
    }
}
