<header>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</header>
<?php
include_once('config.php');
$pdo=NULL;
function connecttodb()
{
    global $pdo,$host,$database,$password,$username;

    $dsn = "mysql:host=$host;dbname=$database;";
    
    try 
    {
            $pdo = new PDO($dsn, $username, $password);
    } 
    catch (\PDOException $e) 
    {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function myinsert($tablename,$columns,$values)
{
    connecttodb();
    global $pdo;
    if (count($columns) !== count($values)) {
        throw new Exception("Number of columns does not match number of values.");
    }
// $columns=['id','name']
    // Create named placeholders
    $placeholders = array_map(
        function($col) 
        {
        return ":$col";
        }
    , $columns);

    $columnsStr = implode(', ', $columns);
    $placeholdersStr = implode(', ', $placeholders);

    $sql = "INSERT INTO $tablename ($columnsStr) VALUES ($placeholdersStr)";
    $stmt = $pdo->prepare($sql);

    // Bind values to named placeholders
    $params = array_combine($placeholders, $values);
    $stmt->execute($params);

    return $stmt->rowCount();
}

function myupdate($tablename, $columns, $values, $condition) {
    connecttodb();
    global $pdo;
    if (count($columns) !== count($values)) {
        throw new Exception("Number of columns does not match number of values.");
    }

    // Create named placeholders
    $setClause = implode(', ', array_map(function($col) {
        return "$col = :$col";
    }, $columns));

    // Prepare the SQL statement
    $sql = "UPDATE $tablename SET $setClause WHERE $condition";
    $stmt = $pdo->prepare($sql);

    // Bind values to named placeholders
    $params = array_combine(array_map(function($col) {
        return ":$col";
    }, $columns), $values);

    $stmt->execute($params);

    return $stmt->rowCount();
}

function mydelete($tablename, $condition, $params) {
    connecttodb();
    global $pdo;
    // Prepare the SQL statement
    $sql = "DELETE FROM $tablename WHERE $condition";
    $stmt = $pdo->prepare($sql);

    // Execute the statement with the provided parameters
    $stmt->execute($params);

    return $stmt->rowCount(); // Return the number of rows affected
}

function mySelect($tablename, $conditions = [], $fetchAll = true) {
   connecttodb();
    global $pdo;
    try {
       
        // Build query dynamically
        $sql = "SELECT * FROM $tablename";
        
        if (!empty($conditions)) {
            $whereClauses = [];
            foreach ($conditions as $column => $value) {
                $whereClauses[] = "$column = :$column";
            }
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }

        // Prepare and execute statement
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($conditions);

        // Fetch data based on mode
        return $fetchAll ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
