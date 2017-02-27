<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";

    $server = 'mysql:host=localhost:8889;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2017-02-21";
            $test_task = new Task($description, $due_date, $id);
            $test_task->save();

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2017-02-21";
            $test_task = new Task($description, $due_date, $id);

            //Act
            $test_task->save();

            //Assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2017-02-21";
            $test_task = new Task($description, $due_date, $id);
            $test_task->save();


            $description2 = "Water the lawn";
            $due_date2 = "2017-02-21";
            $test_task2 = new Task($description2, $due_date2, $id);
            $test_task2->save();

            //Act
            $result = Task::getAll();
            // echo("result is: ");
            // var_dump($result[0]);
            // var_dump($result[1]);


            //Assert
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2017-02-21";
            $test_task = new Task($description, $due_date, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $due_date2 = "2017-02-21";
            $test_task2 = new Task($description2, $due_date2, $id);
            $test_task2->save();

            //Act
            Task::deleteAll();

            //Assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2017-02-21";
            $test_task = new Task($description, $due_date, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $due_date2 = "2017-02-21";
            $test_task2 = new Task($description2, $due_date2, $id);
            $test_task2->save();

            //Act
            $result = Task::find($test_task->getId());

            //Assert
            $this->assertEquals($test_task, $result);
        }

        function test_sort()
        {
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $due_date = "2017-02-21";
            $test_task = new Task($description, $due_date, $id);
            $test_task->save();

            $description2 = "Water the lawn";
            $due_date2 = "2017-01-21";
            $test_task2 = new Task($description2, $due_date2, $id);
            $test_task2->save();

            $result = Task::getAll();


            $this->assertEquals([$test_task2, $test_task], $result);

        }

    }
?>
