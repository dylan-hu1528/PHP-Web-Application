
<?php 
    function UpdateSchedule() {
        $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
        if (!$conn) {
            die('Cannot connect'.mysqli_connect_error());
        }

        // get the total number of doses
        $doseNum = "select * from dose where status = 'available'";
        $results = mysqli_query($conn,$doseNum) or die(mysqli_connect_error());
        $num = mysqli_num_rows($results);

        // get table of all possible assignments of doses to patients, ordered by increasing priority and decreasing age.
        $query = "select * from (select * from (
                select * from patient where patientid not in (
                select patientid from waitlist where trackingnumber is not null))a 
                join (
                select trackingnumber, expirationdate from dose join vaccinebatch on dose.batchid = vaccinebatch.batchid and status = 'available')b 
                on earliestdate < expirationdate)a join (select * from patient)b on a.patientid = b.patientid order by a.priority, a.age desc;";
        $results = mysqli_query($conn,$query) or die(mysqli_connect_error());
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC);

        echo "<br>";
        
        // loop until all doses are assigned
        for ($i = 0; $i < $num; $i++) {

            // if there are unscheduled patients
            if (mysqli_num_rows($results) > 0) {

                // get sorted Patient table
                $ageOrder = "select * from patient order by priority, age desc;";
                $results = mysqli_query($conn,$ageOrder) or die(mysqli_connect_error());
                
                // check if the patient is waiting in Waitlist
                $checkDup = "select * from waitlist where patientid = ".$row['patientid'].";";
                $dResults = mysqli_query($conn,$checkDup) or die(mysqli_connect_error());

                // if patient is not waiting
                if (mysqli_num_rows($dResults) == 0) {
                    // try adding to Waitlist table
                    $insertWaitlist = "insert into waitlist(dates, patientid, trackingnumber) values('".$row['EarliestDate']."', ".$row['patientid'].", ".$row['trackingnumber']." );";
                    if(!mysqli_query($conn, $insertWaitlist)) {
                        echo "ERROR: Could not able to execute $insertWaitlist. " . mysqli_error($conn);
                    }
                    else {
                        echo "Patient No.".$row['patientid']." has been added to Waitlist(Assigned). <br>";
                    }
                }

                // if patient is waiting
                else if (mysqli_num_rows($dResults) == 1) {
                    // try updating tracking number
                    $updateWaitlist = "update waitlist set trackingnumber = ".$row['trackingnumber']." where patientid = ".$row['patientid'].";";
                    if(!mysqli_query($conn, $updateWaitlist)) {
                        echo "ERROR: Could not able to execute $updateWaitlist. " . mysqli_error($conn);
                    }
                    else {
                        echo "Patient No.".$row['patientid']." has been added to Waitlist(Assigned). <br>";
                    }
                }

                // else error
                else {
                    echo "ERROR: Unexpected number of patient with patient ID of ".$row['patientid']." is found in Waitlist.";
                }

                // update the status of dose
                $updateDose = "update dose set status = 'assigned' where trackingnumber =".$row['trackingnumber'].";";
                if(!mysqli_query($conn, $updateDose)) {
                    echo "ERROR: Could not able to execute $updateDose. " . mysqli_error($conn);
                }
            }

            // update query result since the status of a dose is possibly changed per loop
            $results = mysqli_query($conn,$query) or die(mysqli_connect_error());
            $row = mysqli_fetch_array($results, MYSQLI_ASSOC);

        }

        // get the table of waiting patients
        $numWaiting = "select * from patient where patientid not in (select patientid from waitlist);";
        $results = mysqli_query($conn,$numWaiting) or die(mysqli_connect_error());

        // add waiting patients to Waitlist
        while ($row = mysqli_fetch_array($results)) {
            $insertWaitlist = "insert into waitlist(dates, patientid, trackingnumber) values('".$row['EarliestDate']."', ".$row['patientid'].", null );";
            if(!mysqli_query($conn, $insertWaitlist)) {
                echo "ERROR: Could not able to execute $insertWaitlist. " . mysqli_error($conn);
            }
            else {
                echo "Patient No.".$row['patientid']." has been added to Waitlist(Waiting). <br>";
            }
        }

        // show the number of doses needed for waiting patients
        if (mysqli_num_rows($results) > 0) {
            echo "<br>No available doses are available right now. ";
        }

        // else all are scheduled
        else if (mysqli_num_rows($results) == 0) {
            echo "<br>All patients are scheduled.";
        }

        // update the status of doses
        $query = "select * from waitlist where trackingnumber != null;";
        $results = mysqli_query($conn,$query) or die(mysqli_connect_error());
        while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            if ($row['Dates'] < date("Y-m-d")) {
                $update = "update dose set status = 'used' where trackingnumber =".$row['trackingnumber'].";";
                if(!mysqli_query($conn, $update)) {
                    echo "ERROR: Could not able to execute $update. " . mysqli_error($conn);
                }
            }
        }

    }

?>