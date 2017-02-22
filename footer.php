<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script  type = "text/javascript" src = "bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">

$(function() {
     var pgurl = window.location.href.substr(window.location.href
.lastIndexOf("/")+1);
     $("ul.nav li a").each(function(){
          if($(this).attr("href") == pgurl)
            $(this).parent('li').addClass("active");
     })
});
</script>

</body>
</html>
