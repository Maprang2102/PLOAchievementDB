<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="./css/page.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</head>

<body>
   <?php require('./connect_program.php');
            require("./navbar.php");?>
   <div id="container">
      <div class="box">
         <table style='width:100%;' class="table table-hover ">
         <thead>
                    <tr>
                        <th>Number</th>
                        <th>Program</th>
                        <th>Program ID</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            <?php
            
            $query = "SELECT * FROM programs ";
            $sql = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($sql)) {
               $program_id = $row['program_id'];
               $program_name = $row['program_name'];
               $year = $row['year'];
            ?>
               <tr id="<?php echo $program_id; ?>" class="edit_tr">

                  <td class="edit_td">
                     <span id="name_<?php echo $program_id; ?>" class="text"><?php echo $program_name; ?></span>
                     <input type="text" value="<?php echo $program_name; ?>" class="editbox" id="name_input_<?php echo $program_id; ?>" /&gt; </td>

                  <td class="edit_td">
                     <span id="year_<?php echo $program_id; ?>" class="text"><?php echo $year; ?></span>
                     <input type="text" value="<?php echo $year; ?>" class="editbox" id="year_input_<?php echo $program_id; ?>" />
                  </td>

               </tr>
            <?php
            }
            ?>
            </tbody>
         </table>
      </div>
   </div>
</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
      $(".edit_tr").click(function() {
         var ID = $(this).attr('id');
         $("#name_" + ID).hide();
         $("#year_" + ID).hide();
         $("#name_input_" + ID).show();
         $("#year_input_" + ID).show();
      }).change(function() {
         var ID = $(this).attr('id');
         var name = $("#name_input_" + ID).val();
         var year = $("#year_input_" + ID).val();
         var dataString = 'id=' + ID + '&name=' + name + '&year=' + year;
         $("#name_" + ID).html('<img src="load.gif" />'); // Loading image

         if ( year.length > 0) {

            $.ajax({
               type: "POST",
               url: "table_edit_ajax.php",
               data: dataString,
               cache: false,
               success: function(html) {
                  $("#name_" + ID).html(name);
                  $("#year_" + ID).html(year);
               }
            });
            alert('ajax');
         } else {
            alert('Enter something.');
         }

      });

      // Edit input box click action
      $(".editbox").mouseup(function() {
         return false
      });

      // Outside click action
      $(document).mouseup(function() {
         $(".editbox").hide();
         $(".text").show();
      });

   });
</script>
<style>
   body {
      /* font-family: Arial, Helvetica, sans-serif; */
      font-size: 14px;
   }

   .editbox {
      display: none
   }

   td {
      padding: 5px;
   }

   .editbox {
      font-size: 14px;
      width: 270px;
      background-color: #ffffcc;
      border: solid 1px #000;
      padding: 4px;
   }

   .edit_tr:hover {
      background: url(edit.png) right no-repeat #80C8E5;
      cursor: pointer;
   }
</style>

</html>