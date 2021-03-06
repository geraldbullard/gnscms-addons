<!-- use the following form with bootstrap3 including font-awesome
<form action="search.php" id="search_form_footer" method="GET">
  <div class="input-group">
    <input class="form-control" name="search" type="text" />
    <span class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </span>
  </div>
  <input name="submit" type="hidden" value="submit" />
</form>
-->
<?php
  if (strpos($_SERVER['REQUEST_URI'], 'search') > 0) {
?>
  <script>
  $(document).ready(function() {
    var params = [];
    if (location.search) {
      var parts = location.search.substring(1).split('&');
      for (var i = 0; i < parts.length; i++) {
        var nv = parts[i].split('=');
        if (!nv[0]) continue;
        params[nv[0]] = nv[1] || true;
      }
    }  
    var cnt = 0;
    var links = [];
    for (var key in params) {
      if (key == 'noresults') {
        var noresults = true;
      } else if (key == 'minterms') {
        var minterms = true;
      } else if (key == 'results') {
        var results = urldecode(params[key]);
      } else {
        if (isOdd(cnt)) {
          var urlEnd = params[key].toString().replace(/_/g, " ") + '</a></li>'
        }
        if (!isOdd(cnt)) {
          var url = '<li class="search-result-li"><a href="' + params[key] + '">' + urlEnd;
          links.push(url);
          urlEnd = null;
          url = null;
        }
      }
      cnt++;
    }    
    if (links != '') {
      $("#search_form").hide();
      $("#search_terms").html('<h4>Search Results for "' + results + '"</h4>');
      $("#search_results").html('<ul class="search-result-ul">' + links.join("") + '</ul>');
    } else {
      if (noresults) {
        $("#search_results").html('<h4 class="search-h4">No Search Results</h4>');
      } else if (minterms) {
        $("#search_results").html('<h4 class="search-h4">Search Term Too Short. Try Again.</h4>');
      } else {
        header("Location: 404.html");
      }
    }  
    // Getting URL var by its nam
    // var byName = $.getUrlVar('name');
  });
  
  function isOdd(n) {
    return /^-?\d*[13579]$/.test(n);
  }
  
  function urldecode(str) {
    return decodeURIComponent((str+'').replace(/\+/g, '%20'));
  }
  </script>
<?php
  }
?>
