                            <form method="POST">
                                <section id="basic-horizontal-layouts">
                                    <div class="row match-height">
                                        <div class="col-md-6 col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Choose Time</h4>
                                                </div>
                                                <div class="card-content" style="text-align: center;">
                                                    <div class="card-body" style="text-align: center;">
                                                        <div class="form-body" style="text-align: center;">
                                                            <div class="row" style="text-align: center;">
                                                                    <label>Select Time:</label>
                                                                    <p id="demoss"></p>
                                                                    <p id="demo"></p>
                                                                    <input type="text" id="apptime" name="apptime" style="display: none;">
                                                                    <table style="text-align: center;">
                                                                        <thead>
                                                                            <tr style="text-align: center;">
                                                                                <th>&nbsp; MORNING &nbsp;<br><br></th>
                                                                                <th>&nbsp; AFTERNOON &nbsp;<br><br></th>
                                                                                <th>&nbsp; EVENING  &nbsp;<br><br></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <input type="button" id="time" class="btn btn-success" value="09:00AM" onclick="myTime()" 
                                                                                    <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '09:00AM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time3" class="btn btn-success" value="12:00PM" onclick="myTime3()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '12:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time10" class="btn btn-success" value="07:00PM" onclick="myTime10()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '07:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <input type="button" id="time1" class="btn btn-success" value="10:00AM" onclick="myTime1()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '10:00AM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                            <?php }} ?>>
                                                                                </td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time4" class="btn btn-success" value="01:00PM" onclick="myTime4()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '01:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time11" class="btn btn-success" value="08:00PM" onclick="myTime11()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '08:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <input type="button" id="time2" class="btn btn-success" value="11:00AM" onclick="myTime2()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '11:00AM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time5" class="btn btn-success" value="02:00PM" onclick="myTime5()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '02:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time12" class="btn btn-success" value="09:00PM" onclick="myTime12()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '09:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time6" class="btn btn-success" value="03:00PM" onclick="myTime6()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '03:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time7" class="btn btn-success" value="04:00PM" onclick="myTime7()"
                                                                                    <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '04:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time8" class="btn btn-success" value="05:00PM" onclick="myTime8()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '05:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td align="center">
                                                                                    <input type="button" id="time9" class="btn btn-success" value="06:00PM" onclick="myTime9()" <?php
                                                                                        $result=mysqli_query($conn, "SELECT timeonoff FROM xtime WHERE timeonoff = 'Off' AND timedisdate = '$appdate' AND timedisable = '06:00PM'");
                                                                                        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
                                                                                        foreach($user as $row){
                                                                                            if ($row['timeonoff'] == "Off"){ ?>
                                                                                            disabled
                                                                                    <?php }} ?>>
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-6 col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Patient Information</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <form method="POST">
                                                                <div>
                                                                   <input type="text" name="latestid" class="form-control" value="<?php echo $last_id ?>" style="display: none;">

                                                                   <label>Package Name:</label>
                                                                   <input type="text" name="packname" class="form-control" placeholder="Full name like in IC..." required>
                                                                   <br><br>
                                                                   <label>Full Name:</label>
                                                                   <input type="text" name="pname" class="form-control" placeholder="Full name like in IC..." required>
                                                                   <br><br>
                                                                   <label>IC/Passport:</label>
                                                                   <input type="text" name="passport" class="form-control" placeholder="IC or passport number..." required>
                                                                   <br><br>
                                                                   <label>Address:</label>
                                                                   <input type="text" name="address" class="form-control" placeholder="Your current address..." required>
                                                                   <br><br>
                                                                   <label>Phone No:</label>
                                                                   <input type="text" name="phoneno" class="form-control" placeholder="Your phone number..." required>
                                                                   <br><br>
                                                                   <label>Gender:</label>
                                                                   <select name="gender" class="form-select">
                                                                        <option value="">Select...</option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                   </select>
                                                                   <br><br>
                                                                   <label>Birthday Date:</label>
                                                                   <input type="date" id="dob" name="dob" class="form-control" autocomplete="off" placeholder="Select date of birth..." required>
                                                                   <br><br>
                                                                   <label>Nationality:</label>
                                                                   <select name="national" class="form-select">
                                                                        <option value="">Select...</option>
                                                                        <option value="Malaysian">Malaysian</option>
                                                                        <option value="Non-Malaysian">Non-Malaysian</option>
                                                                   </select>
                                                                   <br><br>
                                                                        <div class="col-12 d-flex justify-content-end">
                                                                            <button type="submit" name="submitinformation" class="btn btn-primary me-1 mb-1">SUBMIT</button>
                                                                        </div>
                                                                        <br><br>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </form>

