<?php 
require '../config.php';
$cID=$_REQUEST['cID'];
		
//$sql=mysqli_query($dbconfig,"SELECT * FROM celebrity  WHERE cID='".$cID."'");
//($rows=mysqli_fetch_assoc($sql));
		$cName =$_REQUEST['cName'];
		$cInfo = ($_REQUEST['cInfo']);
		$gender = ($_REQUEST['gender']);
		
?>
<div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee">
  <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
    <tbody>
      <tr>
        <td><table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
            <tbody>
              <tr>
                <td><table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                    <tbody>
                      <tr>
                        <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0"><table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td width="30"></td>
                                <td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"><a href="http://www.clapdust.com/" target="_blank"><img src="http://www.clapdust.com/images/clapdust.jpg" alt="clapdust" ></a></td>
                                <td width="30"></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center"><table width="630" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td colspan="3" height="60"></td>
                              </tr>
                              <tr>
                                <td width="25"></td>
                                <td align="center"><h1 style="font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0">Welcome to Clapdust Blog</h1></td>
                                <td width="25"></td>
                              </tr>
                              <tr>
                                <td colspan="3" height="40"></td>
                              </tr>
                              <tr>
                                <td colspan="5" align="center"><p style="color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0">New Story Added to our Blog</p>
                                  <br>
                                  <p style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0"> 
                              <ul style="display: -moz-groupbox; text-align:start;font-size: 20px;line-height: 31px;">
                              <li> <b>Celebrity Name: </b><?php echo $cName ?></li>
                               <br />
                                <li><b>Gender/Type:</b> <?php echo $gender ?></li>
                                <br />
                                 
                                 <li><b>Celebrity Info: </b><small> <?php echo $cInfo ?></small></li>
                              
                              </ul>
                              </tr>
                              <tr>
                                <td colspan="4"><div style="width:100%;text-align:center;margin:30px 0">
                                    <table align="center" cellpadding="0" cellspacing="0" style="font-family:HelveticaNeue-Light,Arial,sans-serif;margin:0 auto;padding:0">
                                      <tbody>
                                        <tr>
                                          <td align="center" style="margin:0;text-align:center"><a href="http://www.clapdust.com/" style="font-size:21px;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px" target="_blank">Visit website!</a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div></td>
                              </tr>
                              <tr>
                                <td colspan="3" height="30"></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                      <tr bgcolor="#ffffff">
                        <td width="30" bgcolor="#eeeeee"></td>
                        <td><table width="570" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td colspan="4" align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="4" align="center"><h2 style="font-size:24px">Best Tutorials on</h2></td>
                              </tr>
                              <tr>
                                <td colspan="4">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="120" align="right" valign="top"><img src="http://i.imgbox.com/qrfX6RWN.png" alt="tool" width="120" height="120"></td>
                                <td width="30"></td>
                                <td align="left" valign="middle"><h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Programming</h3>
                                  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                  <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">PHP/MySQL, Frameworks (CodeIgniter, CakePHP etc.), CMS (Drupal, WordPress etc.), Ajax, jQuery, JavaScript, HTML, CSS amd many more.</div>
                                  <div style="line-height:10px;padding:0;margin:0">&nbsp;</div></td>
                                <td width="30"></td>
                              </tr>
                              <tr>
                                <td colspan="5" height="40" style="padding:0;margin:0;font-size:0;line-height:0"></td>
                              </tr>
                              <tr>
                                <td width="120" align="right" valign="top"><img src="http://i.imgbox.com/5zbmOytI.png" alt="no fees" width="120" height="120"></td>
                                <td width="30"></td>
                                <td align="left" valign="middle"><h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Web Development</h3>
                                  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                  <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Web development makes simple.</div>
                                  <div style="line-height:10px;padding:0;margin:0">&nbsp;</div></td>
                                <td width="30"></td>
                              </tr>
                              <tr>
                                <td colspan="5" height="40" style="padding:0;margin:0;font-size:0;line-height:0"></td>
                              </tr>
                              <tr>
                                <td width="120" align="right" valign="top"><img src="http://i.imgbox.com/AXtx1Oto.png" alt="creditibility" width="120" height="120" class="CToWUd"></td>
                                <td width="30"></td>
                                <td align="left" valign="middle"><h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">API Implementation</h3>
                                  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                  <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Google, Google+, Google Map, Facebook, Twitter, LinkedIn and many more.</div>
                                  <div style="line-height:10px;padding:0;margin:0">&nbsp;</div></td>
                                <td width="30"></td>
                              </tr>
                              <tr>
                                <td colspan="4">&nbsp;</td>
                              </tr>
                            </tbody>
                          </table>
                          <table width="570" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr>
                                <td><h2 style="color:#404040;font-size:22px;font-weight:bold;line-height:26px;padding:0;margin:0">&nbsp;</h2>
                                  <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">Visit CodexWorld now and access tutorials, view live demo, download scripts at free of cost. </div></td>
                              </tr>
                              <tr>
                                <td align="center"><div style="text-align:center;width:100%;padding:40px 0">
                                    <table align="center" cellpadding="0" cellspacing="0" style="margin:0 auto;padding:0">
                                      <tbody>
                                        <tr>
                                          <td align="center" style="margin:0;text-align:center"><a href="http://www.codexworld.com/" style="font-size:18px;font-family:HelveticaNeue-Light,Arial,sans-serif;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#00a3df;padding:14px 40px;display:block" target="_blank">Visit Now!</a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                              </tr>
                            </tbody>
                          </table></td>
                        <td width="30" bgcolor="#eeeeee"></td>
                      </tr>
                    </tbody>
                  </table>
                  <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
                    <tbody>
                      <tr>
                        <td><table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                            <tbody>
                              <tr>
                                <td colspan="2" height="30"></td>
                              </tr>
                              <tr>
                                <td width="360" valign="top"><div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">&copy; 2015 CodexWorld. All rights reserved.</div>
                                  <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                  <div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">Made in India</div></td>
                                <td align="right" valign="top"><span style="line-height:20px;font-size:10px"><a href="https://www.facebook.com/codexworld" target="_blank"><img src="http://i.imgbox.com/BggPYqAh.png" alt="fb"></a>&nbsp;</span> <span style="line-height:20px;font-size:10px"><a href="https://twitter.com/codexworldblog" target="_blank"><img src="http://i.imgbox.com/j3NsGLak.png" alt="twit"></a>&nbsp;</span> <span style="line-height:20px;font-size:10px"><a href="https://plus.google.com/+codexworld" target="_blank"><img src="http://i.imgbox.com/wFyxXQyf.png" alt="g"></a>&nbsp;</span></td>
                              </tr>
                              <tr>
                                <td colspan="2" height="5"></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                    </tbody>
                  </table></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</div>
<?php //header('location:home.php?add&mailSuccess=1'); exit; ?>