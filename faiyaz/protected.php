<?php
class Employee3
{
    public $name;
    private $salary;

    public function __contruct($name, $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->describe();
    }
    protected function describe()
    {
        echo "Name of the programmer is: $this->name<br>";
        echo "Salary of the programmer is: $this->salary<br>";
    }
}
class Programmer3 extends Employee3{
    public $lang="php" ;
    public function __contruct($name,$lang, $salary)
    {
        $this->name = $name;
        $this->lang = $lang;
        $this->salary = $salary;
        $this->describe();
    }

}
$faiyaz = new Employee3("Faiyaz",398463);
$sumit = new Programmer3("Sumit",984373);