<div id="counter"></div>

<script>
window.onload = function() {
        ctr = document.getElementById("counter");
    
        function incrementCounter() {
           ctr.innerHTML = (Math.random() * (160 - 97)  + 97).toFixed(2);
           
           setTimeout( incrementCounter,500);
        }
    
        incrementCounter();
    };
</script>
