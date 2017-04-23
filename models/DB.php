<?php

/**
 * Class DB
 */
abstract class DB {
    /**
     * @var
     */
    private $con;
    /**
     * @var string
     */
    protected $table = '';
    /**
     * @var
     */
    private $configData;
    /**
     * @var string
     */
    private $queryString;

    /**
     * DB constructor.
     * @param string $queryString
     */
    public function __construct($queryString = "")
    {
        if(!$this->configData)
            $this->configData = json_decode(DBConfig::get());
        $this->connect();
        $this->queryString = $queryString;
    }

    /**
     *
     */
    private function connect(){
        if(!$this->con){
            $this->con = mysqli_connect($this->configData->host,
                                        $this->configData->user,
                                        $this->configData->password,
                                        $this->configData->database);
            mysqli_set_charset($this->con,"utf8");
        }
    }

    /**
     * @param $str
     * @return bool|mysqli_result
     */
    private function query($str)
    {
        return mysqli_query($this->con, $str);
    }

    /**
     * @return $this
     * @author Dusan Perisic
     */
    public function newQuery()
    {
        $this->queryString = "";
        return $this;
    }
    /**
     * @param $str
     * @param null $prepend
     */
    private function appendQueryString($str, $prepend = null)
    {
        if ($prepend)
            $this->queryString = $str . $this->queryString;
        else
            $this->queryString .= $str;
    }

    /**
     * @param string $andOr
     */
    private function checkWhere($andOr = "AND")
    {
        if (!strstr($this->queryString, "WHERE"))
            $this->appendQueryString(" WHERE");
        else
            $this->appendQueryString(" {$andOr}");
    }

    /**
     * @param $key
     * @param null $val
     * @param string $andOr
     * @return $this
     */
    protected function like($key, $val = null, $andOr = "AND")
    {
        $this->checkWhere($andOr);
        $val = $this->testInput($val);
        $this->appendQueryString(" {$key} like '%{$val}%'");
        return $this;
    }

    /**
     * @param $str
     * @param $val
     * @return DB
     */
    protected function orLike($str, $val)
    {
        return $this->like($str, $val, "OR");
    }

    /**
     * @param $key
     * @param $sign
     * @param $val
     * @param string $andOr
     * @return $this
     */
    protected function where($key, $sign, $val, $andOr = "AND")
    {
        $val = $this->testInput($val);
        $this->checkWhere($andOr);
        $this->appendQueryString(" {$key}{$sign}'{$val}'");
        return $this;
    }

    /**
     * @param $key
     * @param $sign
     * @param $val
     * @return DB
     */
    protected function orWhere($key, $sign, $val)
    {
        return $this->where($key, $sign, $val, "OR");
    }

    /**
     * @return bool|mysqli_result
     */
    protected function get()
    {
        $this->appendQueryString("SELECT * FROM {$this->table}", true);
        return $this->query($this->queryString);
    }

    /**
     * @param $data
     * @return bool|mysqli_result
     */
    protected function insert($data)
    {
        return $this->set($data);
    }

    /**
     * @param $data
     * @return bool|mysqli_result
     */
    protected function set($data)
    {
        $fields = "";
        $values = "";

        $first = 0;
        foreach($data as $field => $value)
        {
            $value = $this->testInput($value);
            $fields .= ($first > 0 ? "," : "") . $field;
            $values .= ($first > 0 ? "," : "") . "'{$value}'";
            $first = 1;
        }
        return $this->query("INSERT INTO {$this->table} ({$fields}) VALUES ({$values})");
    }

    /**
     * @return bool
     */
    protected function exists()
    {
        $results = $this->get();
        if ($results ? mysqli_num_rows($results) : false)
            return true;
        else
            return false;
    }

    /**
     * @param string $input
     * @return string
     * @author Dusan Perisic
     */
    protected function testInput( string $input)
    {
        return mysqli_real_escape_string($this->con, $input);
    }
}