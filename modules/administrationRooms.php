<?php

$postAction = 'add';
$prefill_name = '';
$prefill_floorId = '';
$prefill_sortid = '';

$header = 'Neues Zimmer anlegen';
$submitText = 'Speichern';
$prefill_id = '';
if(isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = $_GET['id'];

    $postAction = 'update';
    $result = mysqlquery("SELECT * FROM rooms WHERE id = ".$id."  ORDER BY sortId ASC");
    if($row = mysqlfetch($result)) {
        $prefill_name = $row['name'];
        $prefill_floorId = $row['floorId'];
        $prefill_id = $row['id'];
        $prefill_sortid = $row['sortId'];
    }
    $header = 'Zimmer bearbeiten: '.$prefill_name;
    $submitText = 'Update';
}


if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM rooms WHERE id = ".$id."";
    mysqlquery($sql);

    echo '<div class="alert alert-success">
    Zimmer wurde erfolgreich gelöscht!
    </div>';
}

if(isset($_GET['action']) && $_GET['action'] == 'add') {


    $name = $_POST['name'];
    $floorId = $_POST['floorId'];

    $sql = "
    INSERT INTO rooms
        (
            name,
            floorId
        )
        VALUES
        (
            '".utf8_decode($name)."',
            '".$floorId."'
        )
    ";
    mysqlquery($sql);

    echo '<div class="alert alert-success">
    Zimmer wurde erfolgreich erstellt!
    </div>';

}

if(isset($_GET['action']) && $_GET['action'] == 'update') {
    $name = $_POST['name'];
    $floorId = $_POST['floorId'];
    $id = $_POST['id'];
    $sortid = $_POST['sortid'];
    $sql = "UPDATE rooms SET name = '".utf8_decode($name)."' , floorId = ".$floorId." , sortId = '".$sortid."' WHERE id = ".$id;
    mysqlquery($sql);
    echo '<div class="alert alert-success">
    Zimmer wurde erfolgreich bearbeitet!
    </div>';
}
?>


<form action="index.php?module=administrationRooms&action=<?php echo $postAction; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
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

            <div class="form-group">
                <label class="control-label col-sm-4" for="room">Ebene:</label>
                <div class="col-sm-8">
                    <select class="form-control" name="floorId" id="floorId">
                        <?php
                        $result = mysqlquery("SELECT * FROM floors");
                        while($row = mysqlfetch($result)) {

                            $selected = '';
                            if($prefill_floorId == $row['id']) {
                                $selected = 'selected = "selected"';
                            }
                            echo '<option '.$selected.' value="'.$row['id'].'">'.utf8_encode($row['name']) . '</option>';
                        }
                        ?>
                    </select>
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
            <th>Zimmer</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $result = mysqlquery("SELECT * FROM rooms");
    while($row = mysqlfetch($result))
    {

        $floorName = '';
        $resultf = mysqlquery("SELECT * FROM floors where id = ".$row['floorId']);
        if($rowf = mysqlfetch($resultf)) {
            $floorName = $rowf['name'];
        }
        echo '
        <tr>
            <th>'.utf8_encode($row['name']).' ('.$floorName.')</th>
            <th><a href="index.php?module=administrationRooms&action=edit&id='.$row['id'].'" type="button" style="width: 100%;" class="btn btn-success glyphicon glyphicon-edit"></a></th>
            <th><a data-toggle="modal" data-target="#confirm-delete" data-itemname="'.$row['name'].'" href="#" data-href="index.php?module=administrationRooms&action=delete&id='.$row['id'].'" type="button" style="width: 100%;" class="btn btn-danger glyphicon glyphicon-trash"></a></th>
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
                Soll dieses Zimmer wirklich gelöscht werden?
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