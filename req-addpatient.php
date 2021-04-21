                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Patient Information</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <input type="text" name="latestid" class="form-control" value="<?php echo $last_id ?>" style="display: none;">

                                        <label>Full Name:</label>
                                        <input type="text" name="pname" class="form-control" placeholder="Full name like in IC..." required>

                                        <label>IC/Passport:</label>
                                        <input type="text" name="passport" class="form-control" placeholder="IC or passport number..." required>

                                        <label>Address:</label>
                                        <input type="text" name="address" class="form-control" placeholder="Your current address..." required>

                                        <label>Phone No:</label>
                                        <input type="text" name="phoneno" class="form-control" placeholder="Your phone number..." required>

                                        <label>Gender:</label>
                                        <select name="gender" class="form-select">
                                            <option value="">Select...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                                        <label>Birthday Date:</label>
                                        <input type="date" id="dob" name="dob" class="form-control" autocomplete="off" placeholder="Select date of birth..." required>

                                        <label>Nationality:</label>
                                        <select name="national" class="form-select">
                                            <option value="">Select...</option>
                                            <option value="Malaysian">Malaysian</option>
                                            <option value="Non-Malaysian">Non-Malaysian</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" name="submitpatient" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
