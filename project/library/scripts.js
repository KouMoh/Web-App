document.addEventListener('DOMContentLoaded', function() {
    // Example: Load content dynamically
    document.querySelectorAll('nav ul li a').forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        loadContent(this.getAttribute('href'));
      });
    });
  
    function loadContent(url) {
      fetch(url)
        .then(response => response.text())
        .then(data => {
          document.getElementById('content').innerHTML = data;
        });
    }
  });

  function loadBooks() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'load_books.php', true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById('book-list').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  }
  
  