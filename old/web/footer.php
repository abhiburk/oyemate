<div class="footer_top_area">
      <!--<div class="inner_footer_top"> <img src="images/add3.png" alt="" /> </div>-->
    </div>
    
    <div class="footer_bottom_area">
    <div class="text_area_home">
      <div class="copyright_text">
        <p>Copyright &copy; 2017 Abhishek Burkule Production.</p>
      </div>
      </div>
    </div><div class="floatright">
        <!--<div class="social_icons">
          <ul>
            <li><a href="#" class="twitter"></a></li>
            <li><a href="#" class="facebook"></a></li>
            <li><a href="#" class="feed"></a></li>
          </ul>
        </div>-->
    </div>
    <script>
$(document).ready(function(){
	$("a.confirmDelete").click(function(){
		var isConfirm = window.confirm('Are You Sure Want To Delete This Record ?');
		if(isConfirm != true){
			return false;	
		}
	});
		return false;
	});
</script>
<script type="text/javascript">
selectnav('nav', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
selectnav('f_menu', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
$('.bxslider').bxSlider({
    mode: 'fade',
    captions: true
});
</script>
