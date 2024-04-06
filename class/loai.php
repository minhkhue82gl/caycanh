<?php   include 'DB.php';
        $sql = "SELECT * FROM loai";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["loai_id"] . '">'. $row["tenloai"] . '</option>';          }
        } ?>