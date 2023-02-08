<?php 
    $res = $templateParams["risultati"];
    $currUser = $_SESSION["username"];
    if (empty($res)) {
        echo "<h1 class='text-center'>Nessun risultato</h1>";
    }
    else {
        foreach($res as $r) {
            if ($r["username"] !== $currUser) {
                echo 
                "<div class='d-flex justify-content-between border border-dark rounded bg-light text-dark p-3 m-2'>
                    <div class='d-flex align-items-center' style='width:40vw;'>
                        <img src='". $r['nomefile'] ."' style='width:3vw; height:3vw' />
                        <div class=''>
                            <span class='font-weight-bold'>
                                <a href='user.php?username=" . $r["username"] . "'>" . $r["username"] . "</a><br>
                            </span>
                            <span class='text-muted'>
                                " . $r["bio"] . "
                            </span>
                        </div>
                    </div>
                    <button type='button' class='btn btn-primary btn-sm btn-block' style='width:5vw' onclick=''>Segui</button>
                </div>";
            }
        }
    }