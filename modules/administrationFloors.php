<?php

$postAction = 'add';
$prefill_name = '';
$prefill_sortid = '';

$header = 'Neue Ebene anlegen';
$submitText = 'Speichern';
$prefill_id = '';
if(isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = $_GET['id'];
    $postAction = 'update';
    $result = mysql_query("SELECT * FROM floors WHERE id = ".$id);
    if($row = mysql_fetch_array($result)) {
        $prefill_name = $row['name'];
        $prefill_id = $row['id'];
        $prefill_sortid = $row['sortId'];
    }
    $header = 'Ebene bearbeiten: '.$prefill_name;
    $submitText = 'Update';
}

if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM floors WHERE id = ".$id."";
    mysql_query($sql);
    echo '<div class="alert alert-success">
    Ebene wurde erfolgreich gelöscht!
    </div>';
}

if(isset($_GET['action']) && $_GET['action'] == 'add') {
    $name = $_POST['name'];
    $sql = "INSERT INTO floors( name)VALUES('".utf8_decode($name)."')";
    mysql_query($sql);
    echo '<div class="alert alert-success">
    Ebene wurde erfolgreich erstellt!
    </div>';
}

if(isset($_GET['action']) && $_GET['action'] == 'update') {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $sortid = $_POST['sortid'];
    $sql = "UPDATE floors SET name = '".utf8_decode($name)."' , sortId = '".$sortid."' WHERE id = ".$id;
    mysql_query($sql);
    echo '<div class="alert alert-success">
    Ebene wurde erfolgreich bearbeitet!
    </div>';
}
?>


<form action="index.php?module=administrationFloors&action=<?php echo $postAction; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
    <input type="hidden" name="id" value="<?php echo $prefill_id; ?>">

    <div class="panel panel-default">
        <div class="panel-heading"><b><?php echo $header; ?></b></div>
        <div class="panel-body">


            <div class="form-group">
                <label class="control-label col-sm-4" for="name">Name:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" value="<?php echo $prefill_name; ?>" name="name">
                </div>
            </div>

            <?php
            if($postAction == 'update') {
                ?>
                <div class="form-group js-s">
                    <label class="control-label col-sm-4" for="sortid">Sortierung:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="sortid" value="<?php echo $prefill_sortid; ?>" name="sortid">
                    </div>
                </div>
                <?php
            }
            ?>
    <input type="submit" value="<?php echo $submitText; ?>" class="form-control btn btn-success">
</form>

<hr/>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#buttons').DataTable(
            "searching": false,
            "paging": false
        );
    } );
</script>

<table id="buttons" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Ebene</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $result = mysql_query("SELECT * FROM floors");
    while($row = mysql_fetch_array($result))
    {
        echo '
        <tr>
            <th>'.utf8_encode($row['name']).'</th>
            <th><a href="index.php?module=administrationFloors&action=edit&id='.$row['id'].'" type="button" style="width: 100%;" class="btn btn-success glyphicon glyphicon-edit"></a></th>
            <th><a data-toggle="modal" data-target="#confirm-delete" data-itemname="'.$row['name'].'" href="#" data-href="index.php?module=administrationFloors&action=delete&id='.$row['id'].'" type="button" style="width: 100%;" class="btn btn-danger glyphicon glyphicon-trash"></a></th>
        </tr>
    ';
    }
    ?>
    </tbody>
</table>

<script type="text/javascript">
    $('#buttons')
        .removeClass( 'display' )
        .addClass('table table-striped table-bordered');
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                Soll diese Ebene wirklich gelöscht werden?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                <a class="btn btn-danger btn-ok">Löschen</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        $(this).find('.modal-header').text('Löschen: ' + $(e.relatedTarget).data('itemname'));
    });
</script>