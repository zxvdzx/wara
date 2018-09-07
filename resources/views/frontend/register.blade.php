<!-- Modal1 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="signin-form profile">
                    <h3 class="agileinfo_sign">Sign In</h3> 
                    <div class="login-form">
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="E-mail" required="">
                            <input type="password" name="password" placeholder="Password" required="">
                            <div class="tp">
                                <input type="submit" value="Sign In" disabled>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="login-social-grids">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        </ul>
                    </div> -->
                    <!-- <p><a href="#" data-toggle="modal" data-target="#myModal3" > Don't have an account?</a></p> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //Modal1 -->   
<!-- Modal2 -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="signin-form profile">
                    <h3 class="agileinfo_sign">Sign Up</h3> 
                    <div class="login-form">
                        <form action="#" method="post">
                            <input name="firstName" type="text" required="" placeholder="First Name">
                            <input name="lastName" type="text" required="" placeholder="Last Name">
                            <input name="email" type="email" required="" placeholder="Email">
                            <input name="placeOfBirth" type="text" required="" placeholder="Place Of Birth">
                            <input class="date" id="datepicker" name="birthdate" type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required=""  placeholder="Date Of Birth">
                            <input name="password" type="text" required="" placeholder="password">
                            <input name="passwordConfirm" type="text" required="" placeholder="Confirm Password">
                            <input name="phone" type="text" required="" placeholder="Phone">
                            <input name="address" type="text" required="" placeholder="Address">
                            <input name="gender" type="text" required="" placeholder="Gender">
                            
                            <input type="submit" value="Sign Up">
                        </form>
                    </div>
                    <p><a href="#"> By clicking Sign Up, I agree to your terms</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"> </div> 
<!-- //Modal2 -->   