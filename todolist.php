<?php


class TodoList {

    private $todolistName;
    private $myTodoList;
    private $db;

    // init
    public function __construct(string $todoListName)
    {
        $this->todolistName = $todoListName;

        $conf = new DbConfig($todoListName);
        $this->db = $conf->getDbFile();
    }

    public function getTodos() : array
    {
        $this->myTodoList = json_decode(file_get_contents($this->db));
        return $this->myTodoList;
    }

    // create todolist
    private function create(){

    }

    // add
    public function add(){
        $task = $_POST['mytodo'];
        if (!empty($task)){
            $this->myTodoList[] = $task;
            $this->save();
        }
    }

    // delete
    public function delete(int $id){
        unset($this->myTodoList[$id - 1]);
        $this->myTodoList = array_values( $this->myTodoList );
        $this->save();
    }
    // update
    public function update(int $id){

        $id--;
        $update = $_POST['update'];
        if(!empty($update)){
            $this->myTodoList[$id] = $update;
            $this->save();
        }



        }




    // status change
    public function statusChange(){}


    // save file
    public function save(){
        file_put_contents($this->db, json_encode($this->myTodoList));
        header('location:/');
    }

}