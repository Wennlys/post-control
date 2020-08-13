<?php

declare(strict_types=1);

namespace Tests\Integration;

use Source\Core\Connection;
use PHPUnit\Framework\TestCase;

class SetUpTest extends TestCase
{
    /** @test */
    public function setUpDatabase()
    {
        $db = (Connection::getInstance())->getConnection();

        $db->exec(
            "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name varchar(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at DATETIME,
                updated_at DATETIME
            );

            CREATE TABLE articles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                slug VARCHAR(191) NOT NULL,
                body TEXT,
                published BOOLEAN DEFAULT FALSE,
                created_at DATETIME,
                updated_at DATETIME,
                UNIQUE (slug),
                FOREIGN KEY(user_id) REFERENCES users(id)
            );

            CREATE TABLE tags (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(191),
                created_at DATETIME,
                updated_at DATETIME,
                UNIQUE (title)
            );

            CREATE TABLE articles_tags (
                article_id INT NOT NULL,
                tag_id INT NOT NULL,
                PRIMARY KEY (article_id, tag_id),
                FOREIGN KEY(tag_id) REFERENCES tags(id),
                FOREIGN KEY(article_id) REFERENCES articles(id)
            );

            INSERT INTO users (name,email, password, created_at, updated_at)
            VALUES
            ('Cake PHP', 'cakephp@example.com', 'secret', date('now'), date('now'));

            INSERT INTO articles (user_id, title, slug, body, published, created_at, updated_at)
            VALUES
            (1, 'First Post', 'first-post', 'This is the first post.', 1, date('now'), date('now'));"
        );

        $this->expectNotToPerformAssertions();
    }
}
