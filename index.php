<html>
  <head>
    <title>AJAX Quotes</title>
  </head>
  <body>
    <h1>AJAX Quotes</h1>
    <style>

      @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Barriecito&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');
      
        /* CSS to hide the quote container initially and apply fade-in animation */
        #quoteContainer {
            display: none;
            text-shadow: 4px 4px 4px #aaa;
        }

        /* CSS for the fade-in animation */
        .fade-in {
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

    </style>
    <p>This page generates a random quote with a random font every 5 seconds.</p>
    <div id="quoteContainer">Quote goes here</div>
    <script>
      
      var counter = 0;
      function getRandomQuote(){ 

        var fonts = ["Cinzel","Barriecito","Shadows Into Light"];
          
        var xhr = new XMLHttpRequest();
        
        xhr.open('GET','random_quotes.php',true);
        
        xhr.onload = function(){
          //code on return of data goes here
          if(xhr.status >= 200 && xhr.status < 300){//good data returned, show it!
            //document.querySelector("#quoteContainer").innerText = xhr.responseText;

            var quoteContainer = document.querySelector("#quoteContainer");
            quoteContainer.innerText = xhr.responseText;
            quoteContainer.style.display = "block";

            quoteContainer.style.fontFamily = fonts[counter];
            counter++;
            if(counter >= fonts.length){
              counter = 0;
            }
            
            setTimeout(function(){
              quoteContainer.classList.add("fade-in");
            },1000);
            
          }else {//something went wrong, give feedback
            document.querySelector("#quoteContainer").innerText = "Failed to fetch quote: " + xhr.status;
            
          }

          
        };
                
        xhr.onerror = function(){
          //code on error goes here
                  alert("Uh oh!");
        };

        //sends data to server
        xhr.send();
      }

      function displayRandomQuote(){
        //intial page load
        getRandomQuote();

        //run again at intervals
        setInterval(getRandomQuote,5000);
      }

      //run on page load
      displayRandomQuote();
    </script>
  </body>
</html>

