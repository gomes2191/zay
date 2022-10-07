<?php

/*
 * Modelo base, todos os outros modelos se estendem-se a este modelo.
 */

namespace App\Core\Database;

use App\Core\App;
use RuntimeException;
use Exception;

/**
 * Class Model
 * @package App\Core\Database
 */
abstract class Model
{

    /**
     * Nome da TB do Modelo.
     * @var string
     */
    protected static $table = '';

    /**
     * O ID do Modelo.
     * @var int
     */
    protected $id = 0;

    /**
     * As colunas para o Modelo.
     * @var array
     */
    protected $cols = [];

    /**
     * As linhas para o Modelo.
     * @var array
     */
    protected $rows = [];

    /**
     * Este método retorna a última consulta SQL via query builder.
     * @return string
     * @throws Exception
     */
    public function getSql(): string
    {
        return App::DB()->setClassName(get_class($this))->getSql();
    }

     /**
     * Encontra uma ou mais linhas no BD com base no ID e o vincula ao Modelo ou retorna nulo se não forem encontradas linhas.
     * @param $id
     * @return $this
     * @throws Exception
     */
    public function find($id): ?Model
    {
        $this->cols = App::DB()->setClassName(get_class($this))->describe(static::$table);
        $this->rows = App::DB()->setClassName(get_class($this))->selectAllWhere(static::$table, [[$this->cols[0]->Field, '=', $id]]);
        return !empty($this->rows) ? $this : null;
    }

    /**
     * Encontra uma ou mais linhas no BD com base no ID e o vincula ao Modelo, ou lança uma exceção se não forem encontradas linhas.
     * @param $id
     * @return $this
     * @throws Exception
     */
    public function findOrFail($id): Model
    {
        $this->cols = App::DB()->setClassName(get_class($this))->describe(static::$table);
        $this->rows = App::DB()->setClassName(get_class($this))->selectAllWhere(static::$table, [[$this->cols[0]->Field, '=', $id]]);
        if (!empty($this->rows)) {
            return $this;
        }
        throw new RuntimeException("ModelNotFoundException");
    }

     /**
     * Encontra uma ou mais linhas que correspondem a critérios específicos no BD e as vincula ao Modelo, depois retorna o Modelo.
     * @param $where
     * @return $this
     * @throws Exception
     */
    public function where($where, $limit = "", $offset = ""): Model
    {
        $this->cols = App::DB()->setClassName(get_class($this))->describe(static::$table);
        $this->rows = App::DB()->setClassName(get_class($this))->selectAllWhere(static::$table, $where, $limit, $offset);
        return $this;
    }

    /**
     * Retorna a contagem das linhas de uma consulta de BD.
     * @param $where
     * @return int|bool
     * @throws Exception
     */
    public function count($where = "")
    {
        if (!empty($where)) {
            return App::DB()->setClassName(get_class($this))->countWhere(static::$table, $where);
        }
        return App::DB()->setClassName(get_class($this))->count(static::$table);
    }

    /**
     * Adiciona a linha ao banco de dados e a vincula ao modelo.
     * @param $columns
     * @return $this
     * @throws Exception
     */
    public function add($columns): Model
    {
        $this->id = App::DB()->insert(static::$table, $columns);
        $this->cols = App::DB()->setClassName(get_class($this))->describe(static::$table);
        $this->rows = App::DB()->setClassName(get_class($this))->selectAllWhere(static::$table, [[$this->cols[0]->Field, '=', $this->id]]);
        return $this;
    }

    /**
     * Atualiza uma ou mais linhas no banco de dados.
     * @param $parameters
     * @return int
     * @throws Exception
     */
    public function update($parameters): int
    {
        return App::DB()->update(static::$table, $parameters);
    }

    /**
     * Atualiza uma ou mais linhas no BD que correspondem a critérios específicos.
     * @param $parameters
     * @param $where
     * @return int
     * @throws Exception
     */
    public function updateWhere($parameters, $where): int
    {
        return App::DB()->updateWhere(static::$table, $parameters, $where);
    }

    /**
     * Exclui uma ou mais linhas do banco de dados.
     * @return int
     * @throws Exception
     */
    public function delete(): int
    {
        return App::DB()->delete(static::$table);
    }

    /**
     * Exclui uma ou mais linhas do banco de dados que correspondem a critérios específicos.
     * @param $where
     * @return int
     * @throws Exception
     */
    public function deleteWhere($where): int
    {
        return App::DB()->deleteWhere(static::$table, $where);
    }

    /**
     * Atualiza uma ou mais linhas no banco de dados.
     * @return $this
     * @throws Exception
     */
    public function save(): Model
    {
        $this->cols = App::DB()->setClassName(get_class($this))->describe(static::$table);
        $newValues = [];
        foreach ($this->cols as $col) {
            $newValues[$col->Field] = $this->{$col->Field};
        }
        App::DB()->updateWhere(static::$table, $newValues, [[$this->cols[0]->Field, '=', $this->{$this->cols[0]->Field}]]);
        return $this;
    }

    /**
     * Retorna e vincula uma ou mais linhas do banco de dados ao modelo.
     * @return Model[]|false
     * @throws Exception
     */
    public static function all()
    {
        return App::DB()->setClassName(static::class)->selectAll(static::$table);
    }

    /**
     * Busca todas as linhas da Model.
     * @return Model[]
     */
    public function get(): array
    {
        return $this->rows;
    }

    /**
     * Busca todas as colunas para o modelo.
     * Isso retorna as colunas se estiverem armazenadas em cache, caso contrário, elas serão buscadas novamente primeiro.
     * @return array
     */
    public function describe(): array
    {
        if (!$this->cols) {
           $this->cols = App::DB()->setClassName(get_class($this))->describe(static::$table);
        }
        return $this->cols;
    }

    /**
     * Busca a primeira linha da Model.
     * @return Model|null
     */
    public function first(): ?Model
    {
        return $this->rows[0] ?? null;
    }

    /**
     * Busca a primeira linha para o modelo ou lança uma exceção se uma linha não for encontrada.
     * @return Model
     * @throws Exception
     */
    public function firstOrFail(): Model
    {
        if (!empty($this->rows[0])) {
            return $this->rows[0];
        }
        throw new RuntimeException("ModelNotFoundException");
    }

    /**
     * Retorna o valor da chave primária para a Model ou null se não tiver um.
     * @return string|null
     * @throws Exception
     */
    public function id(): ?string
    {
        if (!$this->cols) {
           $this->cols = App::DB()->setClassName(get_class($this))->describe(static::$table);
        }
        return $this->{$this->cols[0]->Field} ?? null;
    }

    /**
     * Retorna o nome da chave primária para a Model ou null se não tiver um.
     * @return string|null
     * @throws Exception
     */
    public function primary(): ?string
    {
        if (!$this->cols) {
           $this->cols = App::DB()->setClassName(get_class($this))->describe(static::$table);
        }
        return $this->cols[0]->Field ?? null;
    }
}