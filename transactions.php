<?php 

    //create a new PDO connection object
    $conn = new PDO('mysql:host=localhost;dbname=makemerichbank;charset=utf8mb4',
        'root',
        '', 
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );


    try {

        // start a new transaction (disable auto-commit)
        $conn->beginTransaction();

        // withdraw 1000 from savings account
        $handle = $conn->prepare("UPDATE BankAccount SET Balance = Balance - 1000 WHERE AccountID = 1");
        $handle->execute();
        echo "Succesfully withdrew 1000 from Savings Account :)<br/>";
        
        //echo "Simulating error :( <br/>";
        //throw new Exception("Simulate error....");

        // transfer 1000 to the spendingsaccount
        $handle = $conn->prepare("UPDATE BankAccount SET Balance = Balance + 1000 WHERE AccountID = 2");
        $handle->execute();
        echo "Succesfully deposited 1000 to Spendings Account :)<br/>";
        

        $conn->commit(); // commit both queries as ONE atomic unit (ACID principles...)
        echo "Committed transaction.<br/>";
        echo "Succesfully transferred your money :)<br/>";
    }
    catch (Exception $e) {
        echo "An error occured: " . $e . "<br/>";

        $conn->rollBack(); // if we experience an error, explicitly rollback the first query, so we still have a consistent db (will probably be handled by PDO anyways though)

        /* From http://www.php.net/manual/en/pdo.transactions.php: 
        When the script ends or when a connection is about to be closed, if you have an outstanding transaction, PDO will automatically roll it back. ... if you didn't explicitly commit the transaction, then it is assumed that something went awry, so the rollback is performed for the safety of your data. 
        
        Nevertheless, it is a good practice to explicitly rollback a transaction in case of error. */ 

        echo "Rollback.... Nothing has been committed and our DB is in a consistent state";  
    }

?>