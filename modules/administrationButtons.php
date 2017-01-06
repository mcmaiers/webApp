<?php
$postAction = 'add';

$prefill_name = '';
$prefill_roomId ='';
$prefill_type = '';
$prefill_id = '';
$prefill_buttonText = '';
$prefill_wh1 = '';
$prefill_wh2 = '';
$prefill_wh3 = '';
$prefill_link = '';
$prefill_identifier = '';
$prefill_sortid = '';

$header = 'Neuen Button anlegen';
$submitText = 'Speichern';
$prefill_id = '';
if(isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = $_GET['id'];
    $postAction = 'update';
    $result = mysqlquery("SELECT * FROM buttons WHERE id = ".$id);
    if($row = mysqlfetch($result)) {
        $prefill_name = $row['name'];
        $prefill_roomId = $row['roomId'];
        $prefill_type = $row['type'];
        $prefill_id = $row['id'];
        $prefill_buttonText = $row['buttonText'];
        $prefill_wh1 = $row['webhook1'];
        $prefill_wh2 = $row['webhook2'];
        $prefill_wh3 = $row['webhook3'];
        $prefill_link = $row['link'];
        $prefill_sortid = $row['sortId'];
        $prefill_identifier = $row['identifier'];
    }
    $header = 'Button bearbeiten: '.$prefill_name;
    $submitText = 'Update';
}



if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    $buttonId = $_GET['id'];
    $sql = "DELETE FROM buttons WHERE id = ".$buttonId."";
    mysqlquery($sql);
    echo '<div class="alert alert-success">
    Button wurde erfolgreich gelöscht!
    </div>';
}

if(isset($_GET['action']) && $_GET['action'] == 'add') {

    $name = $_POST['name'];
    $buttonText = $_POST['buttonText'];
    $type = $_POST['type'];
    $room = $_POST['room'];
    $webhook1 = $_POST['webhook1'];
    $webhook2 = $_POST['webhook2'];
    $webhook3 = $_POST['webhook3'];
    $link = $_POST['link'];


    if($type == '4') {
        $identifier = $_POST['identifier'];
    } else {
        $identifier = $name;
    }

    $sql = "
    INSERT INTO buttons
        (
            name,
            buttonText,
            type,
            identifier,
            roomId,
            webhook1,
            webhook2,
            webhook3,
            link
        )
        VALUES
        (
            '".utf8_decode($name)."',
            '".utf8_decode($buttonText)."',
            '".$type."',
            '".$identifier."',
            '".$room."',
            '".$webhook1."',
            '".$webhook2."',
            '".$webhook3."',
            '".$link."'
        )
    ";
    mysqlquery($sql);

    echo '<div class="alert alert-success">
    Button wurde erfolgreich erstellt!
    </div>';

}

if(isset($_GET['action']) && $_GET['action'] == 'update') {
    $name = $_POST['name'];
    $buttonText = $_POST['buttonText'];
    $type = $_POST['type'];
    $room = $_POST['room'];
    $webhook1 = $_POST['webhook1'];
    $webhook2 = $_POST['webhook2'];
    $webhook3 = $_POST['webhook3'];
    $link = $_POST['link'];
    $identifier = $_POST['identifier'];
    $id = $_POST['id'];
    $sortid = $_POST['sortid'];

    $sql = "UPDATE buttons SET
      name = '".$name."' ,
      buttonText = '".$buttonText."',
      type = ".$type.",
      roomId = ".$room.",
      webhook1 = '".$webhook1."',
      webhook2 = '".$webhook2."',
      webhook3 = '".$webhook3."',
      link = '".$link."',
      identifier = '".$identifier."',
      sortId = '".$sortid."'
      WHERE id = ".$id;
    mysqlquery($sql);
    echo '<div class="alert alert-success">
    Button wurde erfolgreich bearbeitet!
    </div>';
}
$Homee = new Homee(HOMEE_HOST,HOMEE_ADMIN,HOMEE_PASSWORD);
$homeegrams = $Homee->getHomeeGrams();
?>


