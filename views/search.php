<?php require_once "views/layouts/master.php"; ?>

<h1>Results</h1>

<?php require_once "views/layouts/search-form.php"; ?>

<?php
if (isset($_SESSION['user']))
{
    if (isset($_SESSION['result']))
    {
        $results = json_decode($_SESSION['result']);
        if ($results)
        {
            echo "<table class='table table-striped'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>        
                ";

            foreach ($results as $index => $result)
            {
                echo "<tr><td>" . ($index + 1) . "</td><td>{$result->name}</td><td>{$result->email}</td></tr>";
            }
        }
        else
        {
             echo "<h2>There is no results for that input!";
        }
    }
}
?>