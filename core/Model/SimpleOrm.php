<?php

namespace Core\Model;

use mysqli;

abstract class SimpleOrm
{
    protected static mysqli $conn;

    protected static string $table, $pk = 'id';

    protected array $attributes = [];

    protected array $modifies = [];

    protected bool $isCreated = false;

    public const FETCH_NONE = 0;
    public const FETCH_ONE = 1;
    public const FETCH_MANY = 2;

    public function __construct(array $attributes = []) {
        $this->attributes = $attributes;
    }

    public static function find($id)
    {
        $row = static::exec("SELECT * FROM :table WHERE :pk = ?", $id)->get_result()->fetch_assoc();

        if ($row === null) {
            return;
        }

        return static::hydrate($row);
    }

    public static function findBy(string $field, $value)
    {
        $row = static::exec("SELECT * FROM :table WHERE $field = ?", $value)->get_result()->fetch_assoc();

        if ($row === null) {
            return;
        }

        return static::hydrate($row);
    }

    public function findManyBy(string $field, $value)
    {
        return static::hydrateMany(
            static::exec("SELECT * FROM :table WHERE $field = ?", $value)->get_result()->fetch_all(MYSQLI_ASSOC)
        );
    }

    public static function all()
    {
        return static::sql("SELECT * FROM :table", static::FETCH_MANY);
    }

    public static function sql(string $sql, $mode = self::FETCH_NONE)
    {
        $sql = str_replace([':table', ':pk'], [static::$table, static::$pk], $sql);

        $result = static::$conn->query($sql);

        if ($mode === static::FETCH_ONE) {
            $result = $result->fetch_assoc();

            return is_null($result) ? null : static::hydrate($result);
        }

        if ($mode === static::FETCH_MANY) {
            return static::hydrateMany($result->fetch_all(MYSQLI_ASSOC));
        }

        return;
    }

    public static function exec(string $sql, ...$params)
    {
        $sql = str_replace([':table', ':pk'], [static::$table, static::$pk], $sql);

        $types = array_reduce($params, function ($carry, $item) {
            return $carry .= substr(gettype($item), 0, 1);
        }, '');

        $query = static::$conn->prepare($sql);
        $query->bind_param($types, ...$params);
        $query->execute();

        return $query;
    }

    public function isDirty()
    {
        return !empty($this->modifies);
    }

    public function save()
    {
        if ($this->isDirty()) {
            $this->isCreated ? $this->update() : $this->insert();
        }
    }

    public function delete()
    {
        if ($this->isCreated) {
            static::sql("DELETE FROM :table WHERE :pk = " . $this->{static::$pk});
        }

        $this->isCreated = false;
    }

    final protected function insert()
    {
        $fields = implode(',', array_keys($this->modifies));

        $binds = array_reduce(range(1, count($this->modifies)), function ($carry, $item) {
            return ltrim($carry .= ',?', ',');
        }, '');

        $query = static::exec("INSERT INTO :table ($fields) VALUES ($binds)", ...array_values($this->modifies));

        $this->attributes[static::$pk] = $query->insert_id;

        $this->isCreated = true;
        $this->modifies = [];
    }

    final protected function update()
    {
        $binds = array_reduce(array_keys($this->modifies), function ($carry, $field) {
            $carry[] = "$field = ?";

            return $carry;
        }, []);

        $binds = implode(',', $binds);

        static::exec(
            "UPDATE :table SET $binds WHERE :pk = ?",
            ...[...array_values($this->modifies), $this->{static::$pk}]
        );

        $this->modifies = [];
    }

    protected static function hydrate(array $attributes)
    {
        $model = new static;

        $model->attributes = $attributes;
        $model->isCreated = true;

        return $model;
    }

    protected static function hydrateMany(array $entries)
    {
        return array_map(function ($attributes) {
            return static::hydrate($attributes);
        }, $entries);
    }

    public static function useConnection(mysqli $connect)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        static::$conn = $connect;
    }

    public function __get(string $key)
    {
        return $this->modifies[$key] ?? $this->attributes[$key] ?? null;
    }

    public function __set(string $key, $value)
    {
        $this->modifies[$key] = $value;
    }
}
