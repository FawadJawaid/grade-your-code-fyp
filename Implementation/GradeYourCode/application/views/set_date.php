
<div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 5%; padding-left: 5%; padding-top: 5%; padding-bottom: 5%;">
<?php
  echo" <form method='POST' action='" . base_url('index.php/teacher/post_quiz') . "'>";
        $time = time();
        $actual_date = date('D M Y', $time);

        $actual_time = date('H:i:s', $time);
        // echo $actual_time;

        echo" <input style ='width:400px; height: 50px'type='text' name='fname' value='Current Date: " . $actual_date . "  " . "Current Time:" . $actual_time . "' disabled> <br><br>";
        echo'  <select name="month" id="month" class=""><option value="0" selected="1">Month</option><option value="January">Jan</option><option value="February">Feb</option><option value="March">Mar</option><option value="April">Apr</option><option value="May">May</option><option value="June">Jun</option><option value="July">Jul</option><option value="August">Aug</option><option value="September">Sep</option><option value="October">Oct</option><option value="November">Nov</option><option value="December">Dec</option></select>';
        //echo' <option value="0" selected="1">Month</option><option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option> '; 
        echo' <select name="day" id="day" class="_5dba"><option value="0" selected="1">Day</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>';
        echo'  <select name="year" id="year" class="_5dba"><option value="0" selected="1">Year</option><option value="2014">2014</option><option value="2015">2015</option></select>';
        echo'  <select name="hour" id="hr" class=""><option value="0" selected="1">Hour</option><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select>';
        echo'  <select name="min" id="dn" class=""><option value="0" selected="1">Minute</option>';
        for ($i = 1; $i < 61; $i++) {

            echo"  <option value='" . $i . "' >" . $i . "</option>";
        }
        echo"</select>";
        echo'  <select name="dn" id="dn" class=""><option value="0" selected="1">Select</option><option value="pm">PM</option><option value="am">AM</option></select>';
        echo "<input type='hidden' name='quiz' value='" . $quiz->id . "'>";
        echo" <input type='submit' value='Submit' class='btn btn-large btn-primary'>";


        echo" </form>";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</div>