<script>
    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        hideAll();

        $('#type').on('change', function() {
            hideAll();

            if(this.value == '1') {
                $('.js-bt').show();
                $('.js-wh1').show();
                $('.js-wh1-label').text("WebHook");
            }

            if(this.value == '3') {
                $('.js-wh1').show();
                $('.js-wh2').show();
                $('.js-wh1-label').text("WebHook Ein");
                $('.js-wh2-label').text("WebHook Aus");
            }

            if(this.value == '2') {
                $('.js-wh1').show();
                $('.js-wh2').show();
                $('.js-wh3').show();
                $('.js-wh1-label').text("WebHook Hoch");
                $('.js-wh2-label').text("WebHook Stop");
                $('.js-wh3-label').text("WebHook Runter");
            }

            if(this.value == '4') {
                $('.js-i').show();
            }

            if(this.value == '5') {
                $('.js-wh1').show();
                $('.js-l').show();
                $('.js-wh1-label').text("WebHook Klick auf Bild");
            }
        })


        function hideAll() {
            $('.js-bt').hide();
            $('.js-wh1').hide();
            $('.js-wh2').hide();
            $('.js-wh3').hide();
            $('.js-l').hide();
            $('.js-i').hide();
        }

        <?php
            if(!empty($prefill_type)) {
                ?>
                if(<?php echo $prefill_type; ?> == 1) {
                    $('.js-bt').show();
                    $('.js-wh1').show();
                    $('.js-wh1-label').text("WebHook");
                }
                if(<?php echo $prefill_type; ?> == 2) {
                    $('.js-wh1').show();
                    $('.js-wh2').show();
                    $('.js-wh3').show();
                    $('.js-wh1-label').text("WebHook Hoch");
                    $('.js-wh2-label').text("WebHook Stop");
                    $('.js-wh3-label').text("WebHook Runter");
                }
                if(<?php echo $prefill_type; ?> == 3) {
                    $('.js-wh1').show();
                    $('.js-wh2').show();
                    $('.js-wh1-label').text("WebHook Ein");
                    $('.js-wh2-label').text("WebHook Aus");
                }
                if(<?php echo $prefill_type; ?> == 4) {
                    $('.js-i').show();
                }
                if(<?php echo $prefill_type; ?> == 5) {
                    $('.js-wh1').show();
                    $('.js-l').show();
                    $('.js-wh1-label').text("WebHook Klick auf Bild");
                }
                <?php
            }
            ?>

    });




</script>

