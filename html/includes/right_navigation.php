                <div class="column2">
					<img src="images/title4.gif" alt="" width="133" height="18" /><br />
					
					<div class="news">
						<span>12 may 0000</span><br />
						<img src="images/pic5.jpg" alt="" width="183" height="97" />
						<p>Proin nunc. Donec massa. Nulla pulvinar, nisl ac convallis nonummy, tellus eros sodales enim, in tincidunt mauris in odio.  massa ac laoreet iaculipede nisl ullamcorpermassa,consectetuer </p>
						<a href="#" class="more">more info</a>
					</div>
                                        <div class="news">
                                            <?php
                                                 if(isset($_SESSION['login_id']))
                                                 {
                                                    echo "Enter your comments";
                                                    print <<<_HTML_
                                                    <form action = "insert_comment.php" method=POST>
                                                        CITY<br/>
                                                        <input type="text" value="" name="city" >
                                                        <br/><br/>
                                                        Time of Visit<br/>
                                                        <input type="text" value="" name="time_of_visit" >
                                                        <br/><br/>
                                                        EXPECTED EXPENDITURE<br/>
                                                        <input type="text"  value="" name="expected_expenditure" >
                                                        <br/><br/>
                                                        RATING<br/>
                                                        <input type="text"  value="" name="rating" >
                                                        <br/><br/>
                                                        COMMENTS
                                                        <br/>
                                                        <input type="text"  value="" name="comments" >
                                                        <br/><br/>
                                                        SUGGESTIONS<br/>
                                                        <input type="text" value="" name="suggestions" >
                                                        <br/><br/>
                                                        <input type="submit" value="Enter">
                                                    </form>
_HTML_;

                                                }
                                            ?>

					</div>
				</div>
