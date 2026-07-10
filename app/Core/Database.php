<?php

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private ?PDO $pdo = null;
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function connection(): PDO
    {
        $this->ensureConnection();

        return $this->pdo;
    }

    public function query(string $sql, array $params = []): array
    {
        $this->ensureConnection();
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        return $statement->fetchAll();
    }

    public function statement(string $sql, array $params = []): PDOStatement
    {
        $this->ensureConnection();
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        return $statement;
    }

    public function lastInsertId(): string
    {
        $this->ensureConnection();

        return $this->pdo->lastInsertId();
    }

    public function beginTransaction(): bool
    {
        $this->ensureConnection();

        return $this->pdo->beginTransaction();
    }

    public function commit(): bool
    {
        $this->ensureConnection();

        return $this->pdo->commit();
    }

    public function rollBack(): bool
    {
        $this->ensureConnection();

        return $this->pdo->rollBack();
    }

    private function ensureConnection(): void
    {
        if ($this->pdo !== null) {
            return;
        }

        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $this->config['host'],
            $this->config['port'],
            $this->config['database'],
            $this->config['charset']
        );

        try {
            $this->pdo = new PDO($dsn, $this->config['username'], $this->config['password'], $this->config['options']);
        } catch (PDOException $e) {
            throw new \RuntimeException('Database connection failed: ' . $e->getMessage(), 0, $e);
        }
    }
}