<form action="index.php?module=administrationButtons&action=<?php echo $postAction; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
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
                <label class="control-label col-sm-4" for="room">Raum:</label>
                <div class="col-sm-8">
                    <select class="form-control" name="room" id="room">
                        <?php
                        $result = mysqlquery("SELECT * FROM rooms");
                        while($row = mysqlfetch($result)) {

                            $floorName = '';
                            $resultf = mysqlquery("SELECT * FROM floors where id = ".$row['floorId']);
                            if($rowf = mysqlfetch($resultf)) {
                                $floorName = $rowf['name'];
                            }

                            $selected = '';
                            if($prefill_roomId == $row['id']) {
                                $selected = 'selected = "selected"';
                            }
                            echo '<option '.$selected.' value="'.$row['id'].'">'.utf8_encode($row['name']) . ' ('.$floorName.')</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="type">Typ:</label>
                <div class="col-sm-8">
                    <select class="form-control" name="type" id="type">
                        <option <?php if($prefill_type == '0') { echo 'selected = "selected"';} ?> value="0">Bitte wählen</option>
                        <option <?php if($prefill_type == '1') { echo 'selected = "selected"';} ?> value="1">Einfacher Button für einen Webhook</option>
                        <option <?php if($prefill_type == '3') { echo 'selected = "selected"';} ?> value="3">Ein/Aus Button für 2 Webhooks</option>
                        <option <?php if($prefill_type == '2') { echo 'selected = "selected"';} ?> value="2">Rollo Bedienelemente für 3 Webhooks</option>
                        <option <?php if($prefill_type == '4') { echo 'selected = "selected"';} ?> value="4">Ein/Aus Button für 433 Mhz</option>
                        <option <?php if($prefill_type == '5') { echo 'selected = "selected"';} ?> value="5">IP Cam</option>
                    </select>
                </div>
            </div>

            <div class="form-group js-bt">
                <label class="control-label col-sm-4" for="buttonText">Button Text:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="buttonText" value="<?php echo $prefill_buttonText; ?>" name="buttonText">
                </div>
            </div>






            <div class="form-group js-wh1">
                <label class="control-label col-sm-4 js-wh1-label" for="webhook1">Webhook 1:</label>
                <div class="col-sm-8">
                    <select class="form-control" name="webhook1" id="webhook1">
                        <?php
                        echo '<option value="">-</option>';
                        foreach($homeegrams['homeegrams'] as $homeegram) {
                            if(isset($homeegram['triggers']['webhook_triggers'][0])) {

                                $value = $homeegram['triggers']['webhook_triggers'][0]['event'];
                                $selected = '';
                                if($prefill_wh1 == $value) {
                                    $selected = 'selected = "selected"';
                                }
                                echo '<option '.$selected.' value="'.$value.'">'.$homeegram['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group js-wh2">
                <label class="control-label col-sm-4  js-wh2-label" for="webhook2">Webhook 2:</label>
                <div class="col-sm-8">
                    <select class="form-control" name="webhook2" id="webhook2">
                        <?php
                        echo '<option value="">-</option>';
                        foreach($homeegrams['homeegrams'] as $homeegram) {
                            if(isset($homeegram['triggers']['webhook_triggers'][0])) {

                                $value = $homeegram['triggers']['webhook_triggers'][0]['event'];
                                $selected = '';
                                if($prefill_wh2 == $value) {
                                    $selected = 'selected = "selected"';
                                }
                                echo '<option '.$selected.' value="'.$value.'">'.$homeegram['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group js-wh3">
                <label class="control-label col-sm-4 js-wh3-label" for="webhook3">Webhook 3:</label>
                <div class="col-sm-8">
                    <select class="form-control" name="webhook3" id="webhook3">
                        <?php
                        echo '<option value="">-</option>';
                        foreach($homeegrams['homeegrams'] as $homeegram) {
                            if(isset($homeegram['triggers']['webhook_triggers'][0])) {
                                $value = $homeegram['triggers']['webhook_triggers'][0]['event'];
                                $selected = '';
                                if($prefill_wh3 == $value) {
                                    $selected = 'selected = "selected"';
                                }
                                echo '<option '.$selected.' value="'.$value.'">'.$homeegram['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>


            <div class="form-group js-l">
                <label class="control-label col-sm-4" for="link">IP Cam Link:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="link" value="<?php echo $prefill_link; ?>" name="link">
                </div>
            </div>

            <div class="form-group js-i">
                <label class="control-label col-sm-4" for="identifier">Identifier:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="identifier" value="<?php echo $prefill_identifier; ?>" name="identifier">
                </div>
            </div>

            <?php
            if($postAction == 'update') {
            ?>
                <div class="form-group js-s">
                    <label class="control-label col-sm-4" for="sortid" data-toggle="tooltip" data-placement="right" title="Hier kannst du eine Sortierung angeben. Je größer die ID ist desto weiter unten wird der Button angeordnet">Sortierung:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="sortid" value="<?php echo $prefill_sortid; ?>" name="sortid">
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>


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
            <th>Button</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $result = mysqlquery("SELECT * FROM buttons ORDER BY sortId ASC");
    while($row = mysqlfetch($result))
    {
        echo '
        <tr>
            <th>'.$row['name'].'</th>
            <th><a href="index.php?module=administrationButtons&action=edit&id='.$row['id'].'" type="button" style="width: 100%;" class="btn btn-success glyphicon glyphicon-edit"></a></th>
            <th><a data-toggle="modal" data-target="#confirm-delete" data-itemname="'.$row['name'].'" href="#" data-href="index.php?module=administrationButtons&action=delete&id='.$row['id'].'" type="button" style="width: 100%;" class="btn btn-danger glyphicon glyphicon-trash"></a></th>
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
                Soll dieser Button wirklich gelöscht werden?
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