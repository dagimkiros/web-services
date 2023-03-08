//dagim kiros

<!DOCTYPE html>
<html>
<head>
<title>Bond Web Service Demo</title>
<style>
	body {font-family:georgia;}
  .film{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
  .pic img{
    max-width:50px;
  }
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
  function bondTemplate(film) {
    return `
      <div class="film">
        <b>Film</b>: ${film.Film}<br> 
        <b>Title</b>: ${film.Title}<br> 
        <b>Director</b>: ${film.Director}<br>
        <b>Producers</b>: ${film.Producers}<br> 
        <b>Writers</b>: ${film.Writers}<br>
        <b>Composer</b>: ${film.Composer}<br> 
        <b>Bond</b>: ${film.Bond}<br>
        <b>Budget</b>: ${film.Budget}<br>
        <b>Box Office</b>: ${film.BoxOffice}<br>
       <div class="pic"><img src= "thumbnails/${film.Image}"></div>
      </div>
    `;
  }

  $(document).ready(function() { 
    $('.category').click(function(e) {
      e.preventDefault(); //stop default action of the link
      let cat = $(this).attr("href");  //get category from URL
      
      //clear old films
      $("#films").html("");
  
      let request = $.ajax({
        url: "api.php?cat=" + cat,
        method: "GET",
        dataType: "json"
      });
      request.done(function(data) {
        console.log(data);
        $("#filmtitle").html(data.title);
        $.each(data.films, function(i, item) {
          let myData = bondTemplate(item);
          $("<div></div>").html(myData).appendTo("#films");
        });
      });
      request.fail(function(xhr, status, error) {
        alert('Error - ' + xhr.status + ': ' + xhr.statusText);
      });
    });
  });
</script>
</head>
<body>
  <h1>Bond Web Service</h1>
  <a href="year" class="category">Bond Films By Year</a><br />
  <a href="box" class="category">Bond Films By International Box Office Totals</a>
  <h3 id="filmtitle">Title Will Go Here</h3>
  <div id="films">
    <!-- Films will go here -->
  </div>
  <div id="output">Results go here</div>
</body>
</html>
