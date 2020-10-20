<?php 

    //create a new PDO connection object
    $conn = new PDO('mysql:host=localhost;dbname=makemerichbank;charset=utf8mb4',
        'root',
        '', 
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );


    try {

        // $conn->beginTransaction();

        // withdraw 1000 from savings account
        $handle = $conn->prepare("UPDATE BankAccount SET Balance = Balance - 1000 WHERE AccountID = 1");
        $handle->execute();

        // throw new Exception("Simulate error....");

        // transfer 1000 to the spendingsaccount
        $handle = $conn->prepare("UPDATE BankAccount SET Balance = Balance + 1000 WHERE AccountID = 2");
        $handle->execute();

        // $conn->commit();
        // echo "Committed transaction.<br/>";
        echo "Succesfully transferred your money :)<br/>";
    }
    catch (Exception $e) {
        echo "An error occured: " . $e . "<br/>";

        //$conn->rollBack();
       // echo "Rollback.... Nothing has been committed.";  
    }

?>