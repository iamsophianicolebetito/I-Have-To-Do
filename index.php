<!DOCTYPE html>
<html>
    <head>
        <?php include "db.php"; ?>
        <title> I Have To ... </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <!-- header -->
        <div class="heading"><br>
            <p style="font-family: Courier; color: #ffffff; font-size:20px;"><strong> Manage Your Time . Plan . Make it Easy </strong><br>
                <i>Organize the things you need to do. </i>
            </p>
        </div>

        <!-- form for inputing task -->
        <form method="post" action="index.php" class="input_form">
            <?php if (isset($errors)) { ?>
                <p><?php echo $errors; ?></p>
            <?php } ?>
            
            <!-- Field to save the id of the task -->
            <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
            
            <!-- Changes button to update/save -->
            <?php if ($update == true): ?>
                <input type = "text" name = "task" class = "task_input" value = "<?php echo $task; ?>">
                <button type = "submit" name = "update" id = "add_btn" class = "add_btn"><strong> Update </strong></button>

            <?php else: ?>
                <input type = "text" name = "task" class="task_input" value = "<?php echo $task; ?>" placeholder = "Add Task">
                <button type = "submit" name = "submit" id = "add_btn" class = "add_btn"><strong> Save </strong></button>
            <?php endif; ?>
        </form>

        <table>
            <thead>
                <tr style="font-family: Cambria; ">
                    <th width = "15%"> NO. </th>
                    <th width = "500%"> TASKS </th>
                    <th width = "12%" colspan ="2"> ACTION </th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    // select all tasks if page is visited or refreshed
                    $list = mysqli_query($con, "SELECT * FROM list");

                    $i = 1; while ($row = mysqli_fetch_array($list)) { ?>
                    <tr>
                        <!--task printing-->
                        <td> <?php echo $i; ?> </td>
                        <td class="task"> <?php echo $row['task']; ?> </td>

                        <!--Edit button-->
                        <td class="edit"> 
                            <a href="index.php?edit=<?php echo $row['id'] ?>"><button class = "edit_btn"><strong>  Edit  </strong></button></a>
                        </td>

                        <!--Delete button-->
                        <td class="delete"> 
                             <a href="index.php?del=<?php echo $row['id'] ?>"><button class = "del_btn"><strong> Delete  </strong></button></a>
                        </td>
                    </tr>
                <?php $i++; } ?>	
            </tbody>
        </table>
    </body>
</html>