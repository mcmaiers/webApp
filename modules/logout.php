<?php
session_unset();
session_destroy();
echo '<meta http-equiv="refresh" content="1; URL=index.php">';
?>
<div class="alert alert-success">
    Du wurdest erfolgreich ausgeloggt
</div>
