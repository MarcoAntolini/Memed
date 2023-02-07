<?php 
    require_once "../modules/bootstrap.php";
    $templateParams["titolo"] = "Memed - Ricerca";
    $templateParams["risultati"] = $mysqli->ottieniUtentiPerNome($_GET['search']);
    $res = $templateParams["risultati"];
    $currUser = $_SESSION["username"];
    if (empty($res)) {
        echo "Nessun risultato.";
    }
    foreach ($res as $r) {
        if ($r["username"] == $currUser) {
            continue;
        } else {
            echo 
            "<div class='d-flex justify-content-between border border-dark rounded bg-light text-dark p-3 m-2'>
                <div class='d-flex align-items-center' style='width:40vw;'>
                    <svg class='icon icon-tabler icon-tabler-accessible' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                        <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                        <circle cx='12' cy='12' r='9' />
                        <path d='M10 16.5l2 -3l2 3m-2 -3v-2l3 -1m-6 0l3 1' />
                        <circle cx='12' cy='7.5' r='.5' fill='currentColor' />
                    </svg>
                    <div class=''>
                        <span class='font-weight-bold'>
                            <a href='" . $r["username"] . "'>" . $r["username"] . "</a><br>
                        </span>
                        <span class='text-muted'>
                            sasso" . $r["bio"] . "
                        </span>
                    </div>
                </div>
                <button type='button' class='btn btn-primary btn-sm btn-block' style='width:5vw' onclick=''>Segui</button>
            </div>";
        }
    }
    require "../template/logged-base-view.php";
    /* TODO:
        add onclick='follow()' to button
        add href to username
        add bio
        add photo (in the db tho) and replace the svg
    */
