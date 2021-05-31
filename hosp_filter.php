 <?php
                    if (isset($_GET['keywords'])) {
                        $keywords = $_GET['keywords'];
                        $query = "SELECT DISTINCT (DATE(FROM_UNIXTIME(start_appoint, '%Y-%m-%d'))) 
                            AS unique_date, COUNT(*) AS amount
                            FROM `appointwoo`
                            WHERE DATEDIFF(NOW(), FROM_UNIXTIME(appointwoo.end_appoint, '%Y-%m-%d')) > 1 
                            AND hosp_name = ? 
                            AND statusapp='complete'
                            GROUP BY unique_date
                            ORDER BY unique_date DESC";
                        //$result = mysqli_query($conn, $query);
                        //$res = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        $result = $conn->prepare($query);
                        $result->bind_param("s", $keywords);
                        $result->execute();
                        $res = $result->get_result()->fetch_all(MYSQLI_ASSOC);
                    }
?>