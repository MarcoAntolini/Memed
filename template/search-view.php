<?php
if (empty($res)) {
    echo "<h1 class='text-center'>Nessun risultato</h1>";
} else {
    foreach ($res as $r) {
        if ($r["username"] !== $currUser) {
            if ($mysqli->controllaSegue($r['username'], $currUser)) {
                echo
                "<div class='d-flex justify-content-between border border-dark rounded bg-light text-dark p-3 m-2'>
                        <div class='d-flex align-items-center' style='width:40vw;'>
                            <img src='" . UPLOAD_DIR . $r['nomefile'] . "' style='width:3vw; height:3vw' />
                            <div class=''>
                                <span class='font-weight-bold'>
                                    <a href='user.php?username=" . $r['username'] . "'>" . $r["username"] . "</a><br>
                                </span>
                                <span class='text-muted'>
                                    " . $r['bio'] . "
                                </span>
                            </div>
                        </div>
                        <button type='button' id='" . $r['username'] . "' class='followBtn btn btn-primary btn-sm btn-block' style='width:5vw'>Smetti di seguire</button>
                    </div>";
            } else {
                echo
                "<div class='d-flex justify-content-between border border-dark rounded bg-light text-dark p-3 m-2'>
                        <div class='d-flex align-items-center' style='width:40vw;'>
                            <img src='" . UPLOAD_DIR . $r['nomefile'] . "' style='width:3vw; height:3vw' />
                            <div class=''>
                                <span class='font-weight-bold'>
                                    <a href='user.php?username=" . $r['username'] . "'>" . $r["username"] . "</a><br>
                                </span>
                                <span class='text-muted'>
                                    " . $r['bio'] . "
                                </span>
                            </div>
                        </div>
                        <button type='button' id='" . $r['username'] . "' class='followBtn btn btn-primary btn-sm btn-block' style='width:5vw'>Segui</button>
                    </div>";
            }
        }
    }
}
