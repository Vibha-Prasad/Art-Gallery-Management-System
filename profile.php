<?php

require_once 'php_files/login_helper.php';
init_session();
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}
require_once 'php_files/db.php';
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>
        Art Gallery
    </title>
    <?php
    require_once 'links.php';
    ?>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="/Art Gallery"> Art Gallery </a>
    <div>
        <?php ?>
        <a class="btn btn-outline-light" href="logout.php">Logout</a>
        <?php ?>
    </div>
</nav>


<div class="container">
    <br>
    <h1>Purchases</h1>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Order #</th>
            <th scope="col">Order date</th>
            <th scope="col">Art name</th>
            <th scope="col">Rating</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $query = 'SELECT o.ord_id, o.ord_by, o.ord_date, a.art_name, a.art_id from orders o, arts a where o.art_ordered=a.art_id';
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            //var_dump($row);
            $qs = 'SELECT * FROM reviews WHERE art_reviewed= ? AND rev_by = ?';
            $stmt = $conn->prepare($qs);
            $stmt->bind_param('ii', $row['art_id'], $row['ord_by']);
            $stmt->execute();
            $r = $stmt->get_result();

            if ($r->num_rows > 0) {
                $r = $r->fetch_assoc();
                $x = "<td>{$r['rating']} stars</td>";
            } else {
                $x = "<td><a href='rate.php?art={$row['art_id']}'>Give rating</a></td>";
            }
            $html = "
    <tr>
        <th scope=\"row\">{$row['ord_id']}</th>
        <td>{$row['ord_date']}</td>
        <td>{$row['art_name']}</td>
        $x
    </tr>";
            echo $html;
        }
        ?>


        </tbody>
    </table>
</div>
<div class="modal" tabindex="-1" role="dialog" id="">
    <div class="modal-dialog" role="document">
        <form method="post" action="rate.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="number" class="form-control" name="review" placeholder="No. of stars" required/>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Rate</button>
                </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>