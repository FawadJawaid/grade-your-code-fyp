<?php

$query = $this->db->get_where('course');
        if ($query != NULL) {
            $this->load->model('course');
            $c = array();
            foreach ($query->result('course') as $row) {
                $courses[] = $row;
            }
        }
        echo '<div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 3%; padding-bottom: 3%;">
';
        echo form_open('teacher/announcement');
         echo '<h1>Announcement <br></h1>';
            echo form_textarea(['type' => 'text','class' => 'form-control', 'id' => 'sc', 'name' => 'anounce',  'style' => 'width:500px;height:20%;margin-bottom:20px']);
           
            echo "<p><label for='category' class='label label-default' style='font-size:100%;' >Category </label><br />";

                echo "<select name='id' class='selectpicker' data-size='200px' >";

                for ($i = 0; $i < count($courses); $i++) {
                    echo "<option value='" . $courses[$i]->Code . "' >" . $courses[$i]->Name . "</option>";
                }

                echo "</select><br/>";
echo form_submit(['value' => 'Create Announcement', 'class' => 'btn btn-large btn-primary', 'style' => 'margin-top:20px;']);
            echo form_close();
            echo '</div>';
?>